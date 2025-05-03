<?php require_once 'init.php';
require('getapikey.php');

$transaction = $_GET['transaction'] ?? '';
$montant = $_GET['montant'] ?? '';
$vendeur = $_GET['vendeur'] ?? '';
$statut = $_GET['status'] ?? '';
$control = $_GET['control'] ?? '';
$voyageId = $_GET['voyage_id'] ?? ''; 
$hotel = $_GET['hotel'] ?? ''; 


if(empty($transaction) || empty($montant) || empty($vendeur) || empty($statut) || empty($control) || empty($voyageId)){
    die("Erreur : données de retour manquantes.");
}


$api_key = getAPIKey($vendeur);
if(!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)){
    die("Erreur : API Key invalide.");
}


$calculatedControl = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");

if($calculatedControl !== $control){
    die("Erreur : la valeur de contrôle est invalide.");
}

$dataFile = 'dataJSON/fly.json';
$flyData = json_decode(file_get_contents($dataFile), true);

$selectedVoyage = null;
foreach ($flyData as $voyage){
    if($voyage['id'] == $voyageId){
        $selectedVoyage = $voyage;
        break;
    }
}

if(!$selectedVoyage){
    die("Erreur : Voyage non trouvé.");
}


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
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php
    if(isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'clair'){
        echo '<link rel="stylesheet" href="style2.css" />';
    }
    else{
        echo '<link rel="stylesheet" href="style.css" />';
    }
    ?>
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <title>Luxaltura - Payment Status</title>
</head>

<body>
    <header>
        <h1>Luxaltura - Elevate Your Journey, Embrace Prestige</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="150" height="150" class="logo" />
    </header>

    <div class="container">
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

                <a href="userpage.php" class="button">Return to Home</a>
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