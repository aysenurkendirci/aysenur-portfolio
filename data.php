<?php
/**
 * Portföy Veri Dosyası
 * 
 * Bu dosya portföy web sitesinin tüm içeriğini ve yapılandırma verilerini barındırır.
 * Aşağıdaki veriler için merkezi kaynak:
 * - Profil bilgileri ve sosyal ağ bağlantıları
 * - Hakkımda bölümü içeriği
 * - Teknoloji/beceri kategorileri
 * - İş geçmişi kaydı
 * - Proje vitrin detayları
 * - İletişim formu yapılandırması
 * 
 * Tüm içerik verilerini merkezi olarak tutarak, portföy içeriğine yapılan
 * güncellemeler HTML/PHP şablon dosyalarını değiştirmeden yapılabilir.
 * 
 * Çok Dilli Destek: Tüm içerik veri yapısında 'en' ve 'tr' anahtarlarıyla
 * İngilizce ve Türkçe olarak sağlanır.
 * 
 * @author Ayşe Nur Kendirci
 * @version 1.0
 */

/**
 * PROFIL BÖLÜMÜ
 * Temel kişisel bilgiler ve iletişim detayları
 */
$profile = [
    "name" => "Ayşe Nur Kendirci",

    "title" => [
        "en" => "Backend Software Developer",
        "tr" => "Backend  Yazılım Geliştirici"
    ],

    "tagline" => [
        "en" => "Building scalable backend systems and native mobile applications with clean architecture.",
        "tr" => "Temiz mimari ile ölçeklenebilir backend sistemleri ve native mobil uygulamalar geliştiriyorum."
    ],

    "description" => [
        "en" => "I design and build REST APIs, backend services and iOS applications. Focused on clean code, maintainable architecture and solving real-world problems through software.",
        "tr" => "REST API'ler, backend servisleri ve iOS uygulamaları tasarlayıp geliştiriyorum. Temiz kod, sürdürülebilir mimari ve yazılım aracılığıyla gerçek dünya problemlerini çözmek üzerine odaklanıyorum."
    ],

    "email" => "aysenurkendirciss@gmail.com",
    "linkedin" => "https://www.linkedin.com/in/aysenurkendirci",
    "github" => "https://github.com/aysenurkendirci",

    "cv" => "images/cv.pdf",
    "image" => "images/profile.jpg",

    "contact_info" => [
        "email_label" => [
            "en" => "Email",
            "tr" => "E-posta"
        ],
        "github_label" => [
            "en" => "GitHub",
            "tr" => "GitHub"
        ],
        "github_action" => [
            "en" => "View repositories",
            "tr" => "Depoları görüntüle"
        ],
        "linkedin_label" => [
            "en" => "LinkedIn",
            "tr" => "LinkedIn"
        ],
        "linkedin_action" => [
            "en" => "Connect with me",
            "tr" => "Benimle bağlantı kurun"
        ]
    ]
];

$aboutTexts = [
    [
        "en" => "I am a motivated software developer who enjoys building real-world applications and continuously improving my technical skills. My main focus areas are mobile development, frontend interfaces and backend systems.",
        "tr" => "Gerçek dünyaya yönelik uygulamalar geliştirmeyi seven, öğrenmeye istekli ve kendini sürekli geliştiren bir yazılım geliştiricisiyim. Ana odak alanlarım mobil geliştirme, frontend arayüzleri ve backend sistemleridir."
    ],
    [
        "en" => "Through internships, academic projects and self-driven learning, I have gained hands-on experience with modern software architectures, component-based development and structured project workflows.",
        "tr" => "Staj deneyimlerim, akademik projelerim ve bireysel öğrenme sürecim sayesinde modern yazılım mimarileri, component tabanlı geliştirme ve düzenli proje yapıları konusunda pratik deneyim kazandım."
    ],
    [
        "en" => "I am disciplined, detail-oriented and persistent. I enjoy turning ideas into functional products and aim to grow every day as a developer who creates meaningful and user-focused software.",
        "tr" => "Disiplinli, detaylara önem veren ve azimli bir geliştiriciyim. Fikirleri çalışan ürünlere dönüştürmekten keyif alıyor ve her gün daha iyi, anlamlı ve kullanıcı odaklı yazılımlar geliştiren bir yazılımcı olmayı hedefliyorum."
    ]
];

