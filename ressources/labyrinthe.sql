-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 16 mai 2021 à 15:23
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `labyrinthe`
--

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `ligne` varchar(255) NOT NULL,
  `hauteur` int NOT NULL,
  `Utilisateurs_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_game_Utilisateurs_idx` (`Utilisateurs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `ligne`, `hauteur`, `Utilisateurs_id`) VALUES
(1, '033000000000000', 0, NULL),
(2, '021000000111110', 1, NULL),
(3, '001100111100010', 2, NULL),
(4, '001111110100010', 3, NULL),
(5, '001110001100010', 4, NULL),
(6, '001000001100010', 5, NULL),
(7, '000000111100010', 6, NULL),
(8, '011111111110110', 7, NULL),
(9, '010111011000100', 8, NULL),
(10, '010100011100100', 9, NULL),
(11, '000101110011100', 10, NULL),
(12, '000101001110000', 11, NULL),
(13, '010101101000000', 12, NULL),
(14, '011101101111110', 13, NULL),
(15, '000000000000440', 14, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`) VALUES
(1, 'test');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `fk_game_Utilisateurs` FOREIGN KEY (`Utilisateurs_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
