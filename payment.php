<?php
session_start();

// Check if the temporary file exists and is not empty
$tempDir = 'dataJSON/temp/';
$tempFilePath = $tempDir . 'user_' . (isset($_SESSION['user_email']) ? md5($_SESSION['user_email']) : '') . '.json';

if (!file_exists($tempFilePath) || filesize($tempFilePath) === 0) {
    header("Location: sign_in.php"); // Redirect to login page if not connected
    exit();
}

// Verify the trip ID and amount
if (!isset($_POST['voyage_id']) || !isset($_POST['montant'])) {
    die("Erreur : données de paiement invalides.");
}

$voyageId = $_POST['voyage_id'];
$montant = number_format((float)$_POST['montant'], 2, '.', ''); // Ensure montant is properly formatted

$dataFile = 'dataJSON/fly.json';
$flyData = json_decode(file_get_contents($dataFile), true);

if (!is_array($flyData)) {
    die("Erreur : les données de voyage sont introuvables ou corrompues.");
}

$validVoyage = false;
foreach ($flyData as $voyage) {
    if ($voyage['id'] == $voyageId && $voyage['prix'] == $montant . "€") { // Ensure montant matches the format in fly.json
        $validVoyage = true;
        break;
    }
}

if (!$validVoyage) {
    die("Erreur : le montant ou l'ID du voyage est incorrect.");
}

require('getapikey.php');
$transaction = strtoupper(bin2hex(random_bytes(5))); 
$vendeur = "MI-3_I"; 
$retour = "http://localhost/return_payment.php?session=12345";
$api_key = getAPIKey($vendeur);

if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
    die("Erreur : API Key invalide.");
}

// Generate the control hash
$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour);

if (empty($control)) {
    die("Erreur : la valeur de contrôle est erronée.");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Payment</title>
    </head>

    <body>
        <h2>Payment page</h2>
        <p>Amount due : <?php echo $montant; ?> </p>


        <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">

        <input type="hidden" name="transaction" value="<?php echo $transaction; ?>">
        <input type="hidden" name="montant" value="<?php echo $montant; ?>">

        <input type="hidden" name="vendeur" value="<?php echo $vendeur; ?>">
        <input type="hidden" name="retour" value="<?php echo $retour; ?>">

        <input type="hidden" name="control" value="<?php echo $control; ?>">
        <button type="submit">Confirm and pay.</button>

        </form>

    </body>

</html>