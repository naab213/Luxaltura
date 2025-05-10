<?php require_once 'init.php';

$theme = isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'clair' ? 'clair' : 'sombre';
$cssFile = $theme === 'clair' ? 'style2.css' : 'style.css';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    } else {
        $error = "Please fill in all the fields.";
    }

    if (!isset($error)) {
        $filePath = 'dataJSON/user_data.json';
        if (!file_exists($filePath)) {
            $error = "Error: the data file is not found.";
        } else {
            $users = json_decode(file_get_contents($filePath), true);

            if (!is_array($users)) {
                $error = "Error: the user data is corrupted.";
            } else {
                $userFound = false;

                foreach ($users as $user) {
                    if (strtolower($user['email']) === strtolower($email)) {
                        $userFound = true;

                        if ($password === $user['pass']) {
                            if (!isset($user['lastname'], $user['name'], $user['age'], $user['email'], $user['pass'])) {
                                $error = "Error: incomplete user data.";
                                break;
                            }

                            $_SESSION['user_email'] = $email;
                            $_SESSION['user_name'] = $user['name'];
                            $_SESSION['user_lastname'] = $user['lastname'];
                            $_SESSION['user_age'] = $user['age'];

                            $tempDir = 'dataJSON/temp/';
                            if (!is_dir($tempDir)) {
                                mkdir($tempDir, 0777, true);
                            }

                            $tempFilePath = $tempDir . 'user_' . md5($email) . '.json';
                            $userData = [
                                'lastname' => $user['lastname'],
                                'name' => $user['name'],
                                'age' => $user['age'],
                                'email' => $user['email']
                            ];
                            file_put_contents($tempFilePath, json_encode($userData, JSON_PRETTY_PRINT));

                            header("Location: home.php");
                            exit();
                        } else {
                            $error = "Incorrect password.";
                        }
                        break;
                    }
                }

                if (!$userFound) {
                    $error = "No user found with this email.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset=" utf-8" />
    <link rel="stylesheet" href="<?php echo $cssFile; ?>" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <title>Luxaltura - Sign In</title>
</head>

<body>

    <form action="/switch.php" method="post" style="position: fixed; bottom: 50px; right: 30px;">
        <button type="submit">
            <?php echo $theme === 'clair' ? 'Switch to dark mode' : 'Switch to light mode'; ?>
        </button>
    </form>

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
            <li><a href="home.php" title="Go to home">Home</a></li>
            <li><a href="presentation.php" title="Our presentation">Presentation</a></li>
            <li><a href="specific.php" title="Go to my bookings">Bookings</a></li>
            <li><a href="#contact" title="Go to contact">Contact us</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Sign In</h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <form id="signin" action="sign_in.php" method="post";>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" id="email" required maxlength="50" data-counter="email-counter">
                <i class="uil uil-envelope icon"></i>
                <span class="counter" id="email-counter">0/50</span>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" id="password" required maxlength="20" data-counter="password-counter">
                <i class="uil uil-lock icon"></i>
                <i class="uil uil-eye-slash pw-toggle"></i>
                <span class="counter" id="password-counter">0/20</span>
            </div>

            <button type="submit" class="auth-button">Sign In</button>
        </form>
    </div>
    <script src="JS/sign_in.js"></script>
    <footer>
        <div id="contact">
            <section>
                <p><br>Contact us </br><a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
            </section>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>

</html>
