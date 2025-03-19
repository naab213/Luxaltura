<?php
$voyages = [
    ["nom" => "Algeria", "image" => "https://content.r9cdn.net/rimg/dimg/92/01/0c6091fc-city-20461-167be288f16.jpg"],
    ["nom" => "Brazil", "image" => "https://wallpaperaccess.com/full/4695115.jpg"],
    ["nom" => "Canada", "image" => "https://5b0988e595225.cdn.sohucs.com/images/20171207/cefea0a8643a4f6abe5b9c3db7decd1b.jpg"],
    ["nom" => "Japan", "image" => "https://imgur.com/vcMkREB.jpg"],
    ["nom" => "Morocco", "image" => "https://mylittlekech.com/wp-content/uploads/2023/05/Marrakech-Capitale-de-la-culture-dans-le-monde-islamique-pour-lannee-2024..jpg"],
    ["nom" => "Oman", "image" => "https://mybayutcdn.bayut.com/mybayut/wp-content/uploads/Travelling-from-Dubai-to-Oman-Cover-02-06.jpg"],
    ["nom" => "Norway", "image" => "https://www.levoyaging.fr/wp-content/uploads/2021/07/NORCTBAL_tromso-circuits-neige-norvege-tui.jpg"],
    ["nom" => "Palestine", "image" => "https://i.imgur.com/S7vq6Zd.jpeg"],
    ["nom" => "Peru", "image" => "https://www.mngturizm.com/tourphotos/peru-bolivya-kolombiya-turu-genel-35393-peru-bolivya-kolombiya-turu-17151740971.jpg"],
    ["nom" => "Spain", "image" => "https://wallpaperaccess.com/full/348472.jpg"]
];

