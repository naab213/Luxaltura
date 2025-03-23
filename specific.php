
<?php
//FINIIIIIIIIIIIII
$dataFile = 'dataJSON/fly.json';
$flyData = json_decode(file_get_contents($dataFile), true);

// Ensure $flyData is an array
if (!is_array($flyData)) {
    $flyData = [];
}

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
$voyages_search = $flyData; // Use the same data for search functionality

$packs = [
    1 => "Business Elite✨",
    2 => "Military Experience✈️",
    3 => "Adrenaline Flight🎢",
    4 => "Future Sky🚀"
];

$search = isset($_GET['request']) ? trim($_GET['request']) : '';

$filtered_voyages = array_filter($voyages_search, function ($voyage) use ($search) {
    return isset($voyage['nom']) && stripos($voyage['nom'], $search) !== false; // Check 'nom' key and perform search
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
            <a href="sign_in.php" title="Sign in">Sign in</a>
            <a href="sign_up.php" title="Sign up">Sign up</a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="home.php" title="Go to home">Home</a></li>
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
