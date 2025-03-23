<?php
require('getapikey.php');

// Récupérez les paramètres de retour
$transaction = $_GET['transaction'] ?? '';
$montant = $_GET['montant'] ?? '';
$vendeur = $_GET['vendeur'] ?? '';
$statut = $_GET['status'] ?? '';
$control = $_GET['control'] ?? '';
$voyageId = $_GET['voyage_id'] ?? ''; // Vérifiez si voyage_id est défini
$hotel = $_GET['hotel'] ?? ''; // Ajoutez l'hôtel si transmis dans l'URL

// Vérifiez que tous les paramètres sont présents
if (empty($transaction) || empty($montant) || empty($vendeur) || empty($statut) || empty($control) || empty($voyageId)) {
    die("Erreur : données de retour manquantes.");
}

// Récupérez la clé API
$api_key = getAPIKey($vendeur);
if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
    die("Erreur : API Key invalide.");
}

// Recalculez la valeur de contrôle
$calculatedControl = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");

// Vérifiez la valeur de contrôle
if ($calculatedControl !== $control) {
    die("Erreur : la valeur de contrôle est invalide.");
}

// Charger les détails du voyage depuis le fichier JSON
$dataFile = 'dataJSON/fly.json';
$flyData = json_decode(file_get_contents($dataFile), true);

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

// Save payment details to a JSON file
$paymentDataFile = 'dataJSON/payments.json';
$paymentData = file_exists($paymentDataFile) ? json_decode(file_get_contents($paymentDataFile), true) : [];

$paymentData[] = [
    'transaction' => $transaction,
    'montant' => $montant,
    'vendeur' => $vendeur,
    'statut' => $statut,
    'voyageId' => $voyageId,
    'hotel' => $hotel,
    'date' => date('Y-m-d H:i:s')
];

file_put_contents($paymentDataFile, json_encode($paymentData, JSON_PRETTY_PRINT));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <title>Payment Status</title>
</head>

<body>
    <header>
        <h1>Luxaltura - Elevate Your Journey, Embrace Prestige</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="150" height="150" class="logo" />
    </header>

    <div class="resume">
        <section>
            <h2>Payment Summary</h2>
            <p><strong>Transaction ID:</strong> <?php echo htmlspecialchars($transaction); ?></p>
            <p><strong>Selected Trip:</strong> <?php echo $selectedVoyage['ville'] . ', ' . $selectedVoyage['pays']; ?></p>
            <p><strong>Hotel:</strong> <?php echo htmlspecialchars($hotel); ?></p>
            <p><strong>Amount Paid:</strong> <?php echo $montant; ?> €</p>
            <p><strong>Status:</strong> <?php echo $statut === 'accepted' ? 'Accepted' : 'Declined'; ?></p>

            <?php if ($statut === 'accepted'): ?>
                <p>Thank you for your payment! Your reservation has been confirmed.</p>
            <?php else: ?>
                <p>Your payment was declined. Please try again.</p>
            <?php endif; ?>

            <a href="home.php" class="button">Return to Home</a>
        </section>
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
