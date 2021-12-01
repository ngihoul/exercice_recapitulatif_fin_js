-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 03 juin 2020 à 17:06
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `primeflix`
--
CREATE DATABASE IF NOT EXISTS `primeflix` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `primeflix`;

-- --------------------------------------------------------

--
-- Structure de la table `movie_rental`
--

DROP TABLE IF EXISTS `movie_rental`;
CREATE TABLE IF NOT EXISTS `movie_rental` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `length` smallint(5) UNSIGNED NOT NULL,
  `year` smallint(5) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_movie_rental_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movie_rental`
--

INSERT INTO `movie_rental` (`id`, `title`, `length`, `year`, `user_id`) VALUES
(1, 'autant en emporte le vent', 243, 1939, 3),
(2, 'la cité de la peur', 93, 1994, 2),
(3, 'casablanca', 102, 1942, 1),
(4, 'autant en emporte le vent', 243, 1939, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `last_name`, `first_name`, `email`, `login`, `password`) VALUES
(1, 'hamilton', 'lewis', 'lewis.hamilton@mercedes.com', 'lhamilton', 'lhamilton'),
(2, 'vettel', 'sebastian', 'vettel.s@ferrari.it', 'svettel', 'svettel'),
(3, 'rosberg', 'nico', 'n.rosberg@mercedes.com', 'nrosberg', 'nrosberg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `movie_rental`
--
ALTER TABLE `movie_rental`
  ADD CONSTRAINT `fk_movie_rental_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