/**
 * HAKKIMDA BÖLÜMÜ VERİSİ
 * Kişisel arka plan ve mesleki yaklaşım paragrafları
 */
$aboutTexts = [
    [
        "en" => "I am a Software Engineer with hands-on experience building backend systems and iOS applications. I specialize in REST API design, database architecture, and mobile app development using modern frameworks and clean code principles.",
        "tr" => "Backend sistemleri ve iOS uygulamaları geliştirme konusunda pratik deneyime sahip bir yazılım mühendisiyim. REST API tasarımı, veritabanı mimarisi ve modern frameworkler ile temiz kod ilkeleri kullanarak mobil uygulama geliştirme konularında uzmanlaşmışım."
    ],
    [
        "en" => "Through internships at VakıfBank and academic projects, I have developed expertise in full-stack development, MVC architecture, and Agile workflows. I am comfortable working with C#, .NET Core, Oracle Database, Swift and Angular across different layers of application development.",
        "tr" => "VakıfBank'taki stajlarım ve akademik projelerim sayesinde full-stack geliştirme, MVC mimarisi ve Agile iş akışlarında uzmanlık geliştirdim. Uygulama geliştirmenin farklı katmanlarında C#, .NET Core, Oracle Database, Swift ve Angular ile çalışmaktan rahatım."
    ],
    [
        "en" => "I focus on writing maintainable code, designing robust systems and solving complex technical problems. I am committed to continuous learning and delivering high-quality software that meets both technical requirements and user expectations.",
        "tr" => "Sürdürülebilir kod yazma, güçlü sistemler tasarlama ve karmaşık teknik problemleri çözme üzerine odaklanıyorum. Sürekli öğrenmeye ve hem teknik gereksinimleri hem de kullanıcı beklentilerini karşılayan yüksek kaliteli yazılım sunmaya sadınım."
    ]
];

/**
 * TEKNOLOJİ/BECERİLER VERİSİ
 * 
 * Teknik becerilerin kategorilere ayrılmış listesi:
 * - Kategori başlığı (çok dilli)
 * - İsim, ikon ve araç ipucu ile beceri öğeleri
 * - Her beceri çok dilli araç ipucu açıklamaları içerir
 * 
 * Kategoriler:
 * 1. Backend ve Veritabanı
 * 2. Mobil Geliştirme
 * 3. Frontend Geliştirme
 */
$techCategories = [
    [
        "title" => [
            "en" => "Backend",
            "tr" => "Backend"
        ],
        "items" => [
            [
                "name" => "C#",
                "icon" => "devicon-csharp-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Object-oriented language for building robust backend systems and APIs.",
                    "tr" => "Güçlü backend sistemleri ve API'ler geliştirmek için nesne yönelimli programlama dili."
                ]
            ],
            [
                "name" => ".NET Core",
                "icon" => "devicon-dotnetcore-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Cross-platform framework for building scalable APIs and backend services.",
                    "tr" => "Ölçeklenebilir API'ler ve backend servisleri geliştirmek için cross-platform framework."
                ]
            ],
            [
                "name" => "PHP",
                "icon" => "devicon-php-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Server-side language for building dynamic web applications and MVC systems.",
                    "tr" => "Dinamik web uygulamaları ve MVC sistemleri geliştirmek için sunucu tarafı programlama dili."
                ]
            ],
            [
                "name" => "Laravel",
                "icon" => "devicon-laravel-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Modern PHP framework for rapid API and web application development.",
                    "tr" => "Hızlı API ve web uygulaması geliştirme için modern PHP framework."
                ]
            ],
            [
                "name" => "REST API",
                "icon" => "",
                "iconText" => "API",
                "tooltip" => [
                    "en" => "RESTful architecture for building scalable, stateless backend services.",
                    "tr" => "Ölçeklenebilir, stateless backend servisleri geliştirmek için RESTful mimari."
                ]
            ],
            [
                "name" => "Oracle Database",
                "icon" => "devicon-oracle-original colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Enterprise relational database for building complex data systems.",
                    "tr" => "Karmaşık veri sistemleri geliştirmek için kurumsal seviyede ilişkisel veritabanı."
                ]
            ],
            [
                "name" => "SQL Server",
                "icon" => "devicon-microsoftsqlserver-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Relational database for data storage, queries and stored procedures.",
                    "tr" => "Veri saklama, sorgu ve stored procedure işlemleri için ilişkisel veritabanı."
                ]
            ],
            [
                "name" => "Firebase",
                "icon" => "devicon-firebase-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Cloud backend platform for real-time database and authentication services.",
                    "tr" => "Real-time veritabanı ve kimlik doğrulama servisleri için bulut backend platformu."
                ]
            ]
        ]
    ],
    [
        "title" => [
            "en" => "Mobile",
            "tr" => "Mobil"
        ],
        "items" => [
            [
                "name" => "Swift",
                "icon" => "devicon-swift-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Modern language for native iOS app development with performance and safety.",
                    "tr" => "Performans ve güvenlik ile native iOS uygulamalar geliştirmek için modern programlama dili."
                ]
            ],
            [
                "name" => "UIKit",
                "icon" => "devicon-apple-original",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Apple's foundational framework for building iOS interfaces programmatically.",
                    "tr" => "iOS arayüzlerini programatik olarak geliştirmek için Apple'ın temel framework'ü."
                ]
            ],
            [
                "name" => "SwiftUI",
                "icon" => "devicon-swift-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Declarative framework for building modern, responsive iOS interfaces.",
                    "tr" => "Modern, responsive iOS arayüzleri geliştirmek için deklaratif framework."
                ]
            ],
            [
                "name" => "SwiftData",
                "icon" => "devicon-apple-original",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Modern persistence framework for local data storage in iOS apps.",
                    "tr" => "iOS uygulamalarında yerel veri saklama için modern kalıcılık framework'ü."
                ]
            ],
            [
                "name" => "OpenAI API",
                "icon" => "",
                "iconText" => "AI",
                "tooltip" => [
                    "en" => "Integration with AI models for intelligent features and NLP capabilities.",
                    "tr" => "Akıllı özellikler ve NLP yetenekleri için AI modelleri entegrasyonu."
                ]
            ],
            [
                "name" => "MapKit",
                "icon" => "devicon-apple-original",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Apple's framework for integrating maps and location services.",
                    "tr" => "Haritalar ve konum servisleri entegrasyonu için Apple framework'ü."
                ]
            ],
            [
                "name" => "Moya",
                "icon" => "",
                "iconText" => "HTTP",
                "tooltip" => [
                    "en" => "Abstraction layer for network requests in iOS apps.",
                    "tr" => "iOS uygulamalarında ağ istekleri için soyutlama katmanı."
                ]
            ],
            [
                "name" => "Alamofire",
                "icon" => "",
                "iconText" => "HTTP",
                "tooltip" => [
                    "en" => "HTTP networking library for iOS applications.",
                    "tr" => "iOS uygulamaları için HTTP ağ iletişim kütüphanesi."
                ]
            ]
        ]
    ],
    [
        "title" => [
            "en" => "Frontend",
            "tr" => "Frontend"
        ],
        "items" => [
            [
                "name" => "Angular",
                "icon" => "devicon-angularjs-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Full-featured framework for building structured web applications.",
                    "tr" => "Düzenli web uygulamaları geliştirmek için tam özellikli framework."
                ]
            ],
            [
                "name" => "JavaScript",
                "icon" => "devicon-javascript-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Core language for interactive client-side web development.",
                    "tr" => "İnteraktif client-side web geliştirme için temel programlama dili."
                ]
            ],
            [
                "name" => "HTML",
                "icon" => "devicon-html5-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Semantic markup language for structuring web page content.",
                    "tr" => "Web sayfası içeriğini yapılandırmak için anlamsal işaretleme dili."
                ]
            ],
            [
                "name" => "CSS",
                "icon" => "devicon-css3-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Styling language for responsive and modern web interfaces.",
                    "tr" => "Responsive ve modern web arayüzleri tasarlamak için stil dili."
                ]
            ]
        ]
    ]
];

/**
 * DENEYİM BÖLÜMÜ VERİSİ
 * 
 * Profesyonel ve eğitim deneyimi kayıtları:
 * - Deneyim kategorisi/tipi (staj, eğitim, vb.)
 * - Süre/tarih aralığı
 * - Pozisyon başlığı (çok dilli)
 * - Şirket/kurum adı
 * - Rol açıklaması (çok dilli)
 * - Anahtar başarıları ve sorumlulukları listesi (çok dilli)
 * 
 * Portföyde kronolojik sırada kartlar olarak görüntülenir
 */
$experiences = [
    [
        "category" => [
            "en" => "Mobile Internship",
            "tr" => "Mobil Staj"
        ],
        "date" => "Jul 2025 - Sep 2025",
        "title" => [
            "en" => "Mobile Application Development Intern",
            "tr" => "Mobil Uygulama Geliştirme Stajyeri"
        ],
        "company" => "VakıfBank",
        "description" => [
            "en" => "Completed a 2-month mobile development internship and actively contributed to CineScope and PettiCare iOS applications.",
            "tr" => "2 aylık mobil geliştirme stajımı tamamladım ve CineScope ile PettiCare iOS uygulamalarına aktif olarak katkı sağladım."
        ],
        "items" => [
            [
                "en" => "Developed iOS application screens using Swift, UIKit and SwiftUI.",
                "tr" => "Swift, UIKit ve SwiftUI kullanarak iOS uygulama ekranları geliştirdim."
            ],
            [
                "en" => "Worked with MVVM architecture, reusable components and clean project structure.",
                "tr" => "MVVM mimarisi, tekrar kullanılabilir component yapısı ve temiz proje düzeni üzerine çalıştım."
            ],
            [
                "en" => "Built base structures for networking, data flow and screen organization.",
                "tr" => "Networking, veri akışı ve ekran organizasyonu için temel proje yapıları oluşturdum."
            ],
            [
                "en" => "Integrated OpenAI API features for personalized movie recommendation flows.",
                "tr" => "Kişiselleştirilmiş film öneri akışları için OpenAI API entegrasyonu üzerinde çalıştım."
            ],
            [
                "en" => "Improved practical knowledge of mobile UI design, Firebase, SwiftData and project-based development.",
                "tr" => "Mobil arayüz tasarımı, Firebase, SwiftData ve proje tabanlı geliştirme konularında pratik deneyim kazandım."
            ]
        ]
    ],
    [
        "category" => [
            "en" => "Web Internship",
            "tr" => "Web Stajı"
        ],
        "date" => "Jan 2026 - Feb 2026",
        "title" => [
            "en" => "Software Engineering Intern",
            "tr" => "Yazılım Mühendisliği Stajyeri"
        ],
        "company" => "VakıfBank",
        "description" => [
            "en" => "Worked on a banking-focused web application and gained experience in frontend, backend and database development.",
            "tr" => "Bankacılık odaklı bir web uygulaması üzerinde çalışarak frontend, backend ve veritabanı geliştirme alanlarında deneyim kazandım."
        ],
        "items" => [
            [
                "en" => "Developed frontend modules using Angular, HTML and CSS.",
                "tr" => "Angular, HTML ve CSS kullanarak frontend modülleri geliştirdim."
            ],
            [
                "en" => "Worked on backend logic with C# and .NET Core.",
                "tr" => "C# ve .NET Core ile backend mantığı üzerine çalıştım."
            ],
            [
                "en" => "Practiced RESTful API structure, authentication flow and business logic implementation.",
                "tr" => "RESTful API yapısı, authentication akışı ve iş mantığı geliştirme konularında pratik yaptım."
            ],
            [
                "en" => "Used Oracle Database, stored procedures and package-based database operations.",
                "tr" => "Oracle Database, stored procedure ve package tabanlı veritabanı işlemleri üzerinde çalıştım."
            ],
            [
                "en" => "Learned clean architecture, repository pattern and Agile development workflow.",
                "tr" => "Clean architecture, repository pattern ve Agile geliştirme iş akışı hakkında deneyim kazandım."
            ]
        ]
    ],
    [
        "category" => [
            "en" => "Leadership",
            "tr" => "Liderlik"
        ],
        "date" => "2025 - Present",
        "title" => [
            "en" => "Mobile Technical Team Lead",
            "tr" => "Mobil Teknik Takım Kaptanı"
        ],
        "company" => "GDG On Campus Doğuş University",
        "description" => [
            "en" => "Served as the mobile technical team lead and supported both event organization and technical project development.",
            "tr" => "Mobil teknik takım kaptanı olarak etkinlik organizasyonlarına ve teknik proje geliştirme süreçlerine aktif katkı sağladım."
        ],
        "items" => [
            [
                "en" => "Helped organize student-focused software, mobile development and technology events.",
                "tr" => "Öğrenci odaklı yazılım, mobil geliştirme ve teknoloji etkinliklerinin düzenlenmesine yardımcı oldum."
            ],
            [
                "en" => "Supported team coordination, communication and technical planning.",
                "tr" => "Takım koordinasyonu, iletişim ve teknik planlama süreçlerine destek verdim."
            ],
            [
                "en" => "Contributed to mobile-focused projects and learning activities.",
                "tr" => "Mobil odaklı projelere ve öğrenme etkinliklerine katkıda bulundum."
            ],
            [
                "en" => "Improved leadership, teamwork and community management skills.",
                "tr" => "Liderlik, takım çalışması ve topluluk yönetimi becerilerimi geliştirdim."
            ]
        ]
    ],
    [
        "category" => [
            "en" => "Programs & Bootcamps",
            "tr" => "Programlar ve Bootcampler"
        ],
        "date" => "Ongoing Learning",
        "title" => [
            "en" => "Technical Training and Online Internship Programs",
            "tr" => "Teknik Eğitimler ve Online Staj Programları"
        ],
        "company" => "DenizBank, Techcareer.net, BTK Academy, Udemy",
        "description" => [
            "en" => "Participated in online internship programs, bootcamps and technical trainings across finance, banking, mobile development and artificial intelligence.",
            "tr" => "Finans, bankacılık, mobil geliştirme ve yapay zekâ gibi farklı alanlarda online staj programları, bootcampler ve teknik eğitimlere katıldım."
        ],
        "items" => [
            [
                "en" => "Completed DenizBank Denizaşırı Online Internship Program and gained insight into banking, finance and digital transformation.",
                "tr" => "DenizBank Denizaşırı Online Staj Programı’nı tamamlayarak bankacılık, finans ve dijital dönüşüm alanlarında bilgi edindim."
            ],
            [
                "en" => "Successfully completed SwiftUI Bootcamp and improved iOS development skills.",
                "tr" => "SwiftUI Bootcamp programını başarıyla tamamlayarak iOS geliştirme becerilerimi güçlendirdim."
            ],
            [
                "en" => "Joined technical events and workshops about AI, software development, databases and career development.",
                "tr" => "Yapay zekâ, yazılım geliştirme, veritabanı ve kariyer gelişimi üzerine teknik etkinliklere ve workshoplara katıldım."
            ],
            [
                "en" => "Continued improving through hands-on learning, bootcamps and project-based practice.",
                "tr" => "Uygulamalı öğrenme, bootcampler ve proje tabanlı pratiklerle kendimi geliştirmeye devam ettim."
            ]
        ]
    ]
];

