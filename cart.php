<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: sign_in.php");
    exit;
}

$voyage_id = isset($_POST['id']) ? $_POST['id'] : '';
$voyage_name = isset($_POST['name']) ? $_POST['name'] : '';
$voyage_price = isset($_POST['price']) ? $_POST['price'] : 0;
$total_price = isset($_POST['total_price']) ? $_POST['total_price'] : 0;
$selected_hotel = isset($_POST['hotel']) ? $_POST['hotel'] : '';
$selected_activities = isset($_POST['activites']) ? json_decode($_POST['activites']) : [];

if ($voyage_id == '') {
    die('The trip could not be found.');
}

$_SESSION['cart'] = [
    'voyage_id' => $voyage_id,
    'voyage_name' => $voyage_name,
    'voyage_price' => $voyage_price,
    'total_price' => $total_price,
    'hotel' => $selected_hotel,
    'activities' => $selected_activities,
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Luxaltura</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Your Cart</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
        <div class="auth-cart-container">
            <div class="auth-links">
                <?php if (isset($_SESSION['user_email'])): ?>
                    <a href="userpage.php" title="My Account">My Account</a>
                    <a href="logout.php" title="Logout">Logout</a>
                <?php else: ?>
                    <a href="sign_in.php" title="Sign In">Sign In</a>
                    <a href="sign_up.php" title="Sign Up">Sign Up</a>
                <?php endif; ?>
            </div>

            <div class="cart">
                <a href="cart.php" title="Your Cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">1</span>
                </a>
            </div>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="home.php" title="Back to Home">Home</a></li>
            <li><a href="presentation.php" title="Our Presentation">Presentation</a></li>
            <li><a href="#contact" title="Contact us">Contact us</a></li>
        </ul>
    </nav>

    <section>
        <div class="container">
            <h2 class="title">Cart</h2>

            <div class="cart-details">
                <h3>Trip: <?php echo htmlspecialchars($voyage_name); ?></h3>
                <p><strong>Price:</strong> <?php echo htmlspecialchars($voyage_price); ?> €</p>
                <p><strong>Selected Hotel:</strong> <?php echo htmlspecialchars($selected_hotel); ?></p>

                <h4>Selected Activities:</h4>
                <ul>
                    <?php
                    if (!empty($selected_activities)) {
                        foreach ($selected_activities as $activity) {
                            echo "<li>" . htmlspecialchars($activity) . "</li>";
                        }
                    } else {
                        echo "<li>No activities selected.</li>";
                    }
                    ?>
                </ul>

                <p><strong>Total to pay:</strong> <?php echo htmlspecialchars($total_price); ?> €</p>

                <!-- Modification: Rediriger vers payment.php -->
                <form action="payment.php" method="POST">
                    <input type="hidden" name="voyage_id" value="<?php echo $voyage_id; ?>" />
                    <input type="hidden" name="total_price" value="<?php echo $total_price; ?>" />
                    <input type="hidden" name="hotel" value="<?php echo htmlspecialchars($selected_hotel); ?>" />
                    <input type="hidden" name="activities" value="<?php echo json_encode($selected_activities); ?>" />
                    <button type="submit" class="btn-confirm">Confirm Booking</button>
                </form>

                <form action="specific.php" method="get">
                    <button type="submit" class="btn-back">Back to Options</button>
                </form>
            </div>
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

