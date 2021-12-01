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

    $movieRentalManager->update($movie_rental);

    echo 'Location (' . $movie_rental->getId() . ') correctement mise à jour';
} catch (Exception $exc) {
    $erreur = 'Erreur : ' . $exc->getMessage();
    var_dump('Problème de mise à jour : ' . $erreur);
    die($erreur);
}
