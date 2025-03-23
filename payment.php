<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location: sign_in.php?error=not_connected');
    exit();
}

$userEmail = $_SESSION['user_email'];

require('getapikey.php');
$api_key = getAPIKey("MI-3_I");

$voyageId = $_POST['voyage_id'] ?? '';
$hotel = $_POST['hotel'] ?? '';
$activites = $_POST['activites'] ?? [];

if (empty($voyageId)) {
    die("Erreur : L'ID du voyage est manquant.");
}
if (empty($hotel)) {
    die("Erreur : Le nom de l'hôtel est manquant.");
}

$dataFile = 'dataJSON/fly.json';
if (!file_exists($dataFile)) {
    die("Erreur : Fichier de données des voyages introuvable.");
}

$flyData = json_decode(file_get_contents($dataFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Erreur : Impossible de charger les données du voyage (fichier JSON corrompu).");
}

$selectedVoyage = null;
foreach ($flyData as $voyage) {
    if ($voyage['id'] == $voyageId) {
        $selectedVoyage = $voyage;
        break;
    }
}

if (!$selectedVoyage) {
    die("Erreur : Voyage non trouvé.");
}

$prixBillet = (float)$selectedVoyage['prix'];

$montant = $prixBillet * 2;

list($hotelNom, $hotelPrix) = explode('|', $hotel);
$montant += (float)$hotelPrix;

foreach ($activites as $activite) {
    list($activiteNom, $activitePrix) = explode('|', $activite);
    $montant += (float)$activitePrix;
}

$transactionData = [
    'transaction_id' => strtoupper(bin2hex(random_bytes(5))),
    'montant' => $montant,
    'voyage_id' => $voyageId,
    'hotel' => $hotelNom,
    'activites' => $activites,
    'user_email' => $userEmail,
    'date' => date('Y-m-d H:i:s')
];

$transactionsFile = 'dataJSON/payments.json';
if (file_exists($transactionsFile)) {
    $transactions = json_decode(file_get_contents($transactionsFile), true);
} else {
    $transactions = [];
}

$transactions[] = $transactionData;
file_put_contents($transactionsFile, json_encode($transactions, JSON_PRETTY_PRINT));

$retour = "http://localhost/Luxaltura/return_payment.php?voyage_id=" . urlencode($voyageId) . "&hotel=" . urlencode($hotelNom);

$control = md5($api_key . "#" . $transactionData['transaction_id'] . "#" . $montant . "#MI-3_I#" . $retour . "#");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <title>Luxaltura - Payment</title>
   
</head>
<body>
    <header>
        <h1>Luxaltura - Elevate Your Journey, Embrace Prestige</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="150" height="150" class="logo" />
    </header>

    <div class="resume-container">
        <div class="resume">
            <section>
                <h2>Payment Summary</h2>
                <!-- Afficher le nom du voyage en premier -->
                <p><strong>Trip:</strong> <?php echo htmlspecialchars($selectedVoyage['ville'] . ', ' . $selectedVoyage['pays']); ?></p>
                <p><strong>Hotel:</strong> <?php echo htmlspecialchars($hotelNom); ?></p>
                <p><strong>Activities:</strong></p>
                <ul>
                    <?php foreach ($activites as $activite): ?>
                        <?php list($activiteNom, $activitePrix) = explode('|', $activite); ?>
                        <li><?php echo htmlspecialchars($activiteNom); ?> - <?php echo htmlspecialchars($activitePrix); ?> €</li>
                    <?php endforeach; ?>
                </ul>
                <p><strong>Total Amount:</strong> <?php echo htmlspecialchars($montant); ?> €</p>

                <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
                    <input type="hidden" name="transaction" value="<?php echo htmlspecialchars($transactionData['transaction_id']); ?>">
                    <input type="hidden" name="montant" value="<?php echo htmlspecialchars($montant); ?>">
                    <input type="hidden" name="vendeur" value="MI-3_I">
                    <input type="hidden" name="retour" value="<?php echo htmlspecialchars($retour); ?>">
                    <input type="hidden" name="control" value="<?php echo htmlspecialchars($control); ?>">
                    <button type="submit" class="button">Confirm and Pay</button>
                </form>
            </section>
        </div>
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
