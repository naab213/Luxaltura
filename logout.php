<?php
session_start();

if(isset($_SESSION['user_id'])){
    // Supprimer le fichier temporaire
    $tempFilePath = 'dataJSON/temp/user_' . $_SESSION['user_id'] . '.json';
    if(file_exists($tempFilePath)){
        unlink($tempFilePath);
    }
}

// Détruire la session
session_unset();
session_destroy();

// Rediriger vers la page de connexion
header("Location: sign_in.php");
exit();
?>
