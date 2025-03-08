<?php
$voyages = [
    ["nom" => "Algeria", "image" => "https://content.r9cdn.net/rimg/dimg/92/01/0c6091fc-city-20461-167be288f16.jpg"],
    ["nom" => "Brasil", "image" => "https://wallpaperaccess.com/full/4695115.jpg"],
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
    ["nom" => "Algeria", "ville" => "Alger ", "pays" => "~ Algeria", "activite" => 1, "prix" => "8000€", "image" => "https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/07/36/9f/cc.jpg"],
    ["nom" => "Algeria", "ville" => "Oran ", "pays" => "~ Algeria", "activite" => 3, "prix" => "700€", "image" => "https://static-forums.routard.com/original/3X/9/c/9c12f64bd8fe63320ee282440068f3312f0f33fb.jpeg"],
    ["nom" => "Brasil", "ville" => "Brasilia ", "pays" => "~ Brazil", "activite" => 2, "prix" => "1800€", "image" => "https://media.istockphoto.com/id/481054970/fr/photo/brasilia-s-cerrado-coucher-du-soleil-pont-jk.jpg?s=612x612&w=0&k=20&c=6l5RyoXCYNax-035G1XxC_nDWBo0po3f_UKgcB-F-ms="],
    ["nom" => "Brasil", "ville" => "Rio de Janeiro ", "pays" => "~ Brazil", "activite" => 3, "prix" => "1800€", "image" => "https://www.pestana.com/en/destinos/south-america/brazil/rio-janeiro/_jcr_content/root/container/hero_banner/cmp-hero-banner__container__background-image.coreimg.jpeg/1733414709992/herobanner-region-rio-de-janeiro.jpeg"],
    ["nom" => "Canada", "ville" => "Toronto ", "pays" => "~ Canada", "activite" => 1, "prix" => "28000€", "image" => "https://voyages.destinationcanada.com/_next/image?url=https%3A%2F%2Fadmin.destinationcanada.com%2Fsites%2Fdefault%2Ffiles%2Fimages%2Farticle%2Fheader_cn_tower_credit_clifton_li.jpg&w=1920&q=75"],
    ["nom" => "Canada", "ville" => "Montreal ", "pays" => "~ Canada", "activite" => 4, "prix" => "1000€", "image" => "https://content.r9cdn.net/rimg/dimg/0b/56/99204762-city-6966-1629768d60c.jpg?width=1366&height=768&xhint=2136&yhint=1537&crop=true"],
    ["nom" => "Japan", "ville" => "Tokyo ", "pays" => "~ Japan", "activite" => 3, "prix" => "2300€", "image" => "https://www.gotokyo.org/fr/plan/tokyo-outline/images/main.jpg"],
    ["nom" => "Japan", "ville" => "Kamakura ", "pays" => "~ Japan", "activite" => 4, "prix" => "2300€", "image" => "https://i0.wp.com/www.japan-kudasai.com/wp-content/uploads/hokokuji-kamakura-15.jpg?resize=1080%2C720&ssl=1"],
    ["nom" => "Morocco", "ville" => "Rabat ", "pays" => "~ Morocco", "activite" => 1, "prix" => "1200€", "image" => "https://www.tracedirecte.com/media/original_images/rabat-maroc.jpg.1920x0_q85_format-jpg.jpg"],
    ["nom" => "Morocco", "ville" => "Casablanca ", "pays" => "~ Morocco", "activite" => 3, "prix" => "600€", "image" => "https://media.istockphoto.com/id/544676786/fr/photo/mosqu%C3%A9e-de-casablanca.jpg?s=612x612&w=0&k=20&c=Ghdq0SbzJ_uyVvi9NDrwgK6O6aeZMhoamW2S3aWNUkA="],
    ["nom" => "Oman", "ville" => "Muscat ", "pays" => "~ Oman", "activite" => 2, "prix" => "3500€", "image" => "https://i.f1g.fr/media/cms/orig/2021/04/02/3e086c3301219b2d4a717b60251d7ac25e3eb9a48d317889c81db48983052a42.jpg"],
    ["nom" => "Oman", "ville" => "Nizwa ", "pays" => "~ Oman", "activite" => 3, "prix" => "8000€", "image" => "https://www.rivagesdumonde.be/media/contentmanager/content/repeater_block_media_layout/images/550x400_9-Oman-Liwa%C2%A9HartingPhotography-AdobeStock_125960906-2.jpg"],
    ["nom" => "Norway", "ville" => "Oslo ", "pays" => "~ Norway", "activite" => 1, "prix" => "8000€", "image" => "https://images.photowall.com/products/53563/oslo-cityscape-by-night-norway.jpg?h=699&q=85"],
    ["nom" => "Norway", "ville" => "Tromso ", "pays" => "~ Norway", "activite" => 4, "prix" => "620€","image" => "https://static.nationalgeographic.fr/files/styles/image_3200/public/gettyimages-1446646686.jpg?w=1600&h=1067"],
    ["nom" => "Palestine", "ville" => "Gaza ", "pays" => "~ Palestine", "activite" => 1, "prix" => "2000€", "image" => "https://www.shutterstock.com/image-photo/alaqsa-mosque-palestine-jerusalem-israel-600nw-2374849427.jpg"],
    ["nom" => "Palestine", "ville" => "Azzun ", "pays" => "~ Palestine", "activite" => 3, "prix" => "1500€", "image" => "https://medias.voyageons-autrement.com/gallery/2018/07/village_Sabastya_palestine_olivier-565x318.jpg"],
    ["nom" => "Peru", "ville" => "Lima ", "pays" => "~ Peru", "activite" => 1, "prix" => "940€", "image" => "https://content.r9cdn.net/rimg/dimg/9b/c5/d5c7611f-city-2270-16441b01e36.jpg?width=1366&height=768&xhint=1623&yhint=912&crop=true"],
    ["nom" => "Peru", "ville" => "Ayacucho ", "pays" => "~ Peru", "activite" => 3, "prix" => "1500€", "image" => "https://cdn.getyourguide.com/img/tour/33f47d2e209909255154cd5fc41e92663107f4685113ca265628b894c8aff24d.jpg/68.jpg"],
    ["nom" => "Spain", "ville" => "Madrid ", "pays" => "~ Spain", "activite" => 1,  "prix" => "2400€", "image" => "https://www.okvoyage.com/wp-content/uploads/2019/10/visiter-Madrid.jpg"],
    ["nom" => "Spain", "ville" => "Valencia ", "pays" => "~ Spain", "activite" => 3, "prix" => "2500€", "image" => "https://cdn.generationvoyage.fr/2020/01/guide-voyage-valence.jpg"]
];

