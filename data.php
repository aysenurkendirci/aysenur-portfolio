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
        "en" => "Software Developer",
        "tr" => "Yazılım Geliştirici"
    ],

    "tagline" => [
        "en" => "Building real-world software with passion and continuous growth.",
        "tr" => "Azimle öğrenen ve gerçek dünyaya yönelik yazılımlar geliştiren bir yazılımcı."
    ],

    "description" => [
        "en" => "I build clean, scalable and user-focused applications across mobile, frontend and backend development.",
        "tr" => "Mobil, frontend ve backend alanlarında temiz, ölçeklenebilir ve kullanıcı odaklı uygulamalar geliştiriyorum."
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
/*
    EXPERIENCE DATA
    Deneyim, liderlik ve eğitim/bootcamp bilgileri burada tutulur.
    Bu veriler Experience bölümünde kart yapısı ile dinamik olarak gösterilir.
*/
$experiences = [
    [
        "category" => "Mobile Internship",
        "date" => "Jul 2025 - Sep 2025",
        "title" => "Mobile Application Development Intern",
        "company" => "VakıfBank",
        "description" => "Completed a 2-month mobile development internship and actively contributed to CineScope and PettiCare iOS applications.",
        "items" => [
            "Developed iOS application screens using Swift, UIKit and SwiftUI.",
            "Worked with MVVM architecture, reusable components and clean project structure.",
            "Built base structures for networking, data flow and screen organization.",
            "Integrated OpenAI API features for personalized movie recommendation flows.",
            "Improved practical knowledge of mobile UI design, Firebase, SwiftData and project-based development."
        ]
    ],
    [
        "category" => "Web Internship",
        "date" => "Jan 2026 - Feb 2026",
        "title" => "Software Engineering Intern",
        "company" => "VakıfBank",
        "description" => "Worked on a banking-focused web application and gained experience in frontend, backend and database development.",
        "items" => [
            "Developed frontend modules using Angular, HTML and CSS.",
            "Worked on backend logic with C# and .NET Core.",
            "Practiced RESTful API structure, authentication flow and business logic implementation.",
            "Used Oracle Database, stored procedures and package-based database operations.",
            "Learned clean architecture, repository pattern and Agile development workflow."
        ]
    ],
    [
        "category" => "Leadership",
        "date" => "2025 - Present",
        "title" => "Mobile Technical Team Lead",
        "company" => "GDG On Campus Doğuş University",
        "description" => "Served as the mobile technical team lead and supported both event organization and technical project development.",
        "items" => [
            "Helped organize student-focused software, mobile development and technology events.",
            "Supported team coordination, communication and technical planning.",
            "Contributed to mobile-focused projects and learning activities.",
            "Improved leadership, teamwork and community management skills."
        ]
    ],
    [
        "category" => "Programs & Bootcamps",
        "date" => "Ongoing Learning",
        "title" => "Technical Training and Online Internship Programs",
        "company" => "DenizBank, Techcareer.net, BTK Academy, Udemy",
        "description" => "Participated in online internship programs, bootcamps and technical trainings across finance, banking, mobile development and artificial intelligence.",
        "items" => [
            "Completed DenizBank Denizaşırı Online Internship Program and gained insight into banking, finance and digital transformation.",
            "Successfully completed SwiftUI Bootcamp and improved iOS development skills.",
            "Joined technical events and workshops about AI, software development, databases and career development.",
            "Continued improving through hands-on learning, bootcamps and project-based practice."
        ]
    ]
];

/*
    PROJECTS DATA
    Projects bölümünde gösterilen portfolyo projeleri burada tutulur.
*/
/*
    PROJECTS DATA
    Portfolyo projeleri burada tutulur.
    Her proje İngilizce ve Türkçe açıklama içerir.
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