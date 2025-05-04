<?php require_once 'init.php';

if(!isset($_SESSION['user_email'])) {
    header("Location: sign_in.php");
    exit;
}

$cartFile = 'dataJSON/cart.json';

if (!file_exists($cartFile)) {
    if (!file_exists('dataJSON')) {
        mkdir('dataJSON', 0755, true);
    }
    file_put_contents($cartFile, '{}');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $price = (float)($_POST['price'] ?? 0);

    if ($id && $name && $price > 0) {
        $cart = json_decode(file_get_contents($cartFile), true) ?? [];
        $cart[$id] = ['id' => $id, 'name' => $name, 'price' => $price];
        file_put_contents($cartFile, json_encode($cart, JSON_PRETTY_PRINT));
    }
    header("Location: cart.php");
    exit;
}

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $cart = json_decode(file_get_contents($cartFile), true) ?? [];
    if (isset($cart[$id])) {
        unset($cart[$id]);
        file_put_contents($cartFile, json_encode($cart, JSON_PRETTY_PRINT));
    }
    header("Location: cart.php");
    exit;
}

$cart = json_decode(file_get_contents($cartFile), true) ?? [];
$total = array_sum(array_column($cart, 'price'));

$voyagesFile = 'dataJSON/fly.json';
$voyages = file_exists($voyagesFile) ? json_decode(file_get_contents($voyagesFile), true) : [];

