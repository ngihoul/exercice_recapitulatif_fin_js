<?php

// Autoload.
function loadClass($classname) {
    require $classname . '.php';
}

spl_autoload_register('loadClass');

try {
    // String de connexion à adapter selon votre environnement
    $USER = 'root';
    $PASSWORD = '';
    $connexion = new PDO('mysql:host=localhost;dbname=primeflix;charset=utf8', $USER, $PASSWORD);
    
    $userManager = new UserManager($connexion);
    
    $id = $_GET['id'];

    $user = $userManager->read($id);

    echo json_encode($user);
} catch (Exception $exc) {
    $erreur = 'Erreur : ' . $exc->getMessage();
    var_dump($erreur);
    die($erreur);
}
