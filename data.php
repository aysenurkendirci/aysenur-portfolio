<?php

/*
    Bu dosya portfolyo sitesinde kullanılacak verileri tutar.
    Amaç: HTML dosyasını kalabalıklaştırmadan profil, teknoloji ve proje
    bilgilerini tek bir yerde düzenli şekilde yönetmektir.
*/

/*
    $profile dizisi portfolyo sahibinin temel bilgilerini içerir.
    Bu bilgiler navbar, hero, contact ve sosyal medya linklerinde kullanılabilir.
*/
$profile = [
    "name" => "Ayşe Nur Kendirci",

    /*
        title alanı iki dilli tutulmuştur.
        JavaScript dil değişimi yaparken en/tr değerleri kullanılabilir.
    */
    "title" => [
        "en" => "Software Engineering Student",
        "tr" => "Yazılım Mühendisliği Öğrencisi"
    ],

    /*
        tagline kısa tanıtım cümlesidir.
        Genellikle hero bölümünde başlığın altında gösterilir.
    */
    "tagline" => [
        "en" => "Building clean, modern and maintainable software products.",
        "tr" => "Temiz, modern ve sürdürülebilir yazılım ürünleri geliştiriyorum."
    ],

    /*
        description daha uzun profil açıklamasıdır.
        Hero veya About bölümünde kullanılabilir.
    */
    "description" => [
        "en" => "I am a software engineering student focused on mobile, frontend and backend development. I enjoy transforming ideas into structured, user-friendly and scalable software solutions.",
        "tr" => "Mobil, frontend ve backend geliştirme alanlarına odaklanan bir yazılım mühendisliği öğrencisiyim. Fikirleri düzenli, kullanıcı dostu ve ölçeklenebilir yazılım çözümlerine dönüştürmeyi seviyorum."
    ],

    /*
        İletişim ve sosyal medya bilgileri.
        Bu linkler HTML tarafında href içinde kullanılacaktır.
    */
    "email" => "aysenurkendirciss@gmail.com",
    "linkedin" => "https://www.linkedin.com/in/aysenurkendirci",
    "github" => "https://github.com/aysenurkendirci",

    /*
        CV ve profil fotoğrafı yolu.
        Dosyaların gerçekten bu klasörde olduğundan emin olunmalıdır.
    */
    "cv" => "images/cv.pdf",
    "image" => "images/profile.jpg"
];

/*
    $quickInfo dizisi hero bölümündeki küçük bilgi kutularını tutar.
    Her bilgi kutusunda label ve value vardır.
*/
$quickInfo = [
    [
        "label" => ["en" => "Focus", "tr" => "Odak"],
        "value" => ["en" => "Mobile / Frontend / Backend", "tr" => "Mobil / Frontend / Backend"]
    ],
    [
        "label" => ["en" => "Main Stack", "tr" => "Ana Teknolojiler"],
        "value" => ["en" => "Swift, .NET, Angular, PHP", "tr" => "Swift, .NET, Angular, PHP"]
    ],
    [
        "label" => ["en" => "GitHub", "tr" => "GitHub"],
        "value" => ["en" => "@aysenurkendirci", "tr" => "@aysenurkendirci"]
    ]
];

/*
    $aboutTexts dizisi About bölümündeki paragrafları tutar.
    Çok dilli yapı için her paragrafın en ve tr karşılığı vardır.
*/
$aboutTexts = [
    [
        "en" => "I am a software engineering student who enjoys building clean, structured and maintainable software products. My interests mainly focus on mobile development, frontend interfaces and backend logic.",
        "tr" => "Temiz, düzenli ve sürdürülebilir yazılım ürünleri geliştirmeyi seven bir yazılım mühendisliği öğrencisiyim. İlgi alanlarım ağırlıklı olarak mobil geliştirme, frontend arayüzleri ve backend mantığı üzerine odaklanmaktadır."
    ],
    [
        "en" => "Through academic work, internship projects and self-driven development, I continue improving my engineering mindset and practical coding skills. I enjoy transforming ideas into real applications and learning through project-based development.",
        "tr" => "Akademik çalışmalar, staj projeleri ve bireysel geliştirme süreçleri sayesinde mühendislik bakış açımı ve pratik kodlama becerilerimi geliştirmeye devam ediyorum. Fikirleri gerçek uygulamalara dönüştürmeyi ve proje tabanlı öğrenmeyi seviyorum."
    ]
];

