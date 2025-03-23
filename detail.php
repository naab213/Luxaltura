<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: sign_in.php");
    exit;
}

$dataFile = 'dataJSON/fly.json';
$flyData = json_decode(file_get_contents($dataFile), true);

if (!is_array($flyData)) {
    die('Erreur : les données de voyage sont introuvables ou corrompues.');
}

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id)) {
    die('ID de voyage non valide.');
}

$selected_voyage = null;
foreach ($flyData as $voyage) {
    if ($voyage['id'] == $id) {
        $selected_voyage = $voyage;
        break;
    }
}

if (!$selected_voyage) {
    die('Voyage non trouvé.');
}

$packs = [
    1 => "Business Elite✨",
    2 => "Military Experience✈️",
    3 => "Adrenaline Flight🎢",
    4 => "Future Sky🚀"
];

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

// Debugging: Log the selected voyage details
error_log("Selected Voyage ID: " . $id);
error_log("Selected Voyage Price: " . $selected_voyage['prix']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <title>Détails de Voyage - Luxaltura</title>
    <script>
        function updateReturnDate() {
            var departureDate = document.getElementById('departure').value;
            if (departureDate) {
                var date = new Date(departureDate);
                date.setDate(date.getDate() + 8);
                var day = ("0" + date.getDate()).slice(-2);
                var month = ("0" + (date.getMonth() + 1)).slice(-2);
                var year = date.getFullYear();
                var returnDate = year + "-" + month + "-" + day;
                document.getElementById('return').value = returnDate;
            }
        }
    </script>
</head>
<body class="detail-page">
    <header>
        <h1>Summary of Your Trip</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
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
            <h2 class="title">Trip Details</h2>
            <form action="payment.php" method="POST">
                <input type="hidden" name="voyage_id" value="<?php echo $id; ?>" />
                <input type="hidden" name="montant" value="<?php echo number_format((float)$selected_voyage['prix'], 2, '.', ''); ?>" />
                <input type="hidden" name="hotel" id="hotel" value="" />
                <!-- Debugging: Output the values being sent -->
                <?php error_log("Voyage ID: " . $id); ?>
                <?php error_log("Montant Sent to Payment: " . number_format((float)$selected_voyage['prix'], 2, '.', '')); ?>
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
                        <input type="date" id="departure" name="departure" value="<?php echo $departure_date; ?>" required onchange="updateReturnDate()" />

                        <label for="return">Return Date :</label>
                        <input type="date" id="return" name="return" value="<?php echo $return_date; ?>" readonly required />

                        <h4 class="hot">Choose your hotel :</h4>
                        <select name="hotel" required>
                            <?php foreach ($selected_voyage['hotels'] as $hotel): ?>
                                <option value="<?php echo $hotel['nom']; ?>"><?php echo $hotel['nom']; ?> - <?php echo $hotel['prix']; ?> €</option>
                            <?php endforeach; ?>
                        </select>

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