$activites = [
    1 => "Business Elite✨",
    2 => "Military Experience✈️",
    3 => "Adrenaline Flight🎢",
    4 => "Future Sky🚀"
];
// Récupérer le terme de recherche
$search = isset($_GET['request']) ? $_GET['request'] : '';

// Filtrer les voyages en fonction du terme de recherche
$filtered_voyages = array_filter($voyages_search, function($voyage) use ($search) {
    return stripos($voyage['nom'], $search) !== false;
});

// Vérifier si une recherche est effectuée
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
                    <input type="date" id="date" name="date" required>
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
        foreach ($filtered_voyages as $voyage): ?>
            <tr id="line">
                    <a href="detail.php?id=<?php echo urlencode($voyage['nom']); ?>">
                        <td>
                            <div class="image-container">
                                <img src="<?php echo $voyage['image']; ?>" width="150" height="100">
                            </div>
                        </td>
                        <td>
                            <p><?php echo $voyage['ville']; echo $voyage['pays']; ?></p>
                            <p><?php echo $activites[$voyage['activite']] ?? 'Non défini'; ?></p>
                        </td>
                        <td class="price">
                            <?php echo $voyage['prix']; ?>
                            <span class="price-note">One way only</span>
                        </td>
                    </a>
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
                <p><br>Contact us</br><a href = "mailto:luxalturaagency@contact.fr">luxalturaagency@contact.fr</a></p>
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
