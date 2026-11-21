// Hero etkileşimleri
// 1) İsim harflere ayrılır: maviden mora renk geçişi, sırayla açılış, hover'da zıplama.
// 2) Yaka kartı makaralı bir askı gibi davranır (sallanmaz):
//    - Masaüstünde kart tutulup aşağı çekilir; şerit makaradan uzar gibi iner,
//      yana çekince hafifçe yatar. Bırakınca yay gibi geri sarılıp yerine oturur.
//    - Çekme lastik gibidir: uzadıkça zorlaşır, bir sınıra yaklaşır.
//    - Dokunmatikte karta dokununca kendiliğinden çekilip bırakılır
//      (sayfayı kaydırmak engellenmez).
//    - Açılışta kart yukarıdan düşer ve aynı esneklikle yerine oturur.
//    - Fareyle üzerine gelince kart hafifçe eğilir, holografik bant kayar.
// Boştayken hiçbir şey hareket etmez; döngü yalnızca kart hareket ederken çalışır.
// Hareketi azalt açıksa hiçbiri çalışmaz; kart düz ve sabit durur.

(function () {
    "use strict";

    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
    const finePointer = window.matchMedia("(hover: hover) and (pointer: fine)").matches;

    // ---------- 1) İsim harfleri ----------

    const name = document.querySelector(".hero-name");
    if (name && !name.dataset.split) {
        const fullName = name.textContent.replace(/\s+/g, " ").trim();
        name.setAttribute("aria-label", fullName);

        const letters = [];
        let index = 0;
        name.querySelectorAll(":scope > span").forEach((line) => {
            const text = line.textContent.trim();
            line.textContent = "";
            line.setAttribute("aria-hidden", "true");
            Array.from(text).forEach((char) => {
                const el = document.createElement("span");
                if (char === " ") {
                    el.className = "sp";
                } else {
                    el.className = "ch";
                    el.textContent = char;
                    letters.push(el);
                }
                el.style.setProperty("--i", String(index++));
                line.appendChild(el);
            });
        });
        letters.forEach((el, i) => {
            const t = letters.length > 1 ? i / (letters.length - 1) : 0;
            el.style.setProperty("--t", t.toFixed(3));
        });
        name.dataset.split = "1";
    }

    // ---------- 2) Yaka kartı: çek-bırak ----------

    const wrap = document.querySelector("[data-badge]");
    const rig = wrap ? wrap.querySelector(".badge-rig") : null;
    const card = wrap ? wrap.querySelector(".portfolio-card") : null;
    if (!wrap || !rig || !card) return;

    // Birimler: piksel, saniye
    const MAX_PULL = 170;     // aşağı çekme sınırı (lastik gibi yaklaşılır)
    const MAX_LIFT = 16;      // yukarı itme sınırı
    const MAX_SIDE = 90;      // yana çekme sınırı
    const LEAN = 0.1;         // yana çekilen her piksel için yatma (derece)
    const K_Y = 190;          // dikey yay sertliği
    const C_Y = 12;           // dikey sönüm (bir kez tatlı bir zıplama)
    const K_X = 140;          // yatay yay sertliği
    const C_X = 11;
    const MAX_SPEED = 2600;
    const TAP_KICK = 560;     // dokununca aşağı doğru verilen hız
    const DROP_FROM = -170;   // açılışta kartın düştüğü yükseklik

    let y = 0;                // aşağı (+) / yukarı (-) kayma
    let vy = 0;
    let x = 0;                // yana kayma (yatma açısına dönüşür)
    let vx = 0;
    let dragging = false;
    let originX = 0;
    let originY = 0;
    let downX = 0;
    let downY = 0;
    let moved = false;
    let sampleY = 0;
    let sampleX = 0;
    let sampleT = 0;
    let frame = null;
    let last = 0;

    const clamp = (v, lo, hi) => Math.min(hi, Math.max(lo, v));

    // Lastik etkisi: ham çekme mesafesini sınıra yaklaşan bir değere çevirir
    const rubberY = (raw) => (raw >= 0
        ? MAX_PULL * (1 - Math.exp(-raw / MAX_PULL))
        : -MAX_LIFT * (1 - Math.exp(raw / MAX_LIFT)));
    const rubberX = (raw) => MAX_SIDE * Math.tanh(raw / MAX_SIDE);

    // Tersleri: hareket halindeki kart tutulunca zıplamadan devam etsin
    const unrubberY = (v) => (v >= 0
        ? -MAX_PULL * Math.log(1 - Math.min(v, MAX_PULL * 0.98) / MAX_PULL)
        : MAX_LIFT * Math.log(1 + Math.max(v, -MAX_LIFT * 0.98) / MAX_LIFT));
    const unrubberX = (v) => MAX_SIDE * Math.atanh(clamp(v, -MAX_SIDE * 0.98, MAX_SIDE * 0.98) / MAX_SIDE);

    function render() {
        rig.style.setProperty("--pull", `${y.toFixed(2)}px`);
        // CSS'te pozitif açı saat yönü: kartın alt ucu sola gider.
        // Kart sağa çekilince alt ucu sağa gitsin diye işaret ters.
        rig.style.setProperty("--lean", `${(-x * LEAN).toFixed(3)}deg`);
        card.style.setProperty("--pull-n", y.toFixed(2));
    }

    function atRest() {
        return Math.abs(y) < 0.3 && Math.abs(vy) < 4 && Math.abs(x) < 0.3 && Math.abs(vx) < 4;
    }

    function step(now) {
        const dt = Math.min(0.032, (now - last) / 1000);
        last = now;
        if (!dragging) {
            vy += (-K_Y * y - C_Y * vy) * dt;
            y += vy * dt;
            vx += (-K_X * x - C_X * vx) * dt;
            x += vx * dt;
            if (atRest()) {
                y = vy = x = vx = 0;
                render();
                frame = null;
                return;
            }
        }
        render();
        frame = requestAnimationFrame(step);
    }

    function kick() {
        if (!frame && !reduceMotion.matches) {
            last = performance.now();
            frame = requestAnimationFrame(step);
        }
    }

    function stopStill() {
        if (frame) cancelAnimationFrame(frame);
        frame = null;
        dragging = false;
        y = vy = x = vx = 0;
        wrap.classList.remove("is-dragging");
        render();
    }

    // Açılış: kart yukarıdan düşer, şeritte esneyip yerine oturur
    if (reduceMotion.matches) {
        stopStill();
    } else {
        y = DROP_FROM;
        render();
        window.setTimeout(kick, 200);
    }

    reduceMotion.addEventListener("change", (e) => {
        if (e.matches) stopStill();
    });

    function markUsed() {
        wrap.classList.add("has-pulled");
    }

    card.addEventListener("pointerdown", (event) => {
        if (reduceMotion.matches || event.button > 0) return;
        downX = event.clientX;
        downY = event.clientY;
        moved = false;
        if (event.pointerType !== "mouse") return; // dokunmatik: yalnızca dokunma

        event.preventDefault();
        dragging = true;
        card.setPointerCapture(event.pointerId);
        wrap.classList.add("is-dragging");
        // Kart o an nerede ise oradan devam et (zıplama olmasın)
        originY = event.clientY - unrubberY(y);
        originX = event.clientX - unrubberX(x);
        sampleY = y;
        sampleX = x;
        sampleT = performance.now();
        vy = 0;
        vx = 0;
    });

    card.addEventListener("pointermove", (event) => {
        if (Math.hypot(event.clientX - downX, event.clientY - downY) > 5) moved = true;

        if (dragging) {
            y = rubberY(event.clientY - originY);
            x = rubberX(event.clientX - originX);
            const now = performance.now();
            const dt = (now - sampleT) / 1000;
            if (dt > 0.012) {
                // Bırakma hızını son harekete göre hesapla (yumuşatılmış)
                vy = clamp(0.6 * ((y - sampleY) / dt) + 0.4 * vy, -MAX_SPEED, MAX_SPEED);
                vx = clamp(0.6 * ((x - sampleX) / dt) + 0.4 * vx, -MAX_SPEED, MAX_SPEED);
                sampleY = y;
                sampleX = x;
                sampleT = now;
            }
            render();
            return;
        }

        // Eğim ve holografik bant (yalnızca fare, kart tutulmuyorken)
        if (finePointer && !reduceMotion.matches && event.pointerType === "mouse") {
            const r = card.getBoundingClientRect();
            const px = clamp((event.clientX - r.left) / r.width, 0, 1);
            const py = clamp((event.clientY - r.top) / r.height, 0, 1);
            card.style.setProperty("--card-ry", `${((px - 0.5) * 14).toFixed(2)}deg`);
            card.style.setProperty("--card-rx", `${((0.5 - py) * 10).toFixed(2)}deg`);
            card.style.setProperty("--gx", `${(px * 100).toFixed(1)}%`);
            card.style.setProperty("--gy", `${(py * 100).toFixed(1)}%`);
            card.style.setProperty("--hx", `${(px * 100).toFixed(1)}%`);
            card.style.setProperty("--hy", `${(py * 100).toFixed(1)}%`);
            wrap.classList.add("is-hovering");
        }
    });

    function release(event) {
        const wasDragging = dragging;
        dragging = false;
        wrap.classList.remove("is-dragging");
        if (card.hasPointerCapture && card.hasPointerCapture(event.pointerId)) {
            card.releasePointerCapture(event.pointerId);
        }
        if (reduceMotion.matches) return;

        if (!moved && event.type === "pointerup") {
            // Dokunma ya da yerinde tıklama: kart kendiliğinden çekilip bırakılır
            vy = clamp(vy + TAP_KICK, -MAX_SPEED, MAX_SPEED);
            markUsed();
        } else if (wasDragging) {
            // Bekleyip bırakıldıysa (hız eski kaldıysa) sıfırdan geri sarılsın
            if (performance.now() - sampleT > 90) {
                vy = 0;
                vx = 0;
            }
            if (Math.abs(y) > 20) markUsed();
        }
        kick();
    }

    card.addEventListener("pointerup", release);
    card.addEventListener("pointercancel", release);

    card.addEventListener("pointerleave", () => {
        wrap.classList.remove("is-hovering");
        card.style.setProperty("--card-rx", "0deg");
        card.style.setProperty("--card-ry", "0deg");
    });

    // Fotoğrafın sürüklenip tarayıcıda "resim taşıma"ya dönüşmesini engelle
    card.addEventListener("dragstart", (event) => event.preventDefault());
})();
