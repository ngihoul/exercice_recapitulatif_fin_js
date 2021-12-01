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

    $movieRentalManager = new MovieRentalManager($connexion);

    $id = $_POST['id'];

    $movieRentalManager->delete($id);

    echo 'Location (' . $id . ') a été supprimée';
} catch (Exception $exc) {
    $erreur = 'Erreur : ' . $exc->getMessage();
    var_dump('Problème de suppression : ' . $erreur);
    die($erreur);
}
