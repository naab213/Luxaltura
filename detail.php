<?php
require_once 'init.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: sign_in.php");
    exit;
}
include 'header.php';

$jsonFile = 'dataJSON/fly.json';
if (!file_exists($jsonFile)) {
    die("The JSON file was not found.");
}
$voyages_search = json_decode(file_get_contents($jsonFile), true);

$packs = [
    1 => "Business Elite✨",
    2 => "Military Experience✈️",
    3 => "Adrenaline Flight🎢",
    4 => "Future Sky🚀"
];

$id = $_GET['id'] ?? '';
if (empty($id)) die('Invalid trip ID.');

$selected_voyage = null;
foreach ($voyages_search as $voyage) {
    if ($voyage['id'] == $id) {
        $selected_voyage = $voyage;
        break;
    }
}
if (!$selected_voyage) die('Trip not found.');

$departure_date = $_GET['date'] ?? '';
$return_date = '';
if (!empty($departure_date)) {
    $date_parts = explode('-', $departure_date);
    if (count($date_parts) == 3 && checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
        $return_date = date('Y-m-d', strtotime($departure_date . ' +8 days'));
    }
}
$duree_vol = $selected_voyage['duree'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trip Details</title>
    <link rel="stylesheet" href="<?= isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'clair' ? 'style2.css' : 'style.css' ?>">
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body class="detail-page">

<header>
    <h1>Choose your package and embark on a unique experience</h1>
    <span class="separator"></span>
    <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
    <div class="auth-links">
        <a href="userpage.php">My Account</a>
        <a href="logout.php">Log out</a>
    </div>
</header>

<nav>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="presentation.php">Presentation</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
</nav>

<section>
    <div class="container">
        <h2 class="title">Trip Details</h2>

        <form id="reservationForm" action="payment.php" method="POST">
            <input type="hidden" name="voyage_id" value="<?= $id ?>">
            <input type="hidden" name="amount" id="montant" value="<?= $selected_voyage['prix'] ?>">
            <input type="hidden" name="reservations" id="reservations_input">
            <input type="hidden" name="total" id="total_input">

            <div class="voyage-details">
                <div class="image">
                    <img src="<?= $selected_voyage['image'] ?>" alt="Trip Image">
                </div>
                <div class="details">
                    <h3><?= $selected_voyage['ville'] . ', ' . $selected_voyage['pays'] ?></h3>
                    <p><strong>Activities:</strong> <?= $packs[$selected_voyage['pack']] ?? 'Not defined' ?></p>
                    <p><strong>Price:</strong> <?= $selected_voyage['prix'] ?> €</p>

                    <label for="departure">Departure Date:</label>
                    <input type="date" id="departure" name="departure" value="<?= $departure_date ?>" required>

                    <label for="return">Return Date:</label>
                    <input type="date" id="return" name="return" value="<?= $return_date ?>" readonly required>

                    <h4>Choose your hotel:</h4>
                    <select name="hotel" required>
                        <?php foreach ($selected_voyage['hotels'] as $hotel): ?>
                            <option value="<?= $hotel['nom'] ?>" data-price="<?= $hotel['prix'] ?>">
                                <?= $hotel['nom'] ?> - <?= $hotel['prix'] ?> €
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <h4>Choose your activities:</h4>
                    <?php
                    $activites = [
                        $selected_voyage['activite1'],
                        $selected_voyage['activite2'],
                        $selected_voyage['activite3'],
                        $selected_voyage['activite4']
                    ];
                    foreach ($activites as $activite): ?>
                        <select name="activites[]" required>
                            <?php foreach ($activite as $option): ?>
                                <option value="<?= $option['nom'] ?>" data-price="<?= $option['prix'] ?>">
                                    <?= $option['nom'] ?> - <?= $option['prix'] ?> €
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endforeach; ?>

                    <p><strong>Total Price:</strong> <span id="totalPrice">0 €</span></p>

                    <div class="button-group">
                        <button type="submit" class="validate-btn">Confirm the reservation</button>
                        <button type="button" class="back-btn" onclick="window.location.href='specific.php'">Return to booking</button>
                    </div>
                </div>
            </div>
        </form>

        <form id="addToCartForm" action="cart.php" method="POST" style="text-align: center;">
            <input type="hidden" name="add_to_cart" value="1">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="name" value="<?= htmlspecialchars($selected_voyage['ville'] . ', ' . $selected_voyage['pays']) ?>">
            <input type="hidden" name="base_price" value="<?= $selected_voyage['prix'] ?>">
            <input type="hidden" name="hotel" id="selected_hotel">
            <input type="hidden" name="activities" id="selected_activities">
            <input type="hidden" name="total_price" id="hidden_total_price">
            <button type="submit" class="add-to-cart-btn">
                <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
        </form>
    </div>
</section>

<footer>
    <div id="contact">
        <p>Contact us <a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
    </div>
    <span>2025 | MI-03.I ©</span>
</footer>

<script>
function updateTotalAndFields() {
    const voyageId = document.querySelector("input[name='voyage_id']").value;
    const hotel = document.querySelector("select[name='hotel']").value;
    const activites = [...document.querySelectorAll("select[name='activites[]']")].map(select => select.value);

    const hotelPrice = parseFloat(document.querySelector("select[name='hotel'] option:checked")?.dataset.price || 0);
    const activityPrices = [...document.querySelectorAll("select[name='activites[]']")].map(select => {
        return parseFloat(select.selectedOptions[0]?.dataset.price || 0);
    });

    const basePrice = parseFloat(document.getElementById("montant").value);
    const total = (basePrice * 2) + hotelPrice + activityPrices.reduce((a, b) => a + b, 0);

    document.getElementById("reservations_input").value = JSON.stringify([{
        voyage_id: voyageId,
        hotel: hotel,
        activities: activites
    }]);

    document.getElementById("total_input").value = total.toFixed(2);
    document.getElementById("totalPrice").textContent = total.toFixed(2) + " €";

    document.getElementById("selected_hotel").value = hotel;
    document.getElementById("selected_activities").value = activites.join(', ');
    document.getElementById("hidden_total_price").value = total.toFixed(2);
}

document.querySelector("select[name='hotel']").addEventListener("change", updateTotalAndFields);
document.querySelectorAll("select[name='activites[]']").forEach(select => {
    select.addEventListener("change", updateTotalAndFields);
});

document.getElementById('reservationForm').addEventListener('submit', function () {
    updateTotalAndFields();
});

document.getElementById('addToCartForm').addEventListener('submit', function (e) {
    e.preventDefault();
    updateTotalAndFields();
    setTimeout(() => {
        document.getElementById('addToCartForm').submit();
    }, 100);
});

updateTotalAndFields();
</script>

</body>
</html>