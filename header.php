<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Luxaltura</title>
    <link rel="stylesheet" href="<?php echo $cssFile; ?>">
</head>
<body>
    <form action="switch.php" method="post" style="position: fixed; bottom: 50px; right: 30px;">
        <button type="submit">
            <?php echo $theme === 'clair' ? 'Switch to dark mode' : 'Switch to light mode'; ?>
        </button>
    </form>
</body>