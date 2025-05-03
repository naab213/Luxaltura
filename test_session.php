<?php require_once 'init.php';

if(isset($_SESSION['user_email'])){
    echo "Utilisateur connecté : " . $_SESSION['user_email'];
    echo "<br>ID utilisateur : " . $_SESSION['user_id'];

    // Afficher le contenu du fichier temporaire
    $tempFilePath = 'dataJSON/temp/user_' . $_SESSION['user_id'] . '.json';
    if(file_exists($tempFilePath)){
        $userData = json_decode(file_get_contents($tempFilePath), true);
        echo "<pre>" . print_r($userData, true) . "</pre>";
    }
    else{
        echo "<br>Fichier temporaire introuvable.";
    }
}
else{
    echo "Aucun utilisateur connecté.";
}
?>
