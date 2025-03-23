<?php
session_start(); // Démarrez la session pour gérer l'état de connexion
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <title>Luxaltura - Home</title>
</head>

<body>
    <header>
        <h1>Luxaltura - Elevate Your Journey, Embrace Prestige</h1>
        <span class="separator"></span>
        <img src="https://imgur.com/F38OAQx.jpg" width="150" height="150" class="logo" />
        <div class="auth-links">
            <?php if (isset($_SESSION['user_email'])): ?>
                <!-- Afficher ces liens si l'utilisateur est connecté -->
                <a href="userpage.php" title="My Account">My Account</a>
                <a href="logout.php" title="Log out">Log out</a>
            <?php else: ?>
                <!-- Afficher ces liens si l'utilisateur n'est pas connecté -->
                <a href="sign_in.php" title="Sign in">Sign in</a>
                <a href="sign_up.php" title="Sign up">Sign up</a>
            <?php endif; ?>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="presentation.html" title="Our presentation">Presentation</a></li>
            <li><a href="specific.php" title="Go to my bookings">Bookings</a></li>
            <li><a href="#contact" title="Go to contact">Contact us</a></li>
        </ul>
    </nav>

    <div class="resume">
        <section>
            <h3><br>Welcome to Luxaltura!</br></h3>
            <p>Looking for an extraordinary vacation? Let us immerse you in a premium experience and take you to new
                heights. Simply choose a package, and we'll take care of the rest — especially of you!</p>
        </section>

        <section class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>Business Elite✨</th>
                        <th colspan="2">Military Experience✈️</th>
                        <th>Adrenaline Flight🎢</th>
                        <th>Future Sky🚀</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="https://imgur.com/01L6dOi.jpg" width="302" height="225" />
                        </td>
                        <td>
                            <img src="https://imgur.com/XLTcar5.jpg" width="302" height="225" />
                        </td>
                        <td>
                            <img src="https://imgur.com/8rFGyYW.jpg" width="302" height="225" />
                        </td>
                        <td>
                            <img src="https://imgur.com/uQWPIoQ.jpg" width="302" height="225" />
                        </td>
                        <td>
                            <img src="https://imgur.com/6YdCUwZ.jpg" width="302" height="225" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <h2>
            <center> Our best selections ✨</center>
        </h2>
        <div class="table-container">
            <a href="detail.php?id=7&date=2025-03-23&pays=%7E+Japan" class="table-best-link">
                <section class="table-best">
                    <table>
                        <thead>
                            <tr>
                                <th>Japan - Adrenaline Flight🎢</th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="img-container">
                                        <img src="https://www.gotokyo.org/fr/plan/tokyo-outline/images/main.jpg"
                                            width="300" height="150" />
                                        <div class="overlay-text">Le plus populaire
                                            8⭐/10
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Haneda - International Airport | Tokyo</td>
                            </tr>
                            <tr>
                                <td>The Prince Park Tower Tokyo</td>
                            </tr>
                            <tr>
                                <td>4 activities</td>
                            </tr>
                            <tr>
                                <td>Price : ???€</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </a>

            <a href="detail.php?id=3&date=2025-03-23&pays=~+Brazil" class="table-best-link">
                <section class="table-best">
                    <table>
                        <thead>
                            <tr>
                                <th>Brasilia - Military Experience✈️</th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="img-container">
                                        <img src="https://media.istockphoto.com/id/481054970/fr/photo/brasilia-s-cerrado-coucher-du-soleil-pont-jk.jpg?s=612x612&w=0&k=20&c=6l5RyoXCYNax-035G1XxC_nDWBo0po3f_UKgcB-F-ms="
                                            width="300" height="150" />
                                        <div class="overlay-text">Le mieux noté
                                            10⭐/10
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Presidente Juscelino Kubitschek - International Airport | Brasilia</td>
                            </tr>
                            <tr>
                                <td>Royal Tulip Brasília Alvorada</td>
                            </tr>
                            <tr>
                                <td>4 activities</td>
                            </tr>
                            <tr>
                                <td>Price : ???€</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </a>

            <a href="detail.php?id=14&date=2025-03-23&pays=~+Norway" class="table-best-link">
                <section class="table-best">
                    <table>
                        <thead>
                            <tr>
                                <th>Tromso - Future Sky🚀</th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="img-container">
                                        <img src="https://static.nationalgeographic.fr/files/styles/image_3200/public/gettyimages-1446646686.jpg?w=1600&h=1067"
                                            width="300" height="150" />
                                        <div class="overlay-text">Le plus relaxant
                                            9.5⭐/10
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tromsø Airport | Tromsø</td>
                            </tr>
                            <tr>
                                <td>Tromsø Lodge & Camping</td>
                            </tr>
                            <tr>
                                <td>4 activities</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </a>
        </div>
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
