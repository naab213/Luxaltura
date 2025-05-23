<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <title>Luxaltura - Admins</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="presentation.php" title="Our presentation">Presentation</a></li>
                <li><a href="specific.php" title="Go to my bookings">Bookings</a></li>
                <li><a href="#contact" title="Go to contact">Contact us</a></li>
            </ul>
        </nav>
        <h1>Our users</h1>
    </header>

    <section>
        <table border="5" style="background-color: white; width: 100%; text-align: left;">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Mail</th>
                    <th>Âge</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
            </tbody>
        </table>
    </section>

    <footer>
        <div id="contact">
            <section>
                <p><br>Contact us</br><a href="mailto:luxalturaagency@outlook.com">luxalturaagency@outlook.com</a></p>
            </section>
        </div>
        <span>2025 | MI-03.I ©</span>
    </footer>

    <script src="JS/admin_page.js"></script>
</body>
</html>
