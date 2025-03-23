<?php
$jsonFile = 'dataJSON/fly.json';
if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $voyages_search = json_decode($jsonContent, true);
} else {
    die('Le fichier JSON n\'a pas été trouvé.');
}

$packs = [
    1 => "Business Elite✨",
    2 => "Military Experience✈️",
    3 => "Adrenaline Flight🎢",
    4 => "Future Sky🚀"
];

$voyage_id = isset($_POST['voyage_id']) ? $_POST['voyage_id'] : '';
$hotel = isset($_POST['hotel']) ? $_POST['hotel'] : '';
$activites = isset($_POST['activites']) ? $_POST['activites'] : [];
$prix_hotel = isset($_POST['hotel']) ? $_POST['hotel'] : 0;
$prix_voyage = isset($_POST['prix']) ? $_POST['prix'] : 0;
$departure_date = isset($_POST['departure']) ? $_POST['departure'] : '';
$return_date = isset($_POST['return']) ? $_POST['return'] : '';

$selected_voyage = null;
foreach ($voyages_search as $voyage) {
    if ($voyage['id'] == $voyage_id) {
        $selected_voyage = $voyage;
        break;
    }
}

if (!$selected_voyage) {
    die('Voyage non trouvé.');
}

$total_price = $prix_voyage * 2;
$hotel_price = 0;
$activites_price = 0;

foreach ($selected_voyage['hotels'] as $selected_hotel) {
    if ($selected_hotel['nom'] == $hotel) {
        $hotel_price = $selected_hotel['prix'];
    }
}

foreach ($activites as $activite) {
    list($activite_nom, $activite_prix) = explode('|', $activite);
    $activites_price += $activite_prix;
}

$total_price += $hotel_price + $activites_price;

$transaction = uniqid("txn_");
$prix = $total_price;
$vendeur = "MI-3_I";
$retour = "return_payment.php";

require('getapikey.php');
$api_key = getAPIKey($vendeur);

$control = md5($api_key . "#" . $transaction . "#" . $prix . "#" . $vendeur . "#");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <title>Luxaltura - Payment</title>
</head>
<body class="payment-page">
    <header>
        <h1>Confirm Your Reservation</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
    </header>

    <section>
        <div class="container">
            <h2 class="title">Reservation Summary</h2>
            <div class="voyage-details">
                <div class="image">
                    <img src="<?php echo $selected_voyage['image'];?>" alt="Image du voyage" style="width: 600px; height: auto;"/>
                </div>
                <div class="details">
                    <h3><?php echo $selected_voyage['ville'] . ', ' . $selected_voyage['pays']; ?></h3>
                    <p><strong>Pack :</strong> <?php echo $packs[$selected_voyage['pack']] ?? 'Non défini'; ?></p>
                    <p><strong>Price :</strong> <?php echo $selected_voyage['prix']*2; ?> €</p>
                    <p><strong>Hotel Selected :</strong> <?php echo $hotel; ?> - <?php echo $hotel_price; ?> €</p>
                    <p><strong>Total Activities Price:</strong> <?php echo $activites_price; ?> €</p> <!-- Affiche uniquement le total des activités -->
                    <p><strong>Total Price:</strong> <?php echo $total_price; ?> €</p>
                </div>
            </div>

            <h4>Payment Details</h4>
            <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
                <input type="hidden" name="transaction" value="<?php echo $transaction; ?>">
                <input type="hidden" name="prix" value="<?php echo $prix; ?>">
                <input type="hidden" name="vendeur" value="<?php echo $vendeur; ?>">
                <input type="hidden" name="retour" value="<?php echo $retour; ?>">
                <input type="hidden" name="control" value="<?php echo $control; ?>">

                <!-- Additional Hidden Fields for the transaction details -->
                <input type="hidden" name="voyage_id" value="<?php echo $voyage_id; ?>" />
                <input type="hidden" name="hotel" value="<?php echo $hotel; ?>" />
                <input type="hidden" name="activites" value="<?php echo implode(',', $activites); ?>" />
                <input type="hidden" name="prix_hotel" value="<?php echo $hotel_price; ?>" />
                <input type="hidden" name="prix_voyage" value="<?php echo $prix_voyage; ?>" />
                <input type="hidden" name="total_price" value="<?php echo $total_price; ?>" />

                <!-- Payment Form Fields -->
                <button type="submit" class="confirm-btn">Confirm and Pay</button>
            </form>
        </div>
    </section>

    <footer>
        <div id="contact">
            <section>
                <p><br>Contact us</br><a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
            </section>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>
</body>
</html>
