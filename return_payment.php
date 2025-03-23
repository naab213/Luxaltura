<?php
$transaction = $_GET['transaction'] ?? '';
$prix = $_GET['prix'] ?? '';
$vendeur = $_GET['vendeur'] ?? '';
$statut = $_GET['statut'] ?? '';
$control = $_GET['control'] ?? '';

if (empty($transaction) || empty($prix) || empty($vendeur) || empty($statut) || empty($control)) {
    die('Informations manquantes dans la réponse de paiement.');
}

$retour = "http://localhost/return_payment.php?session=12345";

require('getapikey.php');
$api_key = getAPIKey($vendeur);

$control_verif = md5($api_key . "#" . $transaction . "#" . $prix . "#" . $vendeur . "#" . $statut . "#");

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Status de la transaction</title>
    </head>

    <body>
        <h2>Statut de la transaction</h2>

        <?php if ($control === $control_verif): ?>
            <?php if ($statut === "accepted"): ?>
                <p style="color: green;">Paiement accepté.</p>
                <p>Transaction ID : <?php echo htmlspecialchars($transaction); ?></p>
                <p>Montant payé : <?php echo htmlspecialchars($prix); ?> €</p>
                <p>Merci pour votre paiement. Votre réservation a été confirmée.</p>
            <?php else: ?>
                <p style="color: red;">Paiement refusé ou non autorisé.</p>
                <p>Transaction ID : <?php echo htmlspecialchars($transaction); ?></p>
                <p>Montant : <?php echo htmlspecialchars($prix); ?> €</p>
                <p>Veuillez vérifier vos informations et réessayer.</p>
            <?php endif; ?>
        <?php else: ?>
            <p style="color: orange;">Erreur de validation des données de la transaction.</p>
            <p>Les informations de contrôle ne correspondent pas. Veuillez contacter le support.</p>
        <?php endif; ?>

        <a href="payment.php">Retour au site</a>
    </body>

</html>
