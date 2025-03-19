<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = isset($_POST["lastname"]) ? htmlspecialchars($_POST["lastname"]) : "";
    $name = isset($_POST["name"]) ? htmlspecialchars($_POST["name"]) : "";
    $age = isset($_POST["age"]) ? intval($_POST["age"]) : 0;
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";
    $emailconf = isset($_POST["emailconf"]) ? htmlspecialchars($_POST["emailconf"]) : "";
    $pass = isset($_POST["pass"]) ? htmlspecialchars($_POST["pass"]) : "";
    $passwordconf = isset($_POST["passwordconf"]) ? htmlspecialchars($_POST["passwordconf"]) : "";

    
    if ($email !== $emailconf) {
        echo "Les emails ne correspondent pas.";
        exit;
    }
    
    if ($pass !== $passwordconf) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

  
    $userData = array(
        "lastname" => $lastname,
        "name" => $name,
        "age" => $age,
        "email" => $email,
        "pass" => $pass
    );


    $file = 'data.json';
    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $data = json_decode($jsonData, true);
    } else {
        $data = array();
    }

   
    $data[] = $userData;

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

    echo "Inscription réussie!";
}
?>