// Liste des voyages (après recherche)
$voyages_search = [
    ["id" => 1,
    "nom" => "Algeria", "ville" => "Algiers ", "pays" => "~ Algeria",
    "pack" => 1,
    "prix" => "8000€",
    "image" => "https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/07/36/9f/cc.jpg",
    "hotels" => [
            ["nom" => "Mercure Algiers Congress Center", "prix" => "930€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/496540607.jpg?k=c4101befb135a0fd8e988c69e60d2cf2c88d6e4b4fa1efc15e5f5b004169e962&o=&hp=1"],
            ["nom" => "Sofitel Algiers Hamma Garden", "prix" => "1540€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/620186988.jpg?k=da13a32456e774d6e628c0249438fd5e602d746a18ff25beff5d45fba1ba18c7&o=&hp=1"],
            ["nom" => "Hotel El Aurassi", "prix" => "1770€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/653737162.jpg?k=95e4cdd69a79d7766648786efc17a113e26883acf4dac649d8820c0c59ed70f7&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit the Casbah of Algiers", "prix" => "20€"],
            ["nom" => "Stroll on Zéralda Beach", "prix" => "Free"]
        ],
    "activite2" => [
            ["nom" => "Discover the Jardin d'Essai", "prix" => "10€"],
            ["nom" => "Visit the National Museum of Fine Arts of Algiers", "prix" => "15€"]
        ],
    "activite3" => [
            ["nom" => "Boat trip to Rachgoun Island", "prix" => "50€"],
            ["nom" => "Walk through El-Mouradia Park", "prix" => "10€"]
        ],
    "activite4" => [
            ["nom" => "Taste traditional Algerian cuisine", "prix" => "30€"],
            ["nom" => "Cable car ride over the Bay of Algiers", "prix" => "25€"]
        ]
    ],

    ["id" => 2,
    "nom" => "Algeria", "ville" => "Oran ", "pays" => "~ Algeria",
    "pack" => 3,
    "prix" => "700€",
    "image" => "https://static-forums.routard.com/original/3X/9/c/9c12f64bd8fe63320ee282440068f3312f0f33fb.jpeg",
    "hotels" => [
            ["nom" => "Le Meridien Oran Hotel", "prix" => "1460€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/442680401.jpg?k=aa15cbdd83b505c0feca5d1ddf1be0950c8cc0edc9f5e8b7dc00fa0497f95a16&o=&hp=1"],
            ["nom" => "Four Points by Sheraton Oran", "prix" => "1780€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/459606485.jpg?k=e7d28cf17abadb02591d435e82658798c53816b7fc109d3d3f246fb3c1c2c819&o=&hp=1"],
            ["nom" => "Royal Hotel Oran - MGallery Hotel Collection", "prix" => "1400€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/614515872.jpg?k=cde6db1fe650b28b9476a99cf0d98341ac18d518b90e622d1583b53da5cf3f6f&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Corniche Beach", "prix" => "Free"],
            ["nom" => "Visit Fort Santa Cruz", "prix" => "10€"]
        ],
    "activite2" => [
            ["nom" => "Explore El Khemis Caves", "prix" => "45€"],
            ["nom" => "Boat trip to the Habibas Islands", "prix" => "60€"]
        ],
    "activite3" => [
            ["nom" => "Guided tour of the Ahmed Zabana Museum", "prix" => "20€"],
            ["nom" => "Walk in El-Madraba Park", "prix" => "10€"]
        ],
    "activite4" => [
            ["nom" => "Seafood tasting", "prix" => "40€"],
            ["nom" => "Traditional dance performance", "prix" => "30€"]
        ]
    ],

    ["id" => 3,
    "nom" => "Brazil", "ville" => "Brasilia ", "pays" => "~ Brazil",
    "pack" => 2,
    "prix" => "1800€",
    "image" => "https://media.istockphoto.com/id/481054970/fr/photo/brasilia-s-cerrado-coucher-du-soleil-pont-jk.jpg?s=612x612&w=0&k=20&c=6l5RyoXCYNax-035G1XxC_nDWBo0po3f_UKgcB-F-ms=",
    "hotels" => [
            ["nom" => "Royal Tulip Brasília Alvorada", "prix" => "1290€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/276540489.jpg?k=dea99efa1dc7a6c3d14928e7e1a27fedf53ba030106e2495a18f249183680a66&o=&hp=1"],
            ["nom" => "Hplus Vision Executive", "prix" => "616€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/619332159.jpg?k=3a7c811db3db4e572866599445711bddf8422bb477e49735ef7a804b6c160e49&o=&hp=1"],
            ["nom" => "Meliá Brasil 21", "prix" => "1200€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/582315684.jpg?k=f0700b96d7d408beec9e0df72a396bfe26056b9e0110dd4451c30029073b5dbd&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit the Modern Architecture of Brasilia", "prix" => "40€"],
            ["nom" => "Discover Lúcio Costa's master plan", "prix" => "30€"]
        ],
    "activite2" => [
            ["nom" => "Boat tour on Lake Paranoá", "prix" => "50€"],
            ["nom" => "Visit the Justice Museum", "prix" => "20€"]
        ],
    "activite3" => [
            ["nom" => "Walk in Brasilia National Park", "prix" => "10€"],
            ["nom" => "Visit the Metropolitan Cathedral of Brasilia", "prix" => "25€"]
        ],
    "activite4" => [
            ["nom" => "Visit the National Museum of Image and Sound", "prix" => "15€"],
            ["nom" => "Taste Brazilian specialties", "prix" => "35€"]
        ]
    ],

    ["id" => 4,
    "nom" => "Brazil", "ville" => "Rio de Janeiro ", "pays" => "~ Brazil",
    "pack" => 3,
    "prix" => "1800€",
    "image" => "https://www.pestana.com/en/destinos/south-america/brazil/rio-janeiro/_jcr_content/root/container/hero_banner/cmp-hero-banner__container__background-image.coreimg.jpeg/1733414709992/herobanner-region-rio-de-janeiro.jpeg",
    "hotels" => [
            ["nom" => "Hilton Copacabana Rio de Janeiro", "prix" => "1340€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/531848788.jpg?k=c12aaf5f4a4ea0d0e08b1ebe19f992149d91e10988e6afcf8767295df7dc7a49&o=&hp=1"],
            ["nom" => "Miramar By Windsor Copacabana", "prix" => "1250€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/52055848.jpg?k=cd36a8df2eb89b004c0cd1e87222a0bfd19135f5e024f4b0467d9a9000893ce1&o=&hp=1"],
            ["nom" => "Rio Othon Palace", "prix" => "1180€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/596700171.jpg?k=ceb8c539ed8de786cac987d5dc09561cd2a37094e4c2c41548b2523d7697d071&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Sugarloaf Mountain Ascent", "prix" => "40€"],
            ["nom" => "Visit Christ the Redeemer", "prix" => "35€"]
        ],
    "activite2" => [
            ["nom" => "Relax at Copacabana Beach", "prix" => "Free"],
            ["nom" => "Discover the Botanical Garden", "prix" => "15€"]
        ],
    "activite3" => [
            ["nom" => "Visit the Museum of Modern Art of Rio", "prix" => "20€"],
            ["nom" => "Walk through Flamengo Park", "prix" => "Free"]
        ],
    "activite4" => [
            ["nom" => "Trip to Paquetá Island", "prix" => "25€"],
            ["nom" => "Caipirinha tasting in a local bar ", "prix" => "15€"]
        ]
    ],

    ["id" => 5,
    "nom" => "Canada","ville" => "Toronto ", "pays" => "~ Canada",
    "pack" => 1,
    "prix" => "28000€",
    "image" => "https://voyages.destinationcanada.com/_next/image?url=https%3A%2F%2Fadmin.destinationcanada.com%2Fsites%2Fdefault%2Ffiles%2Fimages%2Farticle%2Fheader_cn_tower_credit_clifton_li.jpg&w=1920&q=75",
    "hotels" => [
            ["nom" => "DoubleTree by Hilton Toronto Downtown", "prix" => "2100€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/485851061.jpg?k=72112c7280f01f846b2187ca11de831f804589677c4188c75b45311f009aca75&o=&hp=1"],
            ["nom" => "The Novotel Toronto Centre", "prix" => "2120€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/567236522.jpg?k=513ecf00e59832d578600137a1ef0fb9d522560c0588231fc898fddd538c335c&o=&hp=1"],
            ["nom" => "Revery Toronto Downtown, Curio Collection by Hilton", "prix" => "2360€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/575600035.jpg?k=aa4d3a2645d3d9e21c180b43890f7efb33f02fb639790f0a3fe07836f27988de&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit the CN Tower", "prix" => "35€"],
            ["nom" => "Relax on Toronto's Beaches", "prix" => "Free"]
        ],
    "activite2" => [
            ["nom" => "Visit the Royal Ontario Museum", "prix" => "25€"],
            ["nom" => "Explore Toronto Islands", "prix" => "30€"]
        ],
    "activite3" => [
            ["nom" => "Stroll through High Park", "prix" => "Free"],
            ["nom" => "Discover the Art Gallery of Ontario", "prix" => "20€"]
        ],
    "activite4" => [
            ["nom" => "Visit the Ripley's Aquarium", "prix" => "120€"],
            ["nom" => "Taste Poutine", "prix" => "10€"]
        ]
    ],

    ["id" => 6,
    "nom" => "Canada", "ville" => "Montreal ", "pays" => "~ Canada",
    "pack" => 4,
    "prix" => "1000€",
    "image" => "https://content.r9cdn.net/rimg/dimg/0b/56/99204762-city-6966-1629768d60c.jpg?width=1366&height=768&xhint=2136&yhint=1537&crop=true",
    "hotels" => [
            ["nom" => "Best Western Plus Hotel Montreal", "prix" => "1570€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/609093398.jpg?k=4f16434a7421547aaf995790255b18f1cb838ec184b3bce3fe628b0ca015ec27&o=&hp=1"],
            ["nom" => "Humaniti Hotel Montreal, Autograph Collection", "prix" => "2670€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/417801079.jpg?k=57040374b8fb704a006f2023590a6b49c6259a3af734e313a082d3d4f3c480e3&o=&hp=1"],
            ["nom" => "Empire Suites", "prix" => "1060€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/443774083.jpg?k=6ea9f0329138cc0c5f1ff0b5b20546a5daea9017c81066dcee9064bb51be7157&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit Mount Royal", "prix" => "Free"],
            ["nom" => "Relax at Old Montreal’s Waterfront", "prix" => "Free"]
        ],
    "activite2" => [
            ["nom" => "Discover the Montreal Museum of Fine Arts", "prix" => "20€"],
            ["nom" => "Excursion to Sainte-Hélène Island", "prix" => "15€"]
        ],
    "activite3" => [
            ["nom" => "Excursion to Sainte-Hélène Island", "prix" => "25€"],
            ["nom" => "Do Ziplining MTL Zipline", "prix" => "20€"]
        ],
    "activite4" => [
            ["nom" => "Taste Montreal Bagels", "prix" => "10€"],
            ["nom" => "Attend a Cirque du Soleil performance", "prix" => "50€"]
        ]
    ],

    ["id" => 7,
    "nom" => "Japan", "ville" => "Tokyo ", "pays" => "~ Japan",
    "pack" => 3,
    "prix" => "2300€",
    "image" => "https://www.gotokyo.org/fr/plan/tokyo-outline/images/main.jpg",
    "hotels" => [
            ["nom" => "The Prince Park Tower Tokyo", "prix" => "2500€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/133231822.jpg?k=8f4d511aa28b5b58f5b45d1412260d7bc79d9f844b6ec954227d6119c09bfd62&o=&hp=1"],
            ["nom" => "THE BLOSSOM HIBIYA", "prix" => "1940€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/464544703.jpg?k=88b969416d0ae75033131215107e80abb0647c64ac1e94e53824b10f35ed8e1e&o=&hp=1"],
            ["nom" => "Remm plus Ginza", "prix" => "1180€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/243472697.jpg?k=2c98a2fcd935d207d50d58d7d1bf18153e2afcbae01c8d3d92f4a5404541e5f6&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit Senso-ji Temple", "prix" => "Free"],
            ["nom" => "Stroll through Shibuya", "prix" => "Free"]
        ],
    "activite2" => [
            ["nom" => "Visit Tokyo Tower", "prix" => "20€"],
            ["nom" => "Explore Odaiba", "prix" => "25€"]
        ],
    "activite3" => [
            ["nom" => "Discover Ueno Park and its museums", "prix" => "15€"],
            ["nom" => "Visit the Tokyo Palace", "prix" => "35€"]
        ],
    "activite4" => [
            ["nom" => "Sushi tasting at Tsukiji Market", "prix" => "30€"],
            ["nom" => "Walk through Ueno Park", "prix" => "10€"]
        ]
    ],

    ["id" => 8,
    "nom" => "Japan", "ville" => "Kamakura ", "pays" => "~ Japan",
    "pack" => 4,
    "prix" => "2300€",
    "image" => "https://i0.wp.com/www.japan-kudasai.com/wp-content/uploads/hokokuji-kamakura-15.jpg?resize=1080%2C720&ssl=1",
    "hotels" => [
            ["nom" => "Kamakura seizan", "prix" => "1760€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/387122732.jpg?k=bb5f607226d0c10e8b20ce8c0a58eb7d56b744f1d8d95349fe107534bf51b249&o=&hp=1"],
            ["nom" => "Kamakura Prince Hotel", "prix" => "4220€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/541026322.jpg?k=9466dc3ca7e34d7bcf621dfe4aa4e1a164b82c0bf84462982ba2d9e9d6b2e286&o=&hp=1"],
            ["nom" => "Hotel El Aurassi", "prix" => "2290€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/339723970.jpg?k=08a1410066d5c2f9ada7cbad6f1f4cdc5814a021d506f939380806e286dd5d03&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit the Great Buddha", "prix" => "20€"],
            ["nom" => "Relax at Yuigahama Beach", "prix" => "Free"]
        ],
    "activite2" => [
            ["nom" => "Discover Kamakura's Zen Temples", "prix" => "15€"],
            ["nom" => "Visit Kamakura Kokuhokan Museum", "prix" => "10€"]
        ],
    "activite3" => [
            ["nom" => "Excursion to Tsurugaoka Hachimangu Shrine", "prix" => "10€"],
            ["nom" => "Taste local cuisine (shirasu, etc.)", "prix" => "25€"]
        ],
    "activite4" => [
            ["nom" => "Hike to Mount Kamakura", "prix" => "15€"],
            ["nom" => "Bike ride along the coast", "prix" => "20€"]
        ]
    ],
    
    ["id" => 9,
    "nom" => "Morocco", "ville" => "Rabat ", "pays" => "~ Morocco",
    "pack" => 1,
    "prix" => "1200€",
    "image" => "https://www.tracedirecte.com/media/original_images/rabat-maroc.jpg.1920x0_q85_format-jpg.jpg",
    "hotels" => [
            ["nom" => "STORY Rabat", "prix" => "1520€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/39392334.jpg?k=0a6f258bbc7cc8c38a5856754ee5cead9b9e7d687dd8a1ed4059d6b08e0dbd26&o=&hp=1"],
            ["nom" => "Fairmont La Marina Rabat Sale Hotel And Residences", "prix" => "2140€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/529995252.jpg?k=461f7c97dcd1c83659d39d5e8455f85fc86565bca0b8a46d22df3f6025736e20&o=&hp=1"],
            ["nom" => "La Tour Hassan Palace", "prix" => "2170€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/221335239.jpg?k=ec808ffdab048391afd60bccbe22f0e3a4e7f2113301d1a72c6934c33ec995b9&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit the Medina of Rabat", "prix" => "Free"],
            ["nom" => "Explore the Kasbah of the Oudayas", "prix" => "15€"]
        ],
    "activite2" => [
            ["nom" => "Walk through the Andalusian Gardens", "prix" => "Free"],
            ["nom" => "Visit Mohammed VI Museum", "prix" => "20€"]
        ],
    "activite3" => [
            ["nom" => "Excursion to Harhoura Beach", "prix" => "Free"],
            ["nom" => "Taste Tajine at the Souk", "prix" => "20€"]
        ],
    "activite4" => [
            ["nom" => "Visit the Mausoleum of Mohammed V", "prix" => "10€"],
            ["nom" => "Tour Hassan Tower", "prix" => "5€"]
        ]
    ],
    
    ["id" => 10,
    "nom" => "Morocco", "ville" => "Casablanca ", "pays" => "~ Morocco",
    "pack" => 3,
    "prix" => "600€",
    "image" => "https://media.istockphoto.com/id/544676786/fr/photo/mosqu%C3%A9e-de-casablanca.jpg?s=612x612&w=0&k=20&c=Ghdq0SbzJ_uyVvi9NDrwgK6O6aeZMhoamW2S3aWNUkA=",
    "hotels" => [
            ["nom" => "Melliber Appart Hotel", "prix" => "560€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/116293005.jpg?k=7019c47372557b2322385d225b99f799e662ba27077d708ffdc5457c197cbb78&o=&hp=1"],
            ["nom" => "Idou Anfa Hôtel & Spa", "prix" => "880€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/343027645.jpg?k=2836b92ca2e0432cbf75950d0967778abf3df6418e4ca99b523e472fa76aacd6&o=&hp=1"],
            ["nom" => "Suite Loc Luxury Aparthotel", "prix" => "560€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/197239458.jpg?k=fd4dea3d8084e7c00e85945e2e6e7eb9d45de40e96bf3cfd49beee73fc923afa&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit Hassan II Mosque", "prix" => "20€"],
            ["nom" => "Relax at Ain Diab Beach", "prix" => "Free"]
        ],
    "activite2" => [
            ["nom" => "Explore the Habous Quarter", "prix" => "Free"],
            ["nom" => "Visit the Villa des Arts Museum", "prix" => "15€"]
        ],
    "activite3" => [
            ["nom" => "Taste Pastilla", "prix" => "15€"],
            ["nom" => "Stroll through the Arab League Park", "prix" => "Free"]
        ],
    "activite4" => [
            ["nom" => "Visit the foundation museum", "prix" => "20€"],
            ["nom" => "Visit Place Mohammed V", "prix" => "Free"]
        ]
    ],
    
    ["id" => 11,
    "nom" => "Oman", "ville" => "Muscat ", "pays" => "~ Oman",
    "pack" => 2,
    "prix" => "3500€",
    "image" => "https://i.f1g.fr/media/cms/orig/2021/04/02/3e086c3301219b2d4a717b60251d7ac25e3eb9a48d317889c81db48983052a42.jpg",
    "hotels" => [
            ["nom" => "InterContinental Muscat by IHG", "prix" => "1260€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/346329629.jpg?k=38cca51668a3e6071b56aafa25083a68c4a0fe3c1f47ccd8b25917735b781f31&o=&hp=1"],
            ["nom" => "The St Regis Al Mouj Muscat Resort", "prix" => "3450€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/654120674.jpg?k=73c56d7da0ba7935ee26a7cd77e6a4bfa53bed2a8a46c9c56adfd862fa4f5bf6&o=&hp=1"],
            ["nom" => "Kempinski Hotel Muscat", "prix" => "1270€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/134785309.jpg?k=99e27a83064632893a8301c0bf41578d054bba8b15d56694338db06c8d0e7dfa&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit the Sultan Qaboos Grand Mosque", "prix" => "Free"],
            ["nom" => "Explore Muttrah Souq", "prix" => "10€"]
        ],
    "activite2" => [
            ["nom" => "Visit Al Jalali Fort", "prix" => "25€"],
            ["nom" => "Relax in Qurum Park", "prix" => "Free"]
        ],
    "activite3" => [
            ["nom" => "Visit the National Museum of Oman", "prix" => "15€"],
            ["nom" => "Taste Omani cuisine", "prix" => "20€"]
        ],
    "activite4" => [
            ["nom" => "Boat tour to Qantab Beach", "prix" => "30€"],
            ["nom" => "Hike in Al Hajar Mountains", "prix" => "40€"]
        ]
    ],
    
    ["id" => 12,
    "nom" => "Oman", "ville" => "Nizwa ", "pays" => "~ Oman",
    "pack" => 3,
    "prix" => "8000€",
    "image" => "https://www.rivagesdumonde.be/media/contentmanager/content/repeater_block_media_layout/images/550x400_9-Oman-Liwa%C2%A9HartingPhotography-AdobeStock_125960906-2.jpg",
    "hotels" => [
            ["nom" => "Antique Inn", "prix" => "720€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/274258462.jpg?k=fe8887a18b6eebd301cee00ba5481e6d68dc5d8cc3bf3ffdb74349ece10abfc8&o=&hp=1"],
            ["nom" => "Bait Almuallem By Nomad", "prix" => "720€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1024x768/589791430.jpg?k=00a79f73ee8c43ae3c56d1853969dd2e3c818bdb594ad5d0c48d8ffe824aa613&o="],
            ["nom" => "Golden Tulip Nizwa Hotel", "prix" => "820€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/579063001.jpg?k=1e36dc4abd202fe16aece4be81de61a8d55f8c88f1c901bc4f5a3b353bd22827&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit Nizwa Fort", "prix" => "10€"],
            ["nom" => "Explore Nizwa Souq", "prix" => "Free"]
        ],
    "activite2" => [
            ["nom" => "Excursion to Jebel Akhdar Mountain", "prix" => "40€"],
            ["nom" => "Desert adventure in Wahiba Sands", "prix" => "50€"]
        ],
    "activite3" => [
            ["nom" => "Visit the Archaeology Museum", "prix" => "15€"],
            ["nom" => "Visit Jabrin Fort", "prix" => "30€"]
        ],
    "activite4" => [
            ["nom" => "Taste Omani coffee", "prix" => "10€"],
            ["nom" => "Trekking to Misfat al Abriyeen village", "prix" => "30€"]
        ]
    ],
    
    ["id" => 13,
    "nom" => "Norway", "ville" => "Oslo ", "pays" => "~ Norway",
    "pack" => 1,
    "prix" => "8000€",
    "image" => "https://images.photowall.com/products/53563/oslo-cityscape-by-night-norway.jpg?h=699&q=85",
    "hotels" => [
            ["nom" => "Scandic Holmenkollen Park", "prix" => "980€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/403373040.jpg?k=ddba7eaf161b2031118038203c215940bac474bd78a05a02d66ee857be8ae39c&o=&hp=1"],
            ["nom" => "Clarion Hotel The Hub", "prix" => "1680€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/186372958.jpg?k=889d4b16ee762b28280b3168bb0b73687118f53e4e29b43621205c05ba3b8f58&o=&hp=1"],
            ["nom" => "Radisson Blu Plaza Hotel, Oslo", "prix" => "1870€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/497071828.jpg?k=cd64e05b9fd506e971a86844468e8fcac1876fae772e57d401fad9aa4e64e38c&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit the Viking Ship Museum", "prix" => "20€"],
            ["nom" => "Explore Vigeland Sculpture Park", "prix" => "Free"]
        ],
    "activite2" => [
            ["nom" => "Cruise on the Oslo Fjord", "prix" => "40€"],
            ["nom" => "Visit the Munch Museum", "prix" => "15€"]
        ],
    "activite3" => [
            ["nom" => "Walk through Aker Brygge", "prix" => "Free"],
            ["nom" => "Excursion to the Royal Palace", "prix" => "30€"]
        ],
    "activite4" => [
            ["nom" => "Cross-country skiing at Holmenkollen", "prix" => "30€"],
            ["nom" => "Taste Norwegian salmon", "prix" => "20€"]
        ]
    ],
    
    ["id" => 14,
    "nom" => "Norway", "ville" => "Tromsø ", "pays" => "~ Norway",
    "pack" => 4,
    "prix" => "620€",
    "image" => "https://static.nationalgeographic.fr/files/styles/image_3200/public/gettyimages-1446646686.jpg?w=1600&h=1067",
    "hotels" => [
            ["nom" => "Tromsø Lodge & Camping", "prix" => "1500€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/542580170.jpg?k=46f9bd8310cf28f936c100700993bff49e22e44881641a2b52fb2a76bd9ad1e8&o=&hp=1"],
            ["nom" => "Clarion Hotel The Edge", "prix" => "1200€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/36436687.jpg?k=2450e14465bd27bb700339ed468fa578318b6cb13cdc14c6598844644cdfe0d6&o=&hp=1"],
            ["nom" => "The Dock 69 39 by Scandic", "prix" => "1650€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/654415213.jpg?k=af71c612181ced20da7ca186d0e979b14cf780f1cb5c3514ea7134c8bd47c49d&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "See the Northern Lights", "prix" => "50€"],
            ["nom" => "Visit the Polar Museum", "prix" => "15€"]
        ],
    "activite2" => [
            ["nom" => "Dog sledding safari", "prix" => "80€"],
            ["nom" => "Boat trip through the fjords", "prix" => "40€"]
        ],
    "activite3" => [
            ["nom" => "Walk around Tromsø Island", "prix" => "Free"],
            ["nom" => "Taste local cuisine (reindeer stew, etc.)", "prix" => "30€"]
        ],
    "activite4" => [
            ["nom" => "Hike Mount Storsteinen", "prix" => "25€"],
            ["nom" => "Snowmobile adventure", "prix" => "70€"]
        ]
    ],
    
    ["id" => 15,
    "nom" => "Palestine", "ville" => "Gaza ", "pays" => "~ Palestine",
    "pack" => 1,
    "prix" => "2000€",
    "image" => "https://www.shutterstock.com/image-photo/alaqsa-mosque-palestine-jerusalem-israel-600nw-2374849427.jpg",
    "hotels" => [
            ["nom" => "Al-Quds Luxury Hotel", "prix" => "1050€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/607619910.jpg?k=1075eada277b79920844a12ef80c690015808b1c246605946af3e27abfcfb733&o=&hp=1"],
            ["nom" => "Gaza Bay Resort & Spa", "prix" => "1200€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/280048310.jpg?k=d76a9eada1690ee94500a9ca4d5b7ace69f27c37eac71a0755b83fba65cca1ae&o=&hp=1"],
            ["nom" => "Palestine Heights Hotel", "prix" => "990€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/622574583.jpg?k=981b66154c79d726e2ab497f3b01da8cad524f70f4374f623c816a0f0cf9ad53&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit Al-Aqsa Mosque", "prix" => "Free"],
            ["nom" => "Relax at Gaza Beach", "prix" => "Free"]
        ],
    "activite2" => [
            ["nom" => "Explore Ancient Gaza City", "prix" => "10€"],
            ["nom" => "Visit Gaza Museum", "prix" => "15€"]
        ],
    "activite3" => [
            ["nom" => "Taste Maftoul", "prix" => "20€"],
            ["nom" => "Excursion in Gaza's Mountains", "prix" => "25€"]
        ],
    "activite4" => [
            ["nom" => "Visit Al-Omari Mosque", "prix" => "Free"],
            ["nom" => "Stroll through Al-Shuja'iya Neighborhood", "prix" => "Free"]
        ]
    ],
   
    ["id" => 16,
    "nom" => "Palestine", "ville" => "Azzun ", "pays" => "~ Palestine",
    "pack" => 3,
    "prix" => "1500€",
    "image" => "https://medias.voyageons-autrement.com/gallery/2018/07/village_Sabastya_palestine_olivier-565x318.jpg",
    "hotels" => [
            ["nom" => "Azzun Garden Palace Hotel", "prix" => "840€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/438075657.jpg?k=a31ee8bf53707feb4f5373af2699076751c84a854e57dfef587a450ec9c6ccf7&o=&hp=1"],
            ["nom" => "Olive Tree Luxury Resort", "prix" => "980€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/521409819.jpg?k=02e9647c15b08c99f9d60cd44b7020fd4ad661fac48cb697ec29442ff13d9259&o=&hp=1"],
            ["nom" => "Mount Azzun Grand Hotel", "prix" => "1430€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/531025699.jpg?k=0f03190127b429499d9126a82025f312202b907245dd2ba8a81270ab1d939aec&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit Azzun Archaeological Sites", "prix" => "10€"],
            ["nom" => "Explore Olive Groves", "prix" => "15€"]
        ],
    "activite2" => [
            ["nom" => "Hike around Azzun", "prix" => "20€"],
            ["nom" => "Visit Traditional Villages", "prix" => "Free"]
        ],
    "activite3" => [
            ["nom" => "Taste Fresh Fruits", "prix" => "10€"],
            ["nom" => "Visit Olive Oil Mills", "prix" => "10€"]
        ],
    "activite4" => [
            ["nom" => "Excursion to Samaria Mountain", "prix" => "25€"],
            ["nom" => "Visit the Local Mosque", "prix" => "Free"]
        ]
    ],
   
    ["id" => 17,
    "nom" => "Peru", "ville" => "Lima ", "pays" => "~ Peru",
    "pack" => 1,
    "prix" => "940€",
    "image" => "https://content.r9cdn.net/rimg/dimg/9b/c5/d5c7611f-city-2270-16441b01e36.jpg?width=1366&height=768&xhint=1623&yhint=912&crop=true",
    "hotels" => [
            ["nom" => "Radisson Hotel Decapolis Miraflores", "prix" => "880€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/614222513.jpg?k=27478d38108cf6d016de3143b87f522e1788e43961ab4a1bc514dc8f054116c0&o=&hp=1"],
            ["nom" => "Jose Antonio Deluxe", "prix" => "690€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/510194373.jpg?k=b1168ac419a1d82e03829ef07ee870980532edb3d979f5701af4112d3b83fab5&o=&hp=1"],
            ["nom" => "LIMA SUITE holidays & home office", "prix" => "460€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/535759273.jpg?k=588f57528c83496ba4423a4211674959e0bba93bfbfc033f00989f4b4eca862b&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit Plaza Mayor", "prix" => "Free"],
            ["nom" => "Discover Larco Museum", "prix" => "20€"]
        ],
    "activite2" => [
            ["nom" => "Walk through Miraflores", "prix" => "Free"],
            ["nom" => "Ceviche tasting", "prix" => "20€"]
        ],
    "activite3" => [
            ["nom" => "Visit Lima Cathedral", "prix" => "10€"],
            ["nom" => "Excursion to Ballestas Islands", "prix" => "50€"]
        ],
    "activite4" => [
            ["nom" => "Visit Kennedy Park", "prix" => "Free"],
            ["nom" => "Visit the Reserve Park", "prix" => "20€"]
        ]
    ],
    
    ["id" => 18,
    "nom" => "Peru", "ville" => "Ayacucho ", "pays" => "~ Peru",
    "pack" => 3,
    "prix" => "1500€",
    "image" => "https://cdn.getyourguide.com/img/tour/4ca0ef5db7327e27cddafaf7c1b8a007562d4e3a417a73f5312fe63746b295ea.png/148.jpg",
    "hotels" => [
            ["nom" => "Hotel SumacPlaza","prix" => "370€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/621300123.jpg?k=adf42218de95f390152e1895d2ea0ffcdc747a2c5d9bd9bcaf6495b784cfa9de&o=&hp=1"],
            ["nom" => "Hotel LAS FLORES", "prix" => "350€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/618986827.jpg?k=e15b01055dd80d20f1b3768d40a5c3824d97d55a484c7b287ef9b839e6f2db2b&o=&hp=1"],
            ["nom" => "Platero Hotel", "prix" => "320€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/644339831.jpg?k=57a36bc1ed09268b183e65dd33aa164b673b2297e49ae4701afb5b957731a38e&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit Colonial Churches", "prix" => "Free"],
            ["nom" => "Explore Wari Archaeological Site", "prix" => "25€"]
        ],
    "activite2" => [
            ["nom" => "Taste Pachamanca", "prix" => "20€"],
            ["nom" => "Hike the Valley Mountains", "prix" => "30€"]
        ],
    "activite3" => [
            ["nom" => "Excursion to Paca Lagoon", "prix" => "40€"],
            ["nom" => "Visit of the Cañones de Qorihuillca", "prix" => "45€"]
        ],
    "activite4" => [
            ["nom" => "Visit the Religious Art Museum", "prix" => "10€"],
            ["nom" => "Explore Vilcashuamán Region", "prix" => "35€"]
        ]
    ],
   
    ["id" => 19,
    "nom" => "Spain", "ville" => "Madrid ", "pays" => "~ Spain",
    "pack" => 1,
    "prix" => "2400€",
    "image" => "https://www.okvoyage.com/wp-content/uploads/2019/10/visiter-Madrid.jpg",
    "hotels" => [
            ["nom" => "Motel One Madrid-Plaza de España", "prix" => "710€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/583696720.jpg?k=c5a880e5f6d267af36b579b945fec7dd4dbae6ffa15bb97bccda94b8cd40aa6c&o=&hp=1"],
            ["nom" => "Eurostars Central", "prix" => "830€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/95705294.jpg?k=13e308249bbf901b685e4ac0d715982ca6614b01061c052688be16343dd28864&o=&hp=1"],
            ["nom" => "Elba Madrid Alcalá", "prix" => "770€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/152344047.jpg?k=8eea1aba3062a0bc5aad629a78e0e9c70432489039d154b4f0aa527647fd348c&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit the Prado Museum", "prix" => "20€"],
            ["nom" => "Discover Retiro Park", "prix" => "Free"]
        ],
    "activite2" => [
            ["nom" => "Visit the Royal Palace of Madrid", "prix" => "25€"],
            ["nom" => "Stroll through Puerta del Sol", "prix" => "Free"]
        ],
    "activite3" => [
            ["nom" => "Tapas Tasting ", "prix" => "15€"],
            ["nom" => "Explore Plaza Mayor", "prix" => "Free"]
        ],
    "activite4" => [
            ["nom" => "Visit Plaza de Cibeles", "prix" => "Free"],
            ["nom" => "Flamenco Show", "prix" => "30€"]
        ]
    ],
   
    ["id" => 20,
    "nom" => "Spain", "ville" => "Valencia ", "pays" => "~ Spain",
    "pack" => 3,
    "prix" => "2500€",
    "image" => "https://cdn.generationvoyage.fr/2020/01/guide-voyage-valence.jpg",
    "hotels" => [
            ["nom" => "MYR Marqués House", "prix" => "1500€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/164828689.jpg?k=935dc9fc04d307e6657864eb5011457c1f9b6786d137def086d3c4bb75265f73&o=&hp=1"],
            ["nom" => "Hotel Medium Valencia", "prix" => "1060€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/493525675.jpg?k=abb6c7f89b682b9809a472cefb59176a8fdcbc80d6c2a9c2479f69127c63a33c&o=&hp=1"],
            ["nom" => "One Shot Reina Victoria", "prix" => "1220€", "image" => "https://cf.bstatic.com/xdata/images/hotel/max1280x900/71555424.jpg?k=be7e8b33d491e33f85df0a33bbadefb0c29d243227738180d75a073f72b48a05&o=&hp=1"]
        ],
    "activite1" => [
            ["nom" => "Visit the City of Arts and Sciences", "prix" => "30€"],
            ["nom" => "Taste Paella", "prix" => "20€"]
        ],
    "activite2" => [
            ["nom" => "Stroll through Turia Park", "prix" => "Free"],
            ["nom" => "Discover Oceanografico", "prix" => "25€"]
        ],
    "activite3" => [
            ["nom" => "Visit Valencia Old Town", "prix" => "Free"],
            ["nom" => "Visit Biopark Valencia", "prix" => "65€"]
        ],
    "activite4" => [
            ["nom" => "Cycle through Albufera Gardens", "prix" => "20€"],
            ["nom" => "Visit Albufera Rice Fields", "prix" => "30€"]
        ]
    ]
];

$packs = [
    1 => "Business Elite✨",
    2 => "Military Experience✈️",
    3 => "Adrenaline Flight🎢",
    4 => "Future Sky🚀"
];

$search = isset($_GET['request']) ? $_GET['request'] : '';

$filtered_voyages = array_filter($voyages_search, function($voyage) use ($search) {
    return stripos($voyage['nom'], $search) !== false;
});

$is_searching = !empty($search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <title>Luxaltura - Bookings</title>
</head>

<body>
    <header>
        <h1>Choose your package and embark on a unique experience</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
        <div class="auth-links">
            <a href="sign_in.html" title="Sign in">Sign in</a>
            <a href="sign_up.html" title="Sign up">Sign up</a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="home.html" title="Go to home">Home</a></li>
            <li><a href="presentation.html" title="Our presentation">Presentation</a></li>
            <li><a href="#contact" title="Go to contact">Contact us</a></li>
        </ul>
    </nav>

    <section>
        <div class="container">
            <h2>Search and Filters</h2>
            <form id="search" action="" method="GET">
                <input type="text" placeholder="Search..." id="request" name="request" value="<?php echo htmlspecialchars($search); ?>" required>
    
                <div class="field">
                    <label for="date">Select a date to go:</label>
                    <input type="date" id="date" name="date" required min="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="field">
                    <label for="airplane">Select airplane type:</label>
                    <select id="airplane" name="airplane">
                        <option value="Buisness">Business Elite✨</option>
                        <option value="Military">Military Experience✈️</option>
                        <option value="Adrenaline">Adrenaline Flight🎢</option>
                        <option value="Future">Future Sky🚀</option>
                    </select>
                </div>

                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </section>

    <?php if (!$is_searching): ?>
        <table class="image-table">
            <?php
            $chunks = array_chunk($voyages, 5);
            foreach ($chunks as $chunk): ?>
                <tr>
                    <?php foreach ($chunk as $voyage): ?>
                        <td>
                            <div class="image-container">
                                <img src="<?php echo $voyage['image']; ?>" width="300" height="150">
                                <div class="overlay"><?php echo $voyage['nom']; ?></div>
                            </div>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
        <section>
            <div id="map"></div>
        </section>

    <?php else: ?>
        <?php if (count($filtered_voyages) > 0): ?>
        <table id="search-results" class="image-table">
            <?php 
                foreach ($filtered_voyages as $voyage):
                $unique_id = $voyage['id'];
                $url = "detail.php?id=" . $unique_id . "&date=" . urlencode($_GET['date']) . "&pays=" . urlencode($voyage['pays']);
            ?>
            <tr id="line" onclick="window.location='<?php echo $url; ?>';" style="cursor: pointer;">
                <td>
                    <div class="image-container">
                        <img src="<?php echo $voyage['image']; ?>" width="150" height="100">
                    </div>
                </td>
                <td>
                    <p><?php echo $voyage['ville']; echo $voyage['pays']; ?></p>
                    <p><?php echo $packs[$voyage['pack']] ?? 'Non défini'; ?></p>
                </td>
                <td class="price">
                    <?php echo $voyage['prix']; ?>
                    <span class="price-note">One way only</span>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p><center>No trips found matching your search.</center></p>
        <?php endif; ?>
    <?php endif; ?>

    <footer>
        <div id="contact">
            <section>
                <p><br>Contact us</br><a href = "mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
            </section>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var markers = [
            { lat: 28.0339, lon: 3.06, popup: "Algeria" },
            { lat: -14.235, lon: -51.9253, popup: "Brasil" },
            { lat: 56.1304, lon: -106.3468, popup: "Canada" },
            { lat: 35.6762, lon: 139.6503, popup: "Japan" },
            { lat: 31.634, lon: -7.999, popup: "Morocco" },
            { lat: 21.4735, lon: 55.9232, popup: "Oman" },
            { lat: 60.472, lon: 8.4689, popup: "Norway" },
            { lat: 31.9454, lon: 35.2345, popup: "Palestine" },
            { lat: 48.8566, lon: 2.3522, popup: "Paris" },
            { lat: -9.19, lon: -75.0152, popup: "Peru" },
            { lat: 40.4168, lon: -3.7038, popup: "Spain" },
        ];
        markers.forEach(function(marker) {
            L.marker([marker.lat, marker.lon])
                .addTo(map)
                .bindPopup(marker.popup);
        });
    </script>
</body>
</html>