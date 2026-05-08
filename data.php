<?php
/*
    DATA FILE
    Bu dosya portfolyo sitesinde kullanılan profil, about, teknoloji,
    deneyim ve proje verilerini tek merkezden yönetir.
*/

$profile = [
    "name" => "Ayşe Nur Kendirci",

    "title" => [
        "en" => "Software Developer",
        "tr" => "Yazılım Geliştirici"
    ],

    "tagline" => [
        "en" => "Building real-world software with passion and continuous growth.",
        "tr" => "Tutkuyla öğrenen ve gerçek dünyaya yönelik yazılımlar geliştiren bir yazılımcı."
    ],

    "description" => [
        "en" => "I build clean, scalable and user-focused applications across mobile, frontend and backend development.",
        "tr" => "Mobil, frontend ve backend alanlarında temiz, ölçeklenebilir ve kullanıcı odaklı uygulamalar geliştiriyorum."
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
/*
    TECH STACK DATA
    Teknoloji kartlarında gösterilen yetenekler burada tutulur.
    Tooltip alanları İngilizce ve Türkçe olarak tanımlanır.
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
                "tooltip" => [
                    "en" => "A programming language used for native iOS app development.",
                    "tr" => "Native iOS uygulamaları geliştirmek için kullanılan programlama dilidir."
                ]
            ],
            [
                "name" => "SwiftUI",
                "icon" => "devicon-swift-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "A modern framework for building iOS interfaces declaratively.",
                    "tr" => "iOS arayüzlerini modern ve sade şekilde geliştirmek için kullanılan frameworktür."
                ]
            ],
            [
                "name" => "UIKit",
                "icon" => "devicon-apple-original",
                "iconText" => "",
                "tooltip" => [
                    "en" => "A classic iOS framework for building app interfaces programmatically.",
                    "tr" => "iOS uygulama arayüzlerini programatik olarak geliştirmek için kullanılan frameworktür."
                ]
            ],
            [
                "name" => "SwiftData",
                "icon" => "devicon-apple-original",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Used for local data storage and persistence in iOS apps.",
                    "tr" => "iOS uygulamalarında yerel veri saklama ve kalıcılık için kullanılır."
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
                    "en" => "A frontend framework used for structured web applications.",
                    "tr" => "Düzenli ve ölçeklenebilir web uygulamaları geliştirmek için kullanılan frontend frameworktür."
                ]
            ],
            [
                "name" => "HTML",
                "icon" => "devicon-html5-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Used to create the structure of web pages.",
                    "tr" => "Web sayfalarının temel yapısını oluşturmak için kullanılır."
                ]
            ],
            [
                "name" => "CSS",
                "icon" => "devicon-css3-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Used to style responsive and modern web interfaces.",
                    "tr" => "Modern ve responsive web arayüzlerini tasarlamak için kullanılır."
                ]
            ],
            [
                "name" => "JavaScript",
                "icon" => "devicon-javascript-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "Used to add interactive behavior to web pages.",
                    "tr" => "Web sayfalarına etkileşim ve dinamik davranış kazandırmak için kullanılır."
                ]
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
                "tooltip" => [
                    "en" => "A programming language commonly used with .NET backend development.",
                    "tr" => ".NET ile backend geliştirme süreçlerinde kullanılan programlama dilidir."
                ]
            ],
            [
                "name" => ".NET Core",
                "icon" => "devicon-dotnetcore-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "A backend framework used for building APIs and web applications.",
                    "tr" => "API ve web uygulamaları geliştirmek için kullanılan backend frameworktür."
                ]
            ],
            [
                "name" => "RESTful API",
                "icon" => "",
                "iconText" => "API",
                "tooltip" => [
                    "en" => "Used for communication between frontend, mobile and backend systems.",
                    "tr" => "Frontend, mobil ve backend sistemleri arasında veri iletişimi sağlamak için kullanılır."
                ]
            ],
            [
                "name" => "SQL Server",
                "icon" => "devicon-microsoftsqlserver-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "A relational database system used for storing and managing data.",
                    "tr" => "Verileri saklamak ve yönetmek için kullanılan ilişkisel veritabanı sistemidir."
                ]
            ],
            [
                "name" => "Oracle",
                "icon" => "devicon-oracle-original colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "An enterprise-level relational database management system.",
                    "tr" => "Kurumsal seviyede kullanılan ilişkisel veritabanı yönetim sistemidir."
                ]
            ],
            [
                "name" => "PHP",
                "icon" => "devicon-php-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "A server-side language used for building dynamic web applications and handling form processing.",
                    "tr" => "Dinamik web uygulamaları geliştirmek ve form işleme için kullanılan sunucu tarafı programlama dilidir."
                ]
            ],
            [
                "name" => "Firebase",
                "icon" => "devicon-firebase-plain colored",
                "iconText" => "",
                "tooltip" => [
                    "en" => "A cloud platform used for database, authentication and backend services.",
                    "tr" => "Veritabanı, kimlik doğrulama ve backend servisleri için kullanılan bulut platformudur."
                ]
            ]
        ]
    ]
];

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

/*
    CONTACT FORM DATA
    İletişim formunun dil desteği (İngilizce-Türkçe) ile
    etiketler, yer tutuculular ve butonu merkezi olarak yönetir.
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