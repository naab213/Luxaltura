<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: sign_in.php");
    exit;
}

$jsonFile = 'dataJSON/fly.json';
if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $voyages_search = json_decode($jsonContent, true);
} else {
    die('Le fichier JSON n\'a pas été trouvé.');
}

$packs = [
    1 => "Business Elite✨",
    2 => "Military Experience✈️",
    3 => "Adrenaline Flight🎢",
    4 => "Future Sky🚀"
];

$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    die('ID de voyage non valide.');
}

$selected_voyage = null;
foreach ($voyages_search as $voyage) {
    if ($voyage['id'] == $id) {
        $selected_voyage = $voyage;
        break;
    }
}

if (!$selected_voyage) {
    die('Voyage non trouvé.');
}

$departure_date = isset($_GET['date']) ? $_GET['date'] : '';
$return_date = '';

if (!empty($departure_date)) {
    $date_parts = explode('-', $departure_date);
    if (count($date_parts) == 3 && checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
        $return_date = date('Y-m-d', strtotime($departure_date . ' +8 days'));
    } else {
        $departure_date = '';
        $return_date = '';
        echo "<script>alert('Date de départ non valide.');</script>";
    }
}

$duree_vol = $selected_voyage['duree'];
$heure_depart = strtotime("08:00:00");
$heure_arrivee_aller = date("H:i", strtotime("+$duree_vol hours", $heure_depart));
$heure_arrivee_retour = date("H:i", strtotime("+$duree_vol hours", strtotime("08:00:00")));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <title>Détails de Voyage - Luxaltura</title>
</head>
<body class="detail-page">
    <header>
        <h1>Summary of Your Trip</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
        <div class="auth-links">
            <?php if (isset($_SESSION['user_email'])): ?>
                <!-- Afficher ces liens si l'utilisateur est connecté -->
                <a href="userpage.php" title="My Account">My Account</a>
                <a href="logout.php" title="Log out">Log out</a>
            <?php else: ?>
                <!-- Afficher ces liens si l'utilisateur n'est pas connecté -->
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
            <h2 class="title">Trip Details</h2>
            <form action="payment.php" method="POST">
                <input type="hidden" name="voyage_id" value="<?php echo $id; ?>" />
                <input type="hidden" name="montant" value="<?php echo $selected_voyage['prix']; ?>" />
                <div class="voyage-details">
                    <div class="image">
                        <img src="<?php echo $selected_voyage['image']; ?>" alt="Image du voyage"/>
                    </div>
                    <div class="details">
                        <h3><?php echo $selected_voyage['ville'] . ', ' . $selected_voyage['pays']; ?></h3>
                        <p><strong>Activities :</strong> <?php echo $packs[$selected_voyage['pack']] ?? 'Non défini'; ?></p>
                        <p><strong>Price :</strong> <?php echo $selected_voyage['prix']; ?> €</p>
                        <h4 class="hotel">Recommended Hotels :</h4>
                        <ul>
                            <?php foreach ($selected_voyage['hotels'] as $hotel): ?>
                            <li class="hotel-item">
                                <div class="hotel-info">
                                    <strong><?php echo $hotel['nom']; ?></strong><br>
                                    <span><?php echo $hotel['prix']; ?> €</span>
                                </div>
                                <div class="hotel-image">
                                    <img src="<?php echo $hotel['image']; ?>" alt="<?php echo $hotel['nom']; ?>" width="300" height="150" />
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <label for="departure">Departure Date :</label>
                        <input type="date" id="departure" name="departure" value="<?php echo $departure_date; ?>" required />

                        <label for="return">Return Date :</label>
                        <input type="date" id="return" name="return" value="<?php echo $return_date; ?>" readonly required />

                        <h4 class="flight-info">
                            <strong>Flight Departure (Going):</strong> CDG at 08:00 AM<br>
                            <strong>Flight Arrival (Going):</strong> <?php echo $heure_arrivee_aller; ?> at <?php echo isset($selected_voyage['arrive']) ? $selected_voyage['arrive'] : 'N/A'; ?><br><br>
                            <strong>Flight Departure (Return):</strong> <?php echo isset($selected_voyage['arrive']) ? $selected_voyage['arrive'] : 'N/A'; ?> at 08:00 AM<br>
                            <strong>Flight Arrival (Return):</strong> CDG at <?php echo $heure_arrivee_retour; ?>
                        </h4>

                        <h4 class="hot">Choose your hotel :</h4>
                        <select name="hotel" required>
                            <?php foreach ($selected_voyage['hotels'] as $hotel): ?>
                                <option value="<?php echo $hotel['nom']; ?>|<?php echo $hotel['prix']; ?>">
                                    <?php echo $hotel['nom']; ?> - <?php echo $hotel['prix']; ?> €
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <h4 class="act">Choose your activities:</h4>
                        <?php
                        $activites = [
                            'activite1' => $selected_voyage['activite1'],
                            'activite2' => $selected_voyage['activite2'],
                            'activite3' => $selected_voyage['activite3'],
                            'activite4' => $selected_voyage['activite4']
                        ];
                        foreach ($activites as $activite): ?>
                            <select name="activites[]" required>
                                <?php foreach ($activite as $option): ?>
                                    <option value="<?php echo $option['nom']; ?>|<?php echo $option['prix']; ?>">
                                        <?php echo $option['nom']; ?> - <?php echo $option['prix']; ?> €
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endforeach; ?>

                        <div class="button-group">
                            <button type="submit" class="validate-btn">Confirm the reservation</button>
                            <button type="button" class="back-btn" onclick="window.location.href='specific.php'">Return to booking</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <div id="contact">
            <section>
                <p><br>Contact us</br><a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
            </section>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>
</body>
</html>