$cartItems = [];
foreach ($cart as $id => $item) {
    foreach ($voyages as $voyage) {
        if ($voyage['id'] == $id) {
            $cartItems[] = [
                'id' => $id,
                'name' => $item['name'],
                'price' => $item['price'],
                'details' => $voyage,
                'hotel' => $voyage['hotels'][0] ?? null,
                'activites' => [
                    $voyage['activite1'][0] ?? null,
                    $voyage['activite2'][0] ?? null,
                    $voyage['activite3'][0] ?? null,
                    $voyage['activite4'][0] ?? null
                ]
            ];
            break;
        }
    }
}
?>
<?php include 'header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart - Luxaltura</title>
    <?php
    if(isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'clair'){
        echo '<link rel="stylesheet" href="style2.css" />';
    }
    else{
        echo '<link rel="stylesheet" href="style.css" />';
    }
    ?>
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <style>
        body {
            font-size: 18px;
            font-family: 'Cinzel', serif;
        }
        header h1 {
            font-size: 32px;
        }
        .cart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px;
        }
        .cart-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .item-name {
            font-weight: bold;
            font-size: 20px;
        }
        .item-price {
            font-size: 18px;
            color: #007bff;
        }
        .remove-item {
            margin-left: 10px;
            color: red;
            text-decoration: none;
        }
        .remove-item:hover {
            text-decoration: underline;
        }
        .item-details {
            margin-top: 15px;
        }
        .detail-section {
            margin-bottom: 15px;
        }
        .detail-section h4 {
            margin-bottom: 5px;
            color: #555;
        }
        .activity-list {
            list-style-type: none;
            padding-left: 0;
        }
        .activity-list li {
            padding: 5px 0;
            border-bottom: 1px dashed #eee;
        }
        .cart-summary {
            text-align: center;
            margin: 20px auto;
            width: 100%;
        }
        .total-price {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-size: 20px;
            margin-bottom: 15px;
        }
        .cart-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }
        .proceed-to-payment, .back-to-home-button, .add-to-cart-btn {
            display: inline-block;
            padding: 12px 25px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .proceed-to-payment {
            background-color: #007bff;
        }
        .proceed-to-payment:hover {
            background-color: #0056b3;
        }
        .back-to-home-button {
            background-color: #6c757d;
        }
        .back-to-home-button:hover {
            background-color: #5a6268;
        }
        .add-to-cart-btn {
            background-color: #28a745;
        }
        .add-to-cart-btn:hover {
            background-color: #218838;
        }
        .empty-cart {
            text-align: center;
            margin: 50px 0;
            font-size: 20px;
        }
        .hotel-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }
        .hotel-image {
            width: 150px;
            height: 100px;
            overflow: hidden;
            border-radius: 5px;
        }
        .hotel-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .mode-switcher {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
        }
        .mode-btn {
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .mode-btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>Your Shopping Cart</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="150" height="150" class="logo" />
        <div class="auth-links">
            <?php if (isset($_SESSION['user_email'])): ?>
                <a href="userpage.php" title="My Account">My Account</a>
                <a href="logout.php" title="Log out">Log out</a>
            <?php else: ?>
                <a href="sign_in.php" title="Sign in">Sign in</a>
                <a href="sign_up.php" title="Sign up">Sign up</a>
            <?php endif; ?>
        </div>
        <div class="cart">
            <a href="cart.php" title="Your Cart">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count"><?= count($cart) ?></span>
            </a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="home.php" title="Go to home">Home</a></li>
            <li><a href="presentation.php" title="Our presentation">Presentation</a></li>
            <li><a href="#contact" title="Go to contact">Contact us</a></li>
        </ul>
    </nav>

    <main class="cart-container">
        <?php if (!empty($cartItems)): ?>
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item">
                    <div class="item-header">
                        <span class="item-name"><?= htmlspecialchars($item['name']) ?></span>
                        <span class="item-price"><?= number_format($item['price'], 2) ?> €</span>
                        <a href="cart.php?remove=<?= $item['id'] ?>" class="remove-item">
                            <i class="fas fa-trash"></i> Remove
                        </a>
                    </div>
                    
                    <div class="item-details">
                        <div class="detail-section">
                            <h4>Package:</h4>
                            <p><?= htmlspecialchars($item['details']['pack'] ?? 'No package specified') ?></p>
                        </div>
                        
                        <?php if ($item['hotel']): ?>
                            <div class="detail-section">
                                <h4>Selected Hotel:</h4>
                                <div class="hotel-info">
                                    <div class="hotel-image">
                                        <img src="<?= htmlspecialchars($item['hotel']['image']) ?>" alt="<?= htmlspecialchars($item['hotel']['nom']) ?>">
                                    </div>
                                    <div>
                                        <strong><?= htmlspecialchars($item['hotel']['nom']) ?></strong><br>
                                        <span><?= number_format($item['hotel']['prix'], 2) ?> €</span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="detail-section">
                            <h4>Included Activities:</h4>
                            <ul class="activity-list">
                                <?php foreach ($item['activites'] as $activite): ?>
                                    <?php if ($activite && is_array($activite)): ?>
                                        <li>
                                            <strong><?= htmlspecialchars($activite['nom']) ?></strong> - 
                                            <?= number_format($activite['prix'], 2) ?> €
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <div class="detail-section">
                            <h4>Flight Details:</h4>
                            <p>
                                <strong>Departure:</strong> CDG at 08:00 AM<br>
                                <strong>Arrival:</strong> <?= htmlspecialchars($item['details']['arrive'] ?? 'N/A') ?> at <?php 
                                    $duree_vol = $item['details']['duree'] ?? 0;
                                    $heure_arrivee = date("H:i", strtotime("+$duree_vol hours", strtotime("08:00:00")));
                                    echo $heure_arrivee;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="cart-summary">
                <div class="total-price">
                    <strong>Total: <?= number_format($total, 2) ?> €</strong>
                </div>
                
                <div class="cart-actions">
                    <a href="home.php" class="back-to-home-button">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
                    <a href="payment.php" class="proceed-to-payment">
                        <i class="fas fa-credit-card"></i> Proceed to Payment
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-cart">
                <p>Your cart is empty.</p>
                <a href="home.php" class="back-to-home-button">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <div id="contact">
            <section>
                <p><br>Contact us</br><a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
            </section>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>

    <div class="mode-switcher">
        <button class="mode-btn" onclick="toggleMode()">
            <i class="fas fa-adjust"></i>
        </button>
    </div>

    <script>
        function toggleMode() {
            const currentMode = document.cookie.replace(/(?:(?:^|.*;\s*)mode\s*=\s*([^;]*).*$)|^.*$/, "$1");
            const newMode = currentMode === 'clair' ? 'sombre' : 'clair';
            
            document.cookie = `mode=${newMode}; path=/; max-age=${60*60*24*365}`;
            location.reload();
        }
    </script>
</body>
</html>