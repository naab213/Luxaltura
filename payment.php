<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer l'ID du voyage et le prix depuis l'URL (méthode GET)
    $voyage_id = isset($_POST['voyage_id']) ? $_POST['voyage_id'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : '';

    // Débogage - afficher ce que contient 'prix' pour s'assurer que la valeur est correcte
    echo '<pre>';
    print_r($_POST['prix']);  // Affiche la valeur de 'prix'
    echo '</pre>';

    // Vérifier que les informations sont bien passées
    if (empty($voyage_id) || empty($prix)) {
        die('Informations de voyage manquantes.');
    }
    echo "<h2>Reservation for the trip : $voyage_id</h2>";
    echo "<p>Cost : $prix</p>";
}

require('getapikey.php');
$transaction = strtoupper(bin2hex(random_bytes(5))); 

// Vérifier et formater le prix
if (isset($_POST['prix'])) {
    $prix = $_POST['prix'];
    // Supprimer le symbole de l'euro si présent
    $prix = str_replace('€', '', $prix);
    
    // Vérifier que le prix est un nombre valide
    if (is_numeric($prix) && $prix > 0) {
        $prix = number_format($prix, 2, '.', '');  // Formater le prix à 2 décimales
        echo "Prix formaté : " . $prix . "<br>";
    } else {
        die("Error: Invalid or missing amount.");
    }
} else {
    die("Error: Missing price.");
}

$vendeur = "MI-3_I"; 
$retour = trim("http://localhost/return_payment.php?session=12345");
$api_key = getAPIKey($vendeur);

if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
    die("Error : invalid APIkey.");
}

$control = md5($api_key . "#" . $transaction . "#" . $prix . "#" . $vendeur . "#" . $retour . "#");

echo "<h3>Vérification des données envoyées :</h3>";
echo "<pre>";
print_r([
    "API Key" => $api_key,
    "Transaction" => $transaction,
    "Prix" => $prix,
    "Vendeur" => $vendeur,
    "Retour" => $retour,
    "Hash généré" => $control,
    "Hash attendu" => md5($api_key . "#" . $transaction . "#" . $prix . "#" . $vendeur . "#" . $retour . "#")
]);
echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Payment</title>
    </head>

    <body>
        <h2>Payment page</h2>
        <p>Amount due : <?php echo htmlspecialchars($prix); ?> €</p>

        <pre><?php print_r($_POST); ?></pre>

        <form action="https://www.plateforme-smc.fr/cybank/index.php" method='POST'>
            <input type="hidden" name="transaction" value="<?php echo $transaction; ?>">
            <input type="hidden" name="prix" value="<?php echo $prix; ?>">
            <input type="hidden" name="vendeur" value="<?php echo $vendeur; ?>">
            <input type="hidden" name="retour" value="<?php echo $retour; ?>">
            <input type="hidden" name="control" value="<?php echo $control; ?>">
            <button type="submit">Confirm and pay.</button>
        </form>

    </body>

</html>
