<?php require_once 'init.php';
if (!isset($_SESSION['user_email'])) {
    header('Location: sign_in.php?error=not_connected');
    exit();
}

$userEmail = $_SESSION['user_email'];

require('getapikey.php');
$api_key = getAPIKey("MI-3_I");

$voyageId = $_POST['voyage_id'] ?? '';
$hotelId = $_POST['hotel'] ?? '';
$activites = $_POST['activites'] ?? [];

if (empty($voyageId)) {
    die("Erreur : L'ID du voyage est manquant.");
}
if (empty($hotelId)) {
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

$selectedHotel = null;
foreach ($selectedVoyage['hotels'] as $hotel) {
    if ($hotel['nom'] === $hotelId) {
        $selectedHotel = $hotel;
        break;
    }
}

if (!$selectedHotel) {
    die("Erreur : L'hôtel sélectionné n'a pas été trouvé.");
}

$hotelNom = $selectedHotel['nom'];
$hotelPrix = (float)$selectedHotel['prix'];

$montant = $prixBillet * 2;
$montant += $hotelPrix;


foreach ($activites as $activiteId) {
    $activiteData = null;
    foreach ($selectedVoyage as $key => $activitesListe) {
        if (strpos($key, 'activite') === 0) {
            foreach ($activitesListe as $activite) {
                if ($activite['nom'] === $activiteId) {
                    $activiteData = $activite;
                    break;
                }
            }
        }
    }

    if ($activiteData) {
        $activiteNom = $activiteData['nom'];
        $activitePrix = (float)$activiteData['prix'];
        $montant += $activitePrix;
    }
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
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
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
    <title>Luxaltura - Paiement</title>
</head>
<body>
    <header>
        <h1>Luxaltura - Élevez Votre Voyage, Embrassez le Prestige</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="150" height="150" class="logo" />
    </header>

    <div class="resume-container">
        <div class="resume">
            <section>
                <h2>Résumé de la commande</h2>
                <p><strong>Voyage:</strong> <?php echo htmlspecialchars($selectedVoyage['ville'] . ', ' . $selectedVoyage['pays']); ?></p>
                <p><strong>Hôtel:</strong> <?php echo htmlspecialchars($hotelNom); ?></p>
                <p><strong>Activités:</strong></p>
                <ul>
                    <?php foreach ($activites as $activiteId): ?>
                        <?php
                            $activiteData = null;
                            foreach ($selectedVoyage as $key => $activitesListe) {
                                if (strpos($key, 'activite') === 0) {
                                    foreach ($activitesListe as $activite) {
                                        if ($activite['nom'] === $activiteId) {
                                            $activiteData = $activite;
                                            break;
                                        }
                                    }
                                }
                            }
                        ?>
                        <?php if ($activiteData): ?>
                            <li><?php echo htmlspecialchars($activiteData['nom']); ?> - <?php echo htmlspecialchars($activiteData['prix']); ?> €</li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <p><strong>Montant total:</strong> <?php echo htmlspecialchars($montant); ?> €</p>

                <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
                    <input type="hidden" name="transaction" value="<?php echo htmlspecialchars($transactionData['transaction_id']); ?>">
                    <input type="hidden" name="montant" value="<?php echo htmlspecialchars($montant); ?>">
                    <input type="hidden" name="vendeur" value="MI-3_I">
                    <input type="hidden" name="retour" value="<?php echo htmlspecialchars($retour); ?>">
                    <input type="hidden" name="control" value="<?php echo htmlspecialchars($control); ?>">
                    <button type="submit" class="button">Confirmer et Payer</button>
                </form>
            </section>
        </div>
    </div>

    <footer>
        <div id="contact">
            <section>
                <p>Contactez-nous : <a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
            </section>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>
</body>
</html>
