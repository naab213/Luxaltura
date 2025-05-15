<?php
require_once 'init.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_email'])) {
    header('Location: sign_in.php?error=not_connected');
    exit();
}

$userEmail = $_SESSION['user_email'];
require('getapikey.php');
$api_key = getAPIKey("MI-3_I");

if (empty($_POST['reservations']) || empty($_POST['total'])) {
    die("Error: No reservations received.");
}

$reservations = json_decode($_POST['reservations'], true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Invalid JSON data");
}

$totalMontant = (float)$_POST['total'];

$transactionId = strtoupper(bin2hex(random_bytes(5)));

$details = [];
foreach ($reservations as $reservation) {
    $voyageId = $reservation['voyage_id'];
    $hotelNom = $reservation['hotel'];
    $activites = $reservation['activities'] ?? [];
    
    $flyData = json_decode(file_get_contents('dataJSON/fly.json'), true);
    $selectedVoyage = null;
    
    foreach ($flyData as $voyage) {
        if ($voyage['id'] == $voyageId) {
            $selectedVoyage = $voyage;
            break;
        }
    }
    if (!$selectedVoyage) continue;
    
    $selectedHotel = null;
    foreach ($selectedVoyage['hotels'] as $hotel) {
        if ($hotel['nom'] === $hotelNom) {
            $selectedHotel = $hotel;
            break;
        }
    }
    if (!$selectedHotel) continue;
    
    $activitesDetail = [];
    foreach ($activites as $activiteNom) {
        foreach ($selectedVoyage as $key => $liste) {
            if (strpos($key, 'activite') === 0 && is_array($liste)) {
                foreach ($liste as $act) {
                    if ($act['nom'] === $activiteNom) {
                        $activitesDetail[] = $act;
                        break;
                    }
                }
            }
        }
    }
    
    $details[] = [
        'city' => $selectedVoyage['ville'],
        'country' => $selectedVoyage['pays'],
        'flight_price' => (float)$selectedVoyage['prix'],
        'hotel' => $selectedHotel['nom'],
        'hotel_price' => (float)$selectedHotel['prix'],
        'activities' => $activitesDetail
    ];
}

$transactionData = [
    'transaction_id' => $transactionId,
    'amount' => $totalMontant,
    'reservations' => $details,
    'user_email' => $userEmail,
    'date' => date('Y-m-d H:i:s')
];

$transactionsFile = 'dataJSON/payments.json';
$transactions = file_exists($transactionsFile) ? json_decode(file_get_contents($transactionsFile), true) : [];
$transactions[] = $transactionData;
file_put_contents($transactionsFile, json_encode($transactions, JSON_PRETTY_PRINT));

$returnUrl = "http://".$_SERVER['HTTP_HOST']."/Luxaltura/return_payment.php?multi=1";
$control = md5($api_key . "#" . $transactionId . "#" . $totalMontant . "#MI-3_I#" . $returnUrl . "#");

include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Luxaltura - Payment</title>
    <link rel="stylesheet" href="<?= isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'clair' ? 'style2.css' : 'style.css' ?>">
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
<header>
    <img src="https://imgur.com/F38OAQx.jpg" width="150" height="150" class="logo" alt="Luxaltura Logo">
    <h1>Luxaltura - Elevate Your Journey, Embrace Prestige</h1>
    <span class="separator"></span>
</header>

<div class="resume-container">
    <div class="resume">
        <section>
            <h2>Order Summary</h2>
            <?php foreach ($details as $item): ?>
                <div class="item-resume">
                    <p><strong>Destination:</strong> <?= htmlspecialchars($item['city']) ?>, <?= htmlspecialchars($item['country']) ?></p>
                    <p><strong>Hotel:</strong> <?= htmlspecialchars($item['hotel']) ?> - <?= number_format($item['hotel_price'], 2) ?> €</p>
                    <p><strong>Flight:</strong> 2 x <?= number_format($item['flight_price'], 2) ?> € = <?= number_format($item['flight_price'] * 2, 2) ?> €</p>

                    <p><strong>Activities:</strong></p>
                    <?php if (count($item['activities']) > 0): ?>
                        <ul>
                            <?php foreach ($item['activities'] as $act): ?>
                                <li><?= htmlspecialchars($act['nom']) ?> - <?= number_format($act['prix'], 2) ?> €</li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No activities selected.</p>
                    <?php endif; ?>
                    <hr>
                </div>
            <?php endforeach; ?>

            <p><strong>Total Amount:</strong> <?= number_format($totalMontant, 2) ?> €</p>

            <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
                <input type="hidden" name="transaction" value="<?= htmlspecialchars($transactionId) ?>">
                <input type="hidden" name="montant" value="<?= htmlspecialchars($totalMontant) ?>">
                <input type="hidden" name="vendeur" value="MI-3_I">
                <input type="hidden" name="retour" value="<?= htmlspecialchars($returnUrl) ?>">
                <input type="hidden" name="control" value="<?= htmlspecialchars($control) ?>">
                <button type="submit" class="button">Confirm and Pay</button>
            </form>
        </section>
    </div>
</div>

<div class="resume-container" style="text-align: center; margin-top: 30px;">
    <a href="cart.php" class="button" style="margin: 10px;">
        <i class="fas fa-shopping-cart"></i> Back to Cart
    </a>
    <a href="home.php" class="button" style="margin: 10px;">
        <i class="fas fa-home"></i> Back to Home
    </a>
</div>

<footer>
    <div id="contact">
        <section>
            <p>Contact us: <a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
        </section>
    </div>
    <span>2025 | MI-03.I ©</span>
</footer>
</body>
</html>
