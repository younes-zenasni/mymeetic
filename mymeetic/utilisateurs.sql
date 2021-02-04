-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 31 jan. 2021 à 22:03
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mymeetic`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sexe` enum('Homme','Femme','','') NOT NULL,
  `age` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `loisir` set('Sport','Lecture','Cinema','JeuxVidéos','Dance','Skateboard','Cuisiner','Jardiner','Velo') NOT NULL,
  `motdepasse` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `prenom`, `nom`, `email`, `sexe`, `age`, `ville`, `loisir`, `motdepasse`) VALUES
(16, 'Younes', 'Zenasni', 'younes69150@icloud.com', 'Homme', 20, 'Lyon', 'Sport', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(17, 'test1', 'test1', 'tets1@gmail.com', 'Homme', 30, 'Paris', 'Cinema', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(18, 'test2', 'test2', 'test2@gmail.com', 'Homme', 23, 'Lyon', 'Lecture', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(19, 'test3', 'test3', 'test3@gmail.com', 'Homme', 19, 'Lyon', 'Jardiner', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(20, 'test4', 'test4', 'test4@gmail.com', 'Femme', 32, 'Marseille', 'Dance', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(21, 'test5', 'test5', 'test5@gmail.com', 'Femme', 27, 'Paris', 'Cuisiner', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(22, 'test6', 'test6', 'test6@gmail.com', 'Homme', 29, 'Marseille', 'JeuxVidéos', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(23, 'test7', 'test7', 'tets7@gmail.com', 'Femme', 34, 'Lyon', 'Velo', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(24, 'test8', 'test8', 'test8@gmail.com', 'Femme', 36, 'Marseille', 'Sport', 'b3c0730cf3f50613e40561e67c871fdb92820cf9'),
(25, 'test9', 'test9', 'test9@gmail.com', 'Femme', 27, 'Lyon', 'Lecture', '6b6277afcb65d33525545904e95c2fa240632660'),
(26, 'test10', 'test10', 'test10@gmail.com', 'Homme', 26, 'Marseille', 'Skateboard', '86970064ea53b6d66b7c53cbc91c58b4f06fc6fd'),
(27, 'test11', 'test11', 'test11@gmail.com', 'Femme', 23, 'Paris', 'Jardiner', 'fc1200c7a7aa52109d762a9f005b149abef01479'),
(28, 'test12', 'test12', 'test12@gmail.com', 'Femme', 48, 'Paris', 'Velo', '51eac6b471a284d3341d8c0c63d0f1a286262a18'),
(29, 'test13', 'test13', 'tets13@gmail.com', 'Femme', 38, 'Lyon', 'Lecture', '982fd8b711279888a3b54f5af24f185041d22ee6'),
(30, 'test14', 'test14', 'test14@gmail.com', 'Homme', 18, 'Paris', 'Sport', '5e06d22c8893e27d5a7243bd185faa94cc593072'),
(31, 'test15', 'test15', 'test15@gmail.com', 'Femme', 22, 'Paris', 'JeuxVidéos', '35139ef894b28b73bea022755166a23933c7d9cb');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