/*
    $techCategories dizisi Tech Stack bölümünü oluşturur.
    Her kategori başlık, anahtar ve teknoloji item'larından oluşur.
*/
$techCategories = [
    [
        "key" => "mobile",
        "title" => ["en" => "Mobile Development", "tr" => "Mobil Geliştirme"],
        "items" => [
            [
                "name" => "Swift",
                "icon" => "devicon-swift-plain colored",
                "tooltip" => [
                    "en" => "Swift is a modern programming language developed by Apple for iOS and macOS applications.",
                    "tr" => "Swift, Apple tarafından iOS ve macOS uygulamaları için geliştirilen modern bir programlama dilidir."
                ]
            ],
            [
                "name" => "SwiftUI",
                "icon" => "devicon-swift-plain colored",
                "tooltip" => [
                    "en" => "SwiftUI is Apple’s declarative UI framework for building interfaces across Apple platforms.",
                    "tr" => "SwiftUI, Apple platformlarında arayüz geliştirmek için kullanılan declarative UI framework’üdür."
                ]
            ],
            [
                "name" => "UIKit",
                "icon" => "devicon-apple-original",
                "tooltip" => [
                    "en" => "UIKit is a core Apple framework for building iOS user interfaces programmatically.",
                    "tr" => "UIKit, iOS arayüzlerini programatik olarak geliştirmek için kullanılan temel Apple framework’üdür."
                ]
            ]
        ]
    ],
    [
        "key" => "frontend",
        "title" => ["en" => "Frontend", "tr" => "Frontend"],
        "items" => [
            [
                "name" => "HTML",
                "icon" => "devicon-html5-plain colored",
                "tooltip" => [
                    "en" => "HTML is the standard markup language used to structure web pages.",
                    "tr" => "HTML, web sayfalarının yapısını oluşturmak için kullanılan standart işaretleme dilidir."
                ]
            ],
            [
                "name" => "CSS",
                "icon" => "devicon-css3-plain colored",
                "tooltip" => [
                    "en" => "CSS controls the visual styling, layout and responsive behavior of web pages.",
                    "tr" => "CSS, web sayfalarının görsel stilini, düzenini ve responsive davranışını kontrol eder."
                ]
            ],
            [
                "name" => "JavaScript",
                "icon" => "devicon-javascript-plain colored",
                "tooltip" => [
                    "en" => "JavaScript adds dynamic and interactive behavior to websites.",
                    "tr" => "JavaScript, web sitelerine dinamik ve etkileşimli davranış kazandırır."
                ]
            ],
            [
                "name" => "Angular",
                "icon" => "devicon-angularjs-plain colored",
                "tooltip" => [
                    "en" => "Angular is a frontend framework maintained by Google for building scalable web applications.",
                    "tr" => "Angular, ölçeklenebilir web uygulamaları geliştirmek için Google tarafından desteklenen bir frontend framework’üdür."
                ]
            ]
        ]
    ],
    [
        "key" => "backend",
        "title" => ["en" => "Backend", "tr" => "Backend"],
        "items" => [
            [
                "name" => "PHP",
                "icon" => "devicon-php-plain colored",
                "tooltip" => [
                    "en" => "PHP is a widely used server-side scripting language for web development.",
                    "tr" => "PHP, web geliştirmede yaygın olarak kullanılan sunucu taraflı bir betik dilidir."
                ]
            ],
            [
                "name" => ".NET Core",
                "icon" => "devicon-dotnetcore-plain colored",
                "tooltip" => [
                    "en" => ".NET is Microsoft’s modern development platform for backend and enterprise applications.",
                    "tr" => ".NET, backend ve kurumsal uygulamalar için Microsoft’un modern geliştirme platformudur."
                ]
            ],
            [
                "name" => "C#",
                "icon" => "devicon-csharp-plain colored",
                "tooltip" => [
                    "en" => "C# is an object-oriented programming language developed by Microsoft.",
                    "tr" => "C#, Microsoft tarafından geliştirilen nesne yönelimli bir programlama dilidir."
                ]
            ]
        ]
    ],
    [
        "key" => "database-tools",
        "title" => ["en" => "Database & Tools", "tr" => "Veritabanı ve Araçlar"],
        "items" => [
            [
                "name" => "SQL",
                "icon" => "devicon-azuresqldatabase-plain colored",
                "tooltip" => [
                    "en" => "SQL is used to manage, query and manipulate relational databases.",
                    "tr" => "SQL, ilişkisel veritabanlarını yönetmek, sorgulamak ve düzenlemek için kullanılır."
                ]
            ],
            [
                "name" => "Firebase",
                "icon" => "devicon-firebase-plain colored",
                "tooltip" => [
                    "en" => "Firebase is a backend platform by Google offering authentication, database and hosting services.",
                    "tr" => "Firebase, Google tarafından sunulan kimlik doğrulama, veritabanı ve hosting hizmetleri sağlayan bir backend platformudur."
                ]
            ],
            [
                "name" => "Git",
                "icon" => "devicon-git-plain colored",
                "tooltip" => [
                    "en" => "Git is a distributed version control system for tracking code changes.",
                    "tr" => "Git, kod değişikliklerini takip etmek için kullanılan dağıtık bir sürüm kontrol sistemidir."
                ]
            ],
            [
                "name" => "GitHub",
                "icon" => "devicon-github-original",
                "tooltip" => [
                    "en" => "GitHub is a collaboration platform used to host and manage Git repositories.",
                    "tr" => "GitHub, Git depolarını barındırmak ve yönetmek için kullanılan bir iş birliği platformudur."
                ]
            ]
        ]
    ]
];

