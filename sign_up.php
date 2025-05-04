<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $lastname = isset($_POST["lastname"]) ? htmlspecialchars(trim($_POST["lastname"])) : "";
    $name = isset($_POST["name"]) ? htmlspecialchars(trim($_POST["name"])) : "";
    $age = isset($_POST["age"]) ? intval($_POST["age"]) : 0;
    $email = isset($_POST["email"]) ? htmlspecialchars(trim($_POST["email"])) : "";
    $emailconf = isset($_POST["emailconf"]) ? htmlspecialchars(trim($_POST["emailconf"])) : "";
    $pass = isset($_POST["pass"]) ? htmlspecialchars(trim($_POST["pass"])) : "";
    $passwordconf = isset($_POST["passwordconf"]) ? htmlspecialchars(trim($_POST["passwordconf"])) : "";

    // Validation des champs
    if (empty($lastname) || empty($name) || empty($age) || empty($email) || empty($emailconf) || empty($pass) || empty($passwordconf)) {
        $error = "All fields are required.";
    } elseif ($email !== $emailconf) {
        $error = "The emails do not match.";
    } elseif ($pass !== $passwordconf) {
        $error = "The passwords do not match.";
    } elseif ($age <= 0) {
        $error = "Please enter a valid age.";
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


        $success = "Registration successful! Thank you, $name, for your registration.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <?php
    if (isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'clair') {
        echo '<link rel="stylesheet" href="style2.css" />';
    } else {
        echo '<link rel="stylesheet" href="style.css" />';
    }
    ?>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
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
            <li><a href="home.php" title="Go to home">Home</a></li>
            <li><a href="presentation.php" title="Our presentation">Presentation</a></li>
            <li><a href="specific.php" title="Go to my bookings">Bookings</a></li>
            <li><a href="#contact" title="Go to contact">Contact us</a></li>
        </ul>
    </nav>

    <div class="container" id="formulaire">
        <h2>Sign up</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php elseif (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
            <a href="sign_in.php">Sign in</a>
        <?php else: ?>
            <form action="sign_up.php" method="post">
                <label for="lastname">Lastname :</label>
                <input type="text" id="lastname" name="lastname" required maxlength="50" data-counter="lastname-counter">
                <span class="counter" id="lastname-counter">0/50

                </span>

                <label for="name">Name :</label>
                <input type="text" id="name" name="name" required maxlength="50" data-counter="name-counter">
                <span class="counter" id="name-counter">0/50</span>

                <label for="age">Age :</label>
                <input type="number" id="age" name="age" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required maxlength="50" data-counter="email-counter">
                <span class="counter" id="email-counter">0/50</span>

                <label for="emailconf">Confirm email :</label>
                <input type="email" id="emailconf" name="emailconf" required maxlength="50" data-counter="emailconf-counter">
                <span class="counter" id="emailconf-counter">0/50</span>

                <div class="input_box">Password
                    <input type="password" name="pass" placeholder="Password" required maxlength="20" data-counter="password-counter">
                    <i class="uil uil-lock"></i>
                    <i class="uil uil-eye-slash pw-toggle"></i>
                    <span class="counter" id="password-counter">0/20</span>
                </div>

                <div class="input_box">Confirm Password
                    <input type="password" name="passwordconf" placeholder="Confirm Password" required maxlength="20" data-counter="passwordconf-counter">
                    <i class="uil uil-lock"></i>
                    <i class="uil uil-eye-slash pw-toggle"></i>
                    <span class="counter" id="passwordconf-counter">0/20</span>
                </div>
                <button type="submit">Sign up</button>
            </form>
        <?php endif; ?>
    </div>
    <script src="JS/sign_up.js"></script>
    <footer>
        <div id="contact">
            <section>
                <p><br>Contact us</br><a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>
</body>

</html>
