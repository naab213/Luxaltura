<?php require_once 'init.php';

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
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Luxaltura - Bookings</title>
    <?php
    if(isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'clair'){
        echo '<link rel="stylesheet" href="style2.css" />';
    }
    else{
        echo '<link rel="stylesheet" href="style.css" />';
    }
    ?>
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>

<body>
    <header>
        <h1>Choose your package and embark on a unique experience</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
        <div class="auth-links">
            <?php if (isset($_SESSION['user_email'])): ?>
                <a href="userpage.php" title="My Account">My Account</a>
                <a href="logout.php" title="Log out">Log out</a>
            <?php else: ?>
                <a href="sign_in.php" title="Sign in">Sign in</a>
                <a href="sign_up.php" title="Sign up">Sign up</a>
            <?php endif; ?>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="home.php" title="Go to home">Home</a></li>
            <li><a href="presentation.php" title="Our presentation">Presentation</a></li>
            <li><a href="#contact" title="Go to contact">Contact us</a></li>
        </ul>
    </nav>

    <section>
        <div class="container">
            <h2>Search and Filters</h2>
            <form id="search">
                <input type="text" placeholder="Search a country..." id="request" name="request">
                <div class="field">
                    <label for="date">* Select a date to go:</label>
                    <input type="date" id="date" name="date" required min="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="field">
                    <label for="airplane">Select airplane type:</label>
                    <select id="airplane" name="airplane">  
                        <option value="default">None</option>
                        <option value="Buisness">Business Elite✨</option>
                        <option value="Military">Military Experience✈️</option>
                        <option value="Adrenaline">Adrenaline Flight🎢</option>
                        <option value="Future">Future Sky🚀</option>
                    </select>
                </div>

                <div class="field">
                    <label for="continent">Select a continent:</label>
                    <select id="continent" name="continent">
                        <option value="default">None</option>
                        <option value="Africa">Africa 🐫</option>
                        <option value="Asia">Asia ⛩️</option>
                        <option value="Europe">Europe 🏙️</option>
                        <option value="America">America 🌉</option>
                    </select>
                </div>

                <div class="field">
                    <label for="tranch-price">Select a tranch of price:</label>
                    <select id="tranch-price" name="tranch-price">
                        <option value="default">None</option>
                        <option value="price1">1200€ - 4000€ ✨</option>
                        <option value="price2">4100€ - 7000€ ⭐</option>
                        <option value="price3">7100€ - 16000€ 💫</option>
                        <option value="price4">16100€ - 56000€ 🌟</option>
                    </select>
                </div>

                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </section>

    <section id="default-table">
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
    </section>

    <section id="results-section" style="display:none;">
        <div id="voyages-container">
            <table id="search-results" class="image-table"></table>
        </div>
    </section>

    <section>
        <div id="map"></div>
    </section>

    <footer>
        <div id="contact">
            <section>
                <p><br>Contact us</br><a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
            </section>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>

    <script src="JS/filters.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="JS/map.js"></script>
</body>
</html>
