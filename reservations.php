<?php
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    die("Erreur : utilisateur non connecté.");
}

$reservationsFile = 'dataJSON/reservations.json';
$reservations = file_exists($reservationsFile) ? json_decode(file_get_contents($reservationsFile), true) : [];


$userReservations = array_filter($reservations, function ($reservation) use ($user_id) {
    return $reservation['user_id'] === $user_id;
});
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Réservations</title>
</head>
<body>
    <h1>Mes Réservations</h1>
    <?php if (empty($userReservations)): ?>
        <p>Aucune réservation trouvée.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($userReservations as $reservation): ?>
                <li>
                    <strong>Transaction :</strong> <?php echo $reservation['transaction']; ?><br>
                    <strong>Montant :</strong> <?php echo $reservation['montant']; ?> €<br>
                    <strong>Date :</strong> <?php echo $reservation['date']; ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
