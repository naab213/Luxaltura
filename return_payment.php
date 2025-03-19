<?php

$transaction = $_GET['transaction'] ?? '';
$montant = $_GET['montant'] ?? '';
$vendeur = $_GET['vendeur'] ?? '';
$statut = $_GET['statut'] ?? '';
$control = $_GET['control'] ?? '';
require('getapikey.php');
$api_key = getAPIKey($vendeur);
$control_verif = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Payment status</title>
    </head>

    <body>
        <h2>Result</h2>

        <?php if ($control === $control_verif): ?>
            <?php if ($statut === "accepted"): ?>
                <p style="color: green;">Payment accepted.</p>
                <p>Transaction ID : <?php echo htmlspecialchars($transaction); ?></p>
            <?php else: ?>
                <p style="color: red;">Unallowed payment.</p>
            <?php endif; ?>
        <?php else: ?>
            <p style="color: orange;">Data validation error.</p>
        <?php endif; ?>
        <a href="payment.php">Back to web site.</a>

    </body>

</html>