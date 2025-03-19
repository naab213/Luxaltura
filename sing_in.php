<?php
session_start(); // Démarrer la session

// Vérifier si le formulaire a été soumis via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs email et password existent dans $_POST
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    } else {
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    // Charger les utilisateurs depuis le fichier JSON
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
        // Vérifier si l'email correspond
        if (strtolower($user['email']) === strtolower($email)) {
            $userFound = true;

            // Vérifier le mot de passe
            if ($password === $user['pass']) { // Remplacez par password_verify si les mots de passe sont hachés
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