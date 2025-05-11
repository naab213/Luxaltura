<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: sign_in.php");
    exit;
}

require_once 'init.php';

// Ajouter une réservation au panier
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $base_price = (float)($_POST['base_price'] ?? 0);
    $hotel_name = $_POST['hotel'] ?? '';
    $selected_activities = isset($_POST['activities']) ? json_decode($_POST['activities'], true) : [];
    $total_price = (float)($_POST['total_price'] ?? 0);

    if ($id && $name && $hotel_name) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $reservation_item = [
            'voyage_id' => $id,
            'voyage_name' => $name,
            'voyage_price' => $base_price,
            'hotel' => $hotel_name,
            'activities' => $selected_activities,
            'total_price' => $total_price
        ];

        $_SESSION['cart'][] = $reservation_item;

        // Sauvegarder dans le fichier JSON
        $user_email = $_SESSION['user_email'];
        $reservation = [
            'email' => $user_email,
            'reservation' => $reservation_item,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        $file = 'dataJSON/reservations.json';
        $existingData = [];

        if (file_exists($file)) {
            $json = file_get_contents($file);
            $existingData = json_decode($json, true) ?? [];
        }

        $existingData[] = $reservation;
        file_put_contents($file, json_encode($existingData, JSON_PRETTY_PRINT));
    }
}

// Supprimer une réservation spécifique
if (isset($_POST['remove_item']) && isset($_POST['index'])) {
    $index = (int)$_POST['index'];
    if (isset($_SESSION['cart'][$index])) {
        array_splice($_SESSION['cart'], $index, 1);
    }
    header("Location: cart.php");
    exit;
}

// Vider le panier complet
if (isset($_POST['remove_cart'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}

// Charger les données d'un voyage
function loadVoyageData($voyageId) {
    if (!file_exists('dataJSON/fly.json')) return null;

    $flyData = json_decode(file_get_contents('dataJSON/fly.json'), true);
    foreach ($flyData as $voyage) {
        if ($voyage['id'] == $voyageId) {
            return $voyage;
        }
    }
    return null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart - Luxaltura</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
<header>
    <h1>Your Cart</h1>
    <span class="separator"></span>
    <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
    <div class="auth-links">
        <a href="userpage.php"><i class="fas fa-user"></i> My Account</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</header>

<nav>
    <ul>
        <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="presentation.php"><i class="fas fa-info-circle"></i> About</a></li>
        <li><a href="#contact"><i class="fas fa-envelope"></i> Contact</a></li>
    </ul>
</nav>

<section>
    <div class="container">
        <h2 class="title">Cart Summary</h2>

        <?php if (empty($_SESSION['cart']) || !is_array($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-cart fa-3x"></i>
                <p>Your cart is empty.</p>
                <a href="home.php" class="btn-back">Browse Trips</a>
            </div>
        <?php else: ?>
            <?php
            $totalGeneral = 0;
            foreach ($_SESSION['cart'] as $index => $item):
                $voyageData = loadVoyageData($item['voyage_id']);
                $hotel_name = $item['hotel'];
                $activity_details = [];
                $activities_total = 0;
                $hotel_price = 0;

                if (!empty($item['activities']) && !empty($voyageData)) {
                    foreach ($item['activities'] as $selectedName) {
                        foreach ($voyageData as $key => $group) {
                            if (strpos($key, 'activite') === 0 && is_array($group)) {
                                foreach ($group as $act) {
                                    if ($act['nom'] === $selectedName) {
                                        $activity_details[] = $act;
                                    }
                                }
                            }
                        }
                    }
                    $activities_total = array_sum(array_column($activity_details, 'prix'));
                }

                if (!empty($voyageData['hotels'])) {
                    foreach ($voyageData['hotels'] as $hotel) {
                        if ($hotel['nom'] === $hotel_name) {
                            $hotel_price = (float)$hotel['prix'];
                            break;
                        }
                    }
                }

                $totalGeneral += $item['total_price'];
            ?>

            <div class="cart-details">
                <div class="trip-header">
                    <h3><i class="fas fa-plane"></i> <?= htmlspecialchars($item['voyage_name']) ?></h3>
                </div>

                <div class="price-section">
                    <p><strong><i class="fas fa-ticket-alt"></i> Flight (x2):</strong> <?= number_format($item['voyage_price'] * 2, 2) ?> €</p>
                    <p><strong><i class="fas fa-hotel"></i> Hotel:</strong> <?= htmlspecialchars($hotel_name) ?> - <?= number_format($hotel_price, 2) ?> €</p>
                </div>

                <?php if (!empty($activity_details)): ?>
                    <div class="activities-section">
                        <h4><i class="fas fa-umbrella-beach"></i> Selected Activities:</h4>
                        <ul>
                            <?php foreach ($activity_details as $act): ?>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <?= htmlspecialchars($act['nom']) ?> -
                                    <span class="activity-price"><?= number_format($act['prix'], 2) ?> €</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <p class="activities-total">
                            <strong>Activities Subtotal:</strong> <?= number_format($activities_total, 2) ?> €
                        </p>
                    </div>
                <?php else: ?>
                    <p class="no-activities"><i class="fas fa-info-circle"></i> No activities selected.</p>
                <?php endif; ?>

                <div class="total-section">
                    <p class="grand-total">
                        <strong>Reservation Total:</strong> <?= number_format($item['total_price'], 2) ?> €
                    </p>
                </div>

                <div>
                    <form method="POST">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <button type="submit" name="remove_item">❌ Remove</button>
                    </form>
                </div>
            </div>

            <?php endforeach; ?>

            <div class="global-total-section">
                <h3><i class="fas fa-coins"></i> Cart Total: <?= number_format($totalGeneral, 2) ?> €</h3>
            </div>

            <div class="action-buttons">
                <form action="payment.php" method="POST" class="inline-form">
                    <input type="hidden" name="reservations" value='<?= json_encode($_SESSION['cart']) ?>'>
                    <input type="hidden" name="total" value="<?= $totalGeneral ?>">
                    <button type="submit" class="btn-confirm">
                        <i class="fas fa-credit-card"></i> Pay All Reservations
                    </button>
                </form>

                <form method="POST" class="inline-form">
                    <button type="submit" name="remove_cart" class="btn-remove">
                        <i class="fas fa-trash-alt"></i> Clear Cart
                    </button>
                </form>

                <a href="home.php" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<footer>
    <div id="contact">
        <p><i class="fas fa-envelope"></i> Contact us: <a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
    </div>
    <span>2025 | MI-03.I ©</span>
</footer>
</body>
</html>
