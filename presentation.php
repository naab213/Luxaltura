<?php require_once 'init.php';?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <?php include 'header.php';
        if(isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'clair'){
            echo '<link rel="stylesheet" href="style2.css" />';
        }
        else{
            echo '<link rel="stylesheet" href="style.css" />';
        }
        ?>
        <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
        <title>Luxaltura - Presentation</title>
    </head>

    <body>
        <header>
            <h1>Luxaltura</h1>
            <span class="separator"></span>
            <img src="https://imgur.com/F38OAQx.jpg" width="200" height="200" class="logo" />
            <div class="auth-links">
                <a href="sign_in.php" title="Sign in">Sign in</a>
                <a href="sign_up.php" title="Sign up">Sign up</a>
            </div>
        </header>

        <nav>
            <ul>
                <li><a href="home.php" title="Go to home">Home</a></li>
                <li><a href="specific.php" title="Go to my bookings">Bookings</a></li>
                <li><a href="#contact" title="Go to contact">Contact us</a></li>
            </ul>
        </nav>

        <div class="presentation">
            <section>
                <p>
                    <center>
                        Welcome to Luxaltura, your one-of-a-kind travel agency, specializing in exceptional aerial experiences.
                        Founded in 2022, Luxaltura doesn't just let you book a flight—it offers you an unforgettable moment. We
                        provide the opportunity to travel aboard the aircraft of your choice while enjoying thrilling activities
                        upon arrival at your destination.
                        Whether you dream of a spectacular loop in the air or a skydiving jump for an adrenaline rush, we have
                        options to satisfy all your desires. Our diverse fleet allows you to select the aircraft that best suits
                        your expectations, whether it’s a private jet for a peaceful flight or a sportier aircraft for a more
                        intense experience.
                        We serve top destinations around the world, from paradise beaches to majestic mountains, ensuring safe,
                        comfortable, and memorable flights.
                        Take off with Luxaltura, where every journey is a tailor-made adventure, blending luxury, thrills, and
                        exploration. Ready for takeoff? Discover our offers now and choose the experience that will mark your
                        life. Luxaltura, redefining the art of travel.
                    </center>
                </p>
            </section>

            <div id="booking">
                <section>
                    <table cellspacing="8">
                        <tr>
                            <td>
                                <img src="https://aeroaffaires.fr/wp-content/uploads/2019/04/gulfstream_g650_interior_11.jpg" width="375" height="225" />
                                <p><center>Business Elite✨: private jet travel with access to exclusive lounges</center></p>
                            </td>
                            <td>
                                <img src="https://www.24matins.fr/wp-content/uploads/2025/02/avion-mirage-1200x800.jpeg" width="375" height="225" />
                                <p><center>Military Experience✈️: flight in a military aircraft with a simulator and a visit to an airbase</center></p>
                            </td>
                            <td>
                                <img src="https://images.rtl.fr/~c/1200v800/funradio/www/968583-top-gun-voltige.jpg" width="375" height="225" />
                                <p><center>Adrenaline Flight🎢: aerobatic flight experience with a looping session</center></p>
                            </td>
                            <td>
                                <img src="https://ds.static.rtbf.be/article/image/1920x1920/3/0/1/45d137e1c41f62393dfcbec23e90f401-1692360856.jpg" width="372" height="225" />
                                <p><center>Future Sky🚀: experience aboard an innovative aircraft with a futuristic simulator immersion</center></p>
                            </td>
                        </tr>
                    </table>
                </section>
            </div>
        </div>

        <footer>
            <div id = "contact">
                <section>
                    <p><br>Contact us</br><a href = "mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
                </section>
            </div>
            <span>2025 | MI-03.I ©</span>
        </footer>
    </body>
</html>