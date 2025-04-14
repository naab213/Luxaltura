<?php
session_start();

if(!isset($_SESSION['user_email'])){
    header("Location: sign_in.php");
    exit();
}


$paymentDataFile = 'dataJSON/payments.json';
if(!file_exists($paymentDataFile)){
    die("Erreur : Fichier de données des paiements introuvable.");
}

$paymentData = json_decode(file_get_contents($paymentDataFile), true);
if(json_last_error() !== JSON_ERROR_NONE){
    die("Erreur : Impossible de charger les données des paiements (fichier JSON corrompu).");
}


$userPayments = array_filter($paymentData, function ($payment) {
    
    return isset($payment['user_email']) && $payment['user_email'] === $_SESSION['user_email'];
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxaltura - My Account</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <header>
        <h1>Luxaltura</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
    </header>

    <nav>
        <ul>
            <li><a href="home.php" title="Go to home">Home</a></li>
            <li><a href="presentation.html" title="Our presentation">Presentation</a></li>
            <li><a href="specific.php" title="Go to my bookings">Bookings</a></li>
            <li><a href="#contact" title="Go to contact">Contact us</a></li>
        </ul>
    </nav>

    <div class="container" id="formulaire">
        <h2>Profil</h2>
        <form id="profileForm">
            <div class="field">
                <input type="text" id="lastname" value="<?php echo htmlspecialchars($_SESSION['user_lastname']); ?>" disabled required>
                <button type="button" class="edit-btn" onclick="edit('lastname')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>
            <div class="field">
                <input type="text" id="name" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" disabled required>
                <button type="button" class="edit-btn" onclick="edit('name')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>
            <div class="field">
                <input type="email" id="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" disabled required>
                <button type="button" class="edit-btn" onclick="edit('email')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>
            <div class="field">
                <input type="number" id="age" value="<?php echo htmlspecialchars($_SESSION['user_age']); ?>" disabled required>
                <button type="button" class="edit-btn" onclick="edit('age')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>
            <div class="field">
                <input type="password" id="pw" placeholder="Enter a new password" disabled>
                <button type="button" class="edit-btn" onclick="edit('pw')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>
            <div class="field">
                <input type="password" id="pwconf" placeholder="Confirm password" disabled>
            </div>

            <button type="button" id="updateBtn" onclick="updateForm()">Update</button>
        </form>
    </div>

    <div class="container" id="paymentSection">
        <h2>My Purchases</h2>
        <?php if (!empty($userPayments)): ?>
    <ul>
        <?php foreach ($userPayments as $payment): ?>
            <li>
                <strong>Transaction ID:</strong> <?php echo htmlspecialchars($payment['transaction_id'] ?? 'N/A'); ?><br>
                <strong>Amount:</strong> <?php echo htmlspecialchars($payment['montant'] ?? 'N/A'); ?> €<br>
                <strong>Trip:</strong> <?php echo htmlspecialchars($payment['voyage_id'] ?? 'N/A'); ?><br>
                <strong>Hotel:</strong> <?php echo htmlspecialchars($payment['hotel'] ?? 'N/A'); ?><br>
                <strong>Date:</strong> <?php echo htmlspecialchars($payment['date'] ?? 'N/A'); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No purchases found.</p>
<?php endif; ?>
    </div>

    <button onclick="logout()">Logout</button>

    <footer>
        <div id="contact">
            <section>
                <p><br>Contact us</br><a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
            </section>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>
    <script src="JS/userpage.js"></script>
</body>
</html>
