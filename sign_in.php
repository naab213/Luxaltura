<?php require_once 'init.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    }
    else{
        $error = "Please fill in all the fields.";
    }

    if(!isset($error)){
        $filePath = 'dataJSON/user_data.json'; // Use user_data.json for verification
        if(!file_exists($filePath)){
            $error = "Error: the data file is not found.";
        }
        else{
            $users = json_decode(file_get_contents($filePath), true);

            if(!is_array($users)){
                $error = "Error: the user data is corrupted.";
            }
            else{     
                $userFound = false;

                foreach ($users as $user){
                    if(strtolower($user['email']) === strtolower($email)){ // Check email
                        $userFound = true;

                        if($password === $user['pass']){ // Check password
                            // Ensure required keys exist in the user array
                            if(!isset($user['lastname'], $user['name'], $user['age'], $user['email'], $user['pass'])){
                                $error = "Error: incomplete user data.";
                                break;
                            }

                            $_SESSION['user_email'] = $email; // Store user email
                            $_SESSION['user_name'] = $user['name']; // Store user name
                            $_SESSION['user_lastname'] = $user['lastname']; // Store user lastname
                            $_SESSION['user_age'] = $user['age']; // Store user age

                            // Ensure the temp directory exists
                            $tempDir = 'dataJSON/temp/';
                            if(!is_dir($tempDir)){
                                mkdir($tempDir, 0777, true);
                            }

                            // Create a temporary file with the user's data
                            $tempFilePath = $tempDir . 'user_' . md5($email) . '.json';
                            $userData = [
                                'lastname' => $user['lastname'],
                                'name' => $user['name'],
                                'age' => $user['age'],
                                'email' => $user['email']
                            ];
                            file_put_contents($tempFilePath, json_encode($userData, JSON_PRETTY_PRINT));

                            header("Location: home.php"); // Redirect to home page
                            exit();
                        }
                        else{
                            $error = "Incorrect password.";
                        }
                        break;
                    }
                }

                if(!$userFound){
                    $error = "No user found with this email.";
                }
            }
        }
    }
}
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <?php
    if(isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'clair'){
        echo '<link rel="stylesheet" href="style2.css" />';
    }
    else{
        echo '<link rel="stylesheet" href="style.css" />';
    }
    ?>
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
            <li><a href="home.php" title="Go to home">Home</a></li>
            <li><a href="presentation.php" title="Our presentation">Presentation</a></li>
            <li><a href="specific.php" title="Go to my bookings">Bookings</a></li>
            <li><a href="#contact" title="Go to contact">Contact us</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Sign In</h2>
        <?php if (isset($error)): ?>
            <p style="color: black;"><?php echo $error; ?></p>
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
