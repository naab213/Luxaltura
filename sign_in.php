<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    } else {
        $error = "Veuillez remplir tous les champs.";
    }

    if (!isset($error)) {
        $filePath = 'dataJSON/user_data.json';
        if (!file_exists($filePath)) {
            $error = "Erreur : le fichier de données est introuvable.";
        } else {
            $users = json_decode(file_get_contents($filePath), true);

            if (!is_array($users)) {
                $error = "Erreur : les données utilisateur sont corrompues.";
            } else {
                $userFound = false;

                foreach ($users as $user) {
                    if (strtolower($user['email']) === strtolower($email)) {
                        $userFound = true;

                        if ($password === $user['pass']) {
                            $_SESSION['user_email'] = $email;
                            $_SESSION['user_name'] = $user['name'];
                            $_SESSION['user_lastname'] = $user['lastname'];
                            $_SESSION['user_age'] = $user['age'];
                            header("Location: userpage.php");
                            exit();
                        } else {
                            $error = "Mot de passe incorrect.";
                        }
                        break;
                    }
                }

                if (!$userFound) {
                    $error = "Aucun utilisateur trouvé avec cet email.";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <title>Luxaltura - Sign In</title>
</head>

<body>
    <header>
        <h1>Luxaltura</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
        <div class="auth-links">
            <a href="sign_up.php" title="Sign up">Sign up</a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="home.html" title="Go to home">Home</a></li>
            <li><a href="presentation.html" title="Our presentation">Presentation</a></li>
            <li><a href="specific.php" title="Go to my bookings">Bookings</a></li>
            <li><a href="#contact" title="Go to contact">Contact us</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Sign In</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form id="signin" action="sign_in.php" method="post">
            <input type="email" name="email" placeholder="Email" id="email" required>
            <input type="password" name="password" placeholder="Password" id="pw" required>
            <button type="submit">Sign In</button>
        </form>
    </div>

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