/*
    $projects dizisi Projects bölümünde gösterilecek portfolyo projelerini tutar.
    Her projede başlık, açıklama, kullanılan teknolojiler ve GitHub linki bulunur.
*/
$projects = [
    [
        "title" => "CineScope",
        "description" => [
            "en" => "An AI-powered movie recommendation application developed for iOS. This project focuses on recommendation flows, OpenAI API integration and a structured UIKit-based user experience. It reflects my experience with mobile UI design, API usage and modular application thinking.",
            "tr" => "iOS için geliştirilmiş yapay zekâ destekli bir film öneri uygulamasıdır. Bu proje öneri akışları, OpenAI API entegrasyonu ve UIKit tabanlı düzenli bir kullanıcı deneyimi üzerine odaklanmaktadır. Mobil arayüz tasarımı, API kullanımı ve modüler uygulama yaklaşımı konularındaki deneyimimi yansıtır."
        ],
        "tech" => ["Swift", "UIKit", "OpenAI API"],
        "github" => "https://github.com/aysenurkendirci/CineScope-MovieApp"
    ],
    [
        "title" => "PettiCare",
        "description" => [
            "en" => "A pet care tracking application designed to help users manage routines and pet-related information in a clean and user-friendly way. The project demonstrates my experience with SwiftUI, MVVM architecture and local data persistence using SwiftData.",
            "tr" => "Kullanıcıların evcil hayvan rutinlerini ve ilgili bilgileri düzenli ve kullanıcı dostu bir şekilde yönetmesini sağlayan bir evcil hayvan bakım takip uygulamasıdır. Proje, SwiftUI, MVVM mimarisi ve SwiftData ile yerel veri saklama konularındaki deneyimimi göstermektedir."
        ],
        "tech" => ["SwiftUI", "MVVM", "SwiftData"],
        "github" => "https://github.com/aysenurkendirci/PettiCareApp"
    ],
    [
        "title" => "HeyDou Campus",
        "description" => [
            "en" => "A campus-focused digital platform project developed with a structured interface and usability-oriented approach. It highlights frontend organization, page structure and practical development experience around a real product idea.",
            "tr" => "Kampüs odaklı dijital bir platform projesidir. Düzenli arayüz yapısı ve kullanılabilirlik odaklı yaklaşımıyla geliştirilmiştir. Frontend organizasyonu, sayfa yapısı ve gerçek bir ürün fikri etrafında geliştirme deneyimini öne çıkarır."
        ],
        "tech" => ["HTML", "CSS", "OpenAI Integration"],
        "github" => "https://github.com/aysenurkendirci/Heydou_kamp-s"
    ],
    [
        "title" => "Internship Bank Project",
        "description" => [
            "en" => "A full-stack internship project developed around banking-related workflows. It includes Angular on the frontend and .NET Core based backend logic, representing my experience with enterprise-style application structure, layered thinking and real internship development processes.",
            "tr" => "Bankacılık süreçleri etrafında geliştirilmiş full-stack bir staj projesidir. Frontend tarafında Angular, backend tarafında ise .NET Core tabanlı mantık bulunmaktadır. Kurumsal uygulama yapısı, katmanlı düşünme ve gerçek staj geliştirme süreçlerindeki deneyimimi temsil eder."
        ],
        "tech" => ["Angular", ".NET Core", "Oracle DB"],
        "github" => "https://github.com/aysenurkendirci/Internship_Bank_Project"
    ]
];