/**
 * PROJELER BÖLÜMÜ VERİSİ
 * 
 * Portföy projesi vitrini şu bilgiler ile:
 * - Proje adı/başlığı
 * - Kategori/tür (çok dilli)
 * - Proje açıklaması (çok dilli)
 * - Kullanılan teknolojiler (teknoloji adlarından oluşan dizi)
 * - GitHub depo linki
 * 
 * Projeler grid düzeninde kartlar halinde gösterilir
 * Her kart projenin GitHub deposuna bağlanır
 */
$projects = [
    [
        "title" => "CineScope",
        "category" => [
            "en" => "AI-Powered iOS Movie App",
            "tr" => "Yapay Zekâ Destekli iOS Film Uygulaması"
        ],
        "description" => [
            "en" => "CineScope is an iOS movie recommendation app that helps users discover films based on their preferences. The project focuses on OpenAI API integration, recommendation flows, UIKit-based screen structure and a clean mobile user experience.",
            "tr" => "CineScope, kullanıcıların ilgi alanlarına göre film keşfetmesini sağlayan bir iOS film öneri uygulamasıdır. Projede OpenAI API entegrasyonu, öneri akışları, UIKit tabanlı ekran yapısı ve temiz bir mobil kullanıcı deneyimi üzerine çalışılmıştır."
        ],
        "tech" => ["Swift", "UIKit", "OpenAI API"],
        "github" => "https://github.com/aysenurkendirci/CineScope-MovieApp"
    ],
    [
        "title" => "PettiCare",
        "category" => [
            "en" => "Pet Care & Routine Tracking App",
            "tr" => "Evcil Hayvan Bakım ve Rutin Takip Uygulaması"
        ],
        "description" => [
            "en" => "PettiCare is an iOS application designed to manage multiple pet profiles, care routines and pet-related information. It includes features such as routine tracking, nearby veterinarians on map, favorite vets and Apple Maps directions.",
            "tr" => "PettiCare, birden fazla evcil hayvan profili, bakım rutinleri ve evcil hayvan bilgilerini yönetmek için geliştirilen bir iOS uygulamasıdır. Rutin takibi, haritada yakın veterinerleri görme, favori veteriner ekleme ve Apple Maps yönlendirme özelliklerini içerir."
        ],
        "tech" => ["Swift", "SwiftUI", "SwiftData", "MapKit"],
        "github" => "https://github.com/aysenurkendirci/PettiCareApp"
    ],
    [
        "title" => "HeyDOU Campus",
        "category" => [
            "en" => "Campus Management Platform",
            "tr" => "Kampüs Yönetim Platformu"
        ],
        "description" => [
            "en" => "HeyDOU is a web-based campus management platform developed as an academic team project. The project brings academic calendar, cafeteria, events, clubs, internship tracking and campus map features into a single user-friendly system.",
            "tr" => "HeyDOU, akademik ekip projesi olarak geliştirilen web tabanlı bir kampüs yönetim platformudur. Akademik takvim, yemekhane, etkinlikler, kulüpler, staj takibi ve kampüs haritası özelliklerini tek bir kullanıcı dostu sistemde birleştirir."
        ],
        "tech" => ["HTML", "CSS", "C#", "OpenAI Integration"],
        "github" => "https://github.com/aysenurkendirci/Heydou_kamp-s"
    ],
    [
        "title" => "Internship Bank Project",
        "category" => [
            "en" => "Full-Stack Banking Application",
            "tr" => "Full-Stack Bankacılık Uygulaması"
        ],
        "description" => [
            "en" => "A full-stack internship project focused on banking workflows. The project includes Angular-based frontend modules, .NET Core backend logic, Oracle database operations and structured business process management.",
            "tr" => "Bankacılık süreçlerine odaklanan full-stack bir staj projesidir. Projede Angular tabanlı frontend modülleri, .NET Core backend mantığı, Oracle veritabanı işlemleri ve düzenli iş süreci yönetimi yer almaktadır."
        ],
        "tech" => ["Angular", ".NET Core", "Oracle DB"],
        "github" => "https://github.com/aysenurkendirci/Internship_Bank_Project"
    ]
];

/**
 * İLETİŞİM FORMU YAPILANDIRMASI
 * 
 * İletişim formu yapısını tanımlar:
 * - Form giriş metni (çok dilli)
 * - Doğrulama kuralları olan alan tanımları
 * - Gönder düğmesi yapılandırması
 * 
 * Form alanları:
 * - Ad (zorunlu, metin girişi)
 * - E-posta (zorunlu, doğrulamalı e-posta girişi)
 * - Mesaj (zorunlu, textarea)
 * 
 * Tüm form etiketleri, yer tutucu metinleri ve mesajları
 * İngilizce ve Türkçe'yi destekler.
 * Form gönderimi process-form.php tarafından işlenir
 */
$contactForm = [
    "intro" => [
        "en" => "I am open to internship opportunities, junior developer roles and meaningful project collaborations.",
        "tr" => "Staj fırsatlarına, junior geliştirici pozisyonlarına ve anlamlı proje iş birliklerine açığım."
    ],
    "fields" => [
        [
            "id" => "name",
            "name" => "name",
            "type" => "text",
            "label" => [
                "en" => "Name",
                "tr" => "Ad Soyad"
            ],
            "placeholder" => [
                "en" => "Your name",
                "tr" => "Adınızı yazın"
            ],
            "required" => true
        ],
        [
            "id" => "email",
            "name" => "email",
            "type" => "email",
            "label" => [
                "en" => "Email",
                "tr" => "E-posta"
            ],
            "placeholder" => [
                "en" => "your@email.com",
                "tr" => "eposta@ornek.com"
            ],
            "required" => true
        ],
        [
            "id" => "message",
            "name" => "message",
            "type" => "textarea",
            "rows" => 6,
            "label" => [
                "en" => "Message",
                "tr" => "Mesaj"
            ],
            "placeholder" => [
                "en" => "Write your message...",
                "tr" => "Mesajınızı yazın..."
            ],
            "required" => true
        ]
    ],
    "submit" => [
        "text" => [
            "en" => "Send Message",
            "tr" => "Mesaj Gönder"
        ],
        "icon" => "fa-solid fa-paper-plane"
    ]
];
?>