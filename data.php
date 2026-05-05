<?php
/*
    DATA FILE
    Bu dosya portfolyo sitesinde kullanılan tüm statik/dinamik içerikleri tutar.

    Amaç:
    - HTML dosyasını kalabalıklaştırmamak
    - Profil, teknoloji, deneyim ve proje verilerini tek merkezden yönetmek
    - Çok dilli içerikleri düzenli bir veri yapısı içinde saklamak
    - Kod okunabilirliğini ve bakım kolaylığını artırmak
*/

/*
    PROFILE DATA
    Portfolyo sahibinin temel bilgileri burada tutulur.
    Bu bilgiler hero, navbar, contact ve sosyal medya alanlarında kullanılır.
*/
$profile = [
    "name" => "Ayşe Nur Kendirci",

    "title" => [
        "en" => "Software Engineering Student",
        "tr" => "Yazılım Mühendisliği Öğrencisi"
    ],

    "tagline" => [
        "en" => "Building clean, modern and maintainable software products.",
        "tr" => "Temiz, modern ve sürdürülebilir yazılım ürünleri geliştiriyorum."
    ],

    "description" => [
        "en" => "I am a software engineering student focused on mobile, frontend and backend development. I enjoy transforming ideas into structured, user-friendly and scalable software solutions.",
        "tr" => "Mobil, frontend ve backend geliştirme alanlarına odaklanan bir yazılım mühendisliği öğrencisiyim. Fikirleri düzenli, kullanıcı dostu ve ölçeklenebilir yazılım çözümlerine dönüştürmeyi seviyorum."
    ],

    "email" => "aysenurkendirciss@gmail.com",
    "linkedin" => "https://www.linkedin.com/in/aysenurkendirci",
    "github" => "https://github.com/aysenurkendirci",

    "cv" => "images/cv.pdf",
    "image" => "images/profile.jpg"
];

/*
    QUICK INFO DATA
    Hero bölümünde küçük bilgi kutuları kullanılmak istenirse bu dizi çağrılabilir.
*/
$quickInfo = [
    [
        "label" => [
            "en" => "Focus",
            "tr" => "Odak"
        ],
        "value" => [
            "en" => "Mobile / Frontend / Backend",
            "tr" => "Mobil / Frontend / Backend"
        ]
    ],
    [
        "label" => [
            "en" => "Main Stack",
            "tr" => "Ana Teknolojiler"
        ],
        "value" => [
            "en" => "Swift, .NET, Angular, PHP",
            "tr" => "Swift, .NET, Angular, PHP"
        ]
    ],
    [
        "label" => [
            "en" => "GitHub",
            "tr" => "GitHub"
        ],
        "value" => [
            "en" => "@aysenurkendirci",
            "tr" => "@aysenurkendirci"
        ]
    ]
];

/*
    ABOUT DATA
    About bölümünde gösterilen açıklama paragraflarıdır.
    Her paragraf İngilizce ve Türkçe olarak saklanır.
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
    TECH STACK DATA
    Tech Stack bölümü kategori bazlı tutulur.
    Böylece HTML tarafında tekrar eden kart yapıları foreach ile oluşturulur.
*/
$techCategories = [
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
                "tooltip" => "A programming language used for native iOS app development."
            ],
            [
                "name" => "SwiftUI",
                "icon" => "devicon-swift-plain colored",
                "iconText" => "",
                "tooltip" => "A modern framework for building iOS interfaces declaratively."
            ],
            [
                "name" => "UIKit",
                "icon" => "devicon-apple-original",
                "iconText" => "",
                "tooltip" => "A classic iOS framework for building app interfaces programmatically."
            ],
            [
                "name" => "SwiftData",
                "icon" => "devicon-apple-original",
                "iconText" => "",
                "tooltip" => "Used for local data storage and persistence in iOS apps."
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
                "tooltip" => "A frontend framework used for structured web applications."
            ],
            [
                "name" => "HTML",
                "icon" => "devicon-html5-plain colored",
                "iconText" => "",
                "tooltip" => "Used to create the structure of web pages."
            ],
            [
                "name" => "CSS",
                "icon" => "devicon-css3-plain colored",
                "iconText" => "",
                "tooltip" => "Used to style responsive and modern web interfaces."
            ],
            [
                "name" => "JavaScript",
                "icon" => "devicon-javascript-plain colored",
                "iconText" => "",
                "tooltip" => "Used to add interactive behavior to web pages."
            ]
        ]
    ],
    [
        "title" => [
            "en" => "Backend & Database",
            "tr" => "Backend ve Veritabanı"
        ],
        "items" => [
            [
                "name" => "C#",
                "icon" => "devicon-csharp-plain colored",
                "iconText" => "",
                "tooltip" => "A programming language commonly used with .NET backend development."
            ],
            [
                "name" => ".NET Core",
                "icon" => "devicon-dotnetcore-plain colored",
                "iconText" => "",
                "tooltip" => "A backend framework used for building APIs and web applications."
            ],
            [
                "name" => "RESTful API",
                "icon" => "",
                "iconText" => "API",
                "tooltip" => "Used for communication between frontend, mobile and backend systems."
            ],
            [
                "name" => "SQL Server",
                "icon" => "devicon-microsoftsqlserver-plain colored",
                "iconText" => "",
                "tooltip" => "A relational database system used for storing and managing data."
            ],
            [
                "name" => "Oracle",
                "icon" => "devicon-oracle-original colored",
                "iconText" => "",
                "tooltip" => "An enterprise-level relational database management system."
            ],
            [
                "name" => "Firebase",
                "icon" => "devicon-firebase-plain colored",
                "iconText" => "",
                "tooltip" => "A cloud platform used for database, authentication and backend services."
            ]
        ]
    ]
];

