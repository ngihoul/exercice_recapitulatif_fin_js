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

    $movie_rental = new MovieRental($_POST);

    $movieRentalManager->create($movie_rental);

    echo 'Location a été créée';
} catch (Exception $exc) {
    $erreur = 'Erreur : ' . $exc->getMessage();
    var_dump('Problème de création : ' . $erreur);
    die($erreur);
}
