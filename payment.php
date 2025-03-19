<?php

require('getapikey.php');
$transaction = strtoupper(bin2hex(random_bytes(5))); 
$montant = "100.00"; 
$vendeur = "MI-3_I"; 
$retour = "http://localhost/return_payment.php?session=12345";
$api_key = getAPIKey($vendeur);
if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
    die("Error : invalid APIkey.");
}

$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Payment</title>
    </head>

    <body>
        <h2>Payment page</h2>
        <p>Amount due : <?php echo $montant; ?> €</p>


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
