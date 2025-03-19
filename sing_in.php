<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    } else {
        echo "Veuillez remplir tous les champs.";
        exit();
    }

   
    
    $filePath = 'data.json';
    if (!file_exists($filePath)) {
        echo "Erreur : le fichier de données est introuvable.";
        exit();
    }

    $users = json_decode(file_get_contents($filePath), true);

    if (!is_array($users)) {
        echo "Erreur : les données utilisateur sont corrompues.";
        exit();
    }

    $userFound = false;

    foreach ($users as $user) {
        
        if (strtolower($user['email']) === strtolower($email)) {
            $userFound = true;

            
            if ($password === $user['pass']) { 
                $_SESSION['user_email'] = $email;
                echo "Connexion réussie. Redirection...";
                header("Location: Home.html");
                exit();
            } else {
                echo "Mot de passe incorrect.";
                exit();
            }
        }
    }

    if (!$userFound) {
        echo "Aucun utilisateur trouvé avec cet email.";
        header("Location: sign_up.html");
        exit();
    }
} else {
    echo "Méthode non autorisée.";
    exit();
}
?>