/*
    EXPERIENCE DATA
    Deneyim ve liderlik bilgileri burada tutulur.
*/
$experiences = [
    [
        "title" => "Software Engineering Intern",
        "company" => "VakıfBank",
        "date" => "Internship",
        "description" => "Gained experience in enterprise software development, backend systems and banking technology workflows."
    ],
    [
        "title" => "Software Engineering Intern",
        "company" => "DenizBank",
        "date" => "Internship",
        "description" => "Worked with software development processes, teamwork practices and financial technology project structures."
    ],
    [
        "title" => "Mobile Team Lead",
        "company" => "GDG On Campus",
        "date" => "Leadership",
        "description" => "Led mobile development activities, supported team coordination and contributed to student developer community events."
    ]
];

/*
    PROJECTS DATA
    Projects bölümünde gösterilen portfolyo projeleri burada tutulur.
*/
$projects = [
    [
        "title" => "CineScope",
        "description" => [
            "en" => "An AI-powered movie recommendation application developed for iOS. This project focuses on recommendation flows, OpenAI API integration and a structured UIKit-based user experience.",
            "tr" => "iOS için geliştirilmiş yapay zekâ destekli bir film öneri uygulamasıdır. Bu proje öneri akışları, OpenAI API entegrasyonu ve UIKit tabanlı düzenli bir kullanıcı deneyimi üzerine odaklanmaktadır."
        ],
        "tech" => ["Swift", "UIKit", "OpenAI API"],
        "github" => "https://github.com/aysenurkendirci/CineScope-MovieApp"
    ],
    [
        "title" => "PettiCare",
        "description" => [
            "en" => "A pet care tracking application designed to help users manage routines and pet-related information in a clean and user-friendly way.",
            "tr" => "Kullanıcıların evcil hayvan rutinlerini ve ilgili bilgileri düzenli ve kullanıcı dostu bir şekilde yönetmesini sağlayan bir evcil hayvan bakım takip uygulamasıdır."
        ],
        "tech" => ["SwiftUI", "MVVM", "SwiftData"],
        "github" => "https://github.com/aysenurkendirci/PettiCareApp"
    ],
    [
        "title" => "HeyDou Campus",
        "description" => [
            "en" => "A campus-focused digital platform project developed with a structured interface and usability-oriented approach.",
            "tr" => "Kampüs odaklı dijital bir platform projesidir. Düzenli arayüz yapısı ve kullanılabilirlik odaklı yaklaşımıyla geliştirilmiştir."
        ],
        "tech" => ["HTML", "CSS", "OpenAI Integration"],
        "github" => "https://github.com/aysenurkendirci/Heydou_kamp-s"
    ],
    [
        "title" => "Internship Bank Project",
        "description" => [
            "en" => "A full-stack internship project developed around banking-related workflows. It includes Angular on the frontend and .NET Core based backend logic.",
            "tr" => "Bankacılık süreçleri etrafında geliştirilmiş full-stack bir staj projesidir. Frontend tarafında Angular, backend tarafında ise .NET Core tabanlı mantık bulunmaktadır."
        ],
        "tech" => ["Angular", ".NET Core", "Oracle DB"],
        "github" => "https://github.com/aysenurkendirci/Internship_Bank_Project"
    ]
];