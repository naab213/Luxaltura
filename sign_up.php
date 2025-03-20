<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = isset($_POST["lastname"]) ? htmlspecialchars($_POST["lastname"]) : "";
    $name = isset($_POST["name"]) ? htmlspecialchars($_POST["name"]) : "";
    $age = isset($_POST["age"]) ? intval($_POST["age"]) : 0;
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";
    $emailconf = isset($_POST["emailconf"]) ? htmlspecialchars($_POST["emailconf"]) : "";
    $pass = isset($_POST["pass"]) ? htmlspecialchars($_POST["pass"]) : "";
    $passwordconf = isset($_POST["passwordconf"]) ? htmlspecialchars($_POST["passwordconf"]) : "";

    if ($email !== $emailconf) {
        $error = "Les emails ne correspondent pas.";
    } elseif ($pass !== $passwordconf) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        $userData = array(
            "lastname" => $lastname,
            "name" => $name,
            "age" => $age,
            "email" => $email,
            "pass" => $pass
        );

        $file = 'dataJSON/user_data.json';
        if (file_exists($file)) {
            $jsonData = file_get_contents($file);
            $data = json_decode($jsonData, true);
        } else {
            $data = array();
        }

        $data[] = $userData;

        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

        $success = "Inscription réussie ! Merci, $name, pour votre inscription.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <title>Luxaltura - Sign up</title>
</head>

<body>
    <header>
        <h1>Luxaltura</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
        <div class="auth-links">
            <a href="sign_in.php" title="Sign in">Sign in</a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="home.html" title="Go to home">Home</a></li>
            <li><a href="presentation.html" title="Our presentation">Presentation</a></li>
            <li><a href="specific.html" title="Go to my bookings">Bookings</a></li>
            <li><a href="#contact" title="Go to contact">Contact us</a></li>
        </ul>
    </nav>

    <div class="container" id="formulaire">
        <h2>Sign up</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php elseif (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
            <a href="sign_in.php">Se connecter</a>
        <?php else: ?>
            <form action="sign_up.php" method="post">
                <label for="lastname">Nom :</label>
                <input type="text" id="lastname" name="lastname" required>

                <label for="name">Prénom :</label>
                <input type="text" id="name" name="name" required>

                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>

                <label for="emailconf">Confirmer Email :</label>
                <input type="email" id="emailconf" name="emailconf" required>

                <label for="pass">Mot de passe :</label>
                <input type="password" id="pass" name="pass" required>

                <label for="passwordconf">Confirmer Mot de passe :</label>
                <input type="password" id="passwordconf" name="passwordconf" required>

                <button type="submit">S'inscrire</button>
            </form>
        <?php endif; ?>
    </div>

    <footer>
        <div id="contact">
            <section>
                <p><br>Contact us</br><a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>
</body>

</html>
