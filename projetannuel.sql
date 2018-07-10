-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 11 mai 2018 à 15:21
-- Version du serveur :  5.7.19
-- Version de PHP :  7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetannuel`
--

-- --------------------------------------------------------

--
-- Structure de la table `adventure`
--

DROP TABLE IF EXISTS `adventure`;
CREATE TABLE IF NOT EXISTS `adventure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `time` time NOT NULL DEFAULT '00:00:00',
  `progress` float NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '0',
  `save` datetime DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`idUser`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adventure`
--

INSERT INTO `adventure` (`id`, `pseudo`, `gender`, `time`, `progress`, `points`, `save`, `idUser`) VALUES
(32, 'Jeremy428', 1, '00:00:00', 0, 0, NULL, 23),
(16, 'Jeremy85', 1, '00:00:00', 0, 0, NULL, 28);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCategory` (`name`) USING BTREE,
  KEY `fk_user` (`idUser`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `idUser`, `priority`) VALUES
(1, 'informatique', NULL, NULL),
(2, 'categorieASupprimer', NULL, NULL),
(4, 'Tout', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentary`
--

DROP TABLE IF EXISTS `commentary`;
CREATE TABLE IF NOT EXISTS `commentary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `idUser` int(11) DEFAULT NULL,
  `idTopic` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`idUser`) USING BTREE,
  KEY `fk_subject` (`idTopic`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `entrance_test`
--

DROP TABLE IF EXISTS `entrance_test`;
CREATE TABLE IF NOT EXISTS `entrance_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` mediumtext,
  `answer` text,
  `point` int(11) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `name`, `difficulty`, `description`) VALUES
(1, 'Introduction', 1, 'In this part, you will learn how to play to\r\nSick IT '),
(2, 'Part one', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `puzzle`
--

DROP TABLE IF EXISTS `puzzle`;
CREATE TABLE IF NOT EXISTS `puzzle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `personal` tinyint(1) NOT NULL DEFAULT '1',
  `playable` tinyint(1) DEFAULT NULL,
  `content` text NOT NULL,
  `maxPoints` int(11) NOT NULL DEFAULT '50',
  `insOrder` int(11) NOT NULL,
  `expectedTime` int(11) DEFAULT NULL,
  `description` varchar(250) NOT NULL,
  `idSequence` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idTypePuzzle` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE,
  KEY `fk_sequence` (`idSequence`),
  KEY `fk_type_enigme` (`idTypePuzzle`),
  KEY `fk_user` (`idUser`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `puzzle`
--

INSERT INTO `puzzle` (`id`, `name`, `personal`, `playable`, `content`, `maxPoints`, `insOrder`, `expectedTime`, `description`, `idSequence`, `idUser`, `idTypePuzzle`) VALUES
(13, 'Drink a coffee', 1, NULL, 'Take a mug:::Drink ! :::Pour the coffee:::Heat up some water', 50, 4132, 30, 'Replace the instructions to drink a coffee ! ', NULL, NULL, NULL),
(14, 'WARM-UP', 0, NULL, 'Second instruction:::Fourth instruction:::First instruction:::Third instruction', 50, 3142, 30, 'Put the insctructions in the right order ! Easy exercise.', 1, NULL, NULL),
(15, 'uygbjhn', 1, NULL, 'b:::a:::c', 50, 213, 30, 'remet dans lordre ', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `idUser` int(11) DEFAULT NULL,
  `idCategory` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_utilisateur` (`idUser`),
  KEY `fk_categorie` (`idCategory`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resolution`
--

DROP TABLE IF EXISTS `resolution`;
CREATE TABLE IF NOT EXISTS `resolution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idPuzzle` int(11) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_puzzle` (`idPuzzle`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resolution`
--

INSERT INTO `resolution` (`id`, `idUser`, `idPuzzle`, `points`, `time`) VALUES
(72, 23, 14, 50, '00:00:22'),
(71, 23, 15, 50, '00:00:26'),
(70, 23, 13, 50, '00:00:23');

-- --------------------------------------------------------

--
-- Structure de la table `resolutiongame`
--

DROP TABLE IF EXISTS `resolutiongame`;
CREATE TABLE IF NOT EXISTS `resolutiongame` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `progression` int(11) NOT NULL DEFAULT '0',
  `idUser` int(11) NOT NULL,
  `idGame` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk1` (`idUser`),
  KEY `fk2` (`idGame`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resolutiongame`
--

INSERT INTO `resolutiongame` (`id`, `progression`, `idUser`, `idGame`) VALUES
(9, 100, 23, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sequence`
--

DROP TABLE IF EXISTS `sequence`;
CREATE TABLE IF NOT EXISTS `sequence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `goal` varchar(100) NOT NULL,
  `idGame` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sequence`
--

INSERT INTO `sequence` (`id`, `name`, `content`, `goal`, `idGame`) VALUES
(1, 'How to play', 'Let\'s get started with your first game ! HERE WE GO', 'Know how to play', 1),
(2, 'Sequence 1', 'A little more difficult instructions ! ', 'Win against algoenza', 1),
(3, 'Sequence 2', 'Good level', 'Be sure to be good', 1),
(4, 'Final sequence', 'Godlike level, succeed to be the one.', 'Resolve an impossible algorithm', 1);

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` mediumtext,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `idUser` int(11) DEFAULT NULL,
  `idCategory` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category` (`idCategory`) USING BTREE,
  KEY `fk_user` (`idUser`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `subject`
--

INSERT INTO `subject` (`id`, `title`, `description`, `created`, `modified`, `rate`, `views`, `idUser`, `idCategory`) VALUES
(1, 'Le premier sujet de notre site', 'Bon ba voilà, c\'est le tout premier sujet du site', '2018-04-08 00:00:00', '2018-04-08 00:00:00', NULL, 0, 8, 4),
(2, 'Foire aux questions', 'N\'hésitez pas à poser toutes vos questions sur ce sujet.', '2018-04-08 00:00:00', '2018-04-08 00:00:00', NULL, 0, 8, 4),
(3, 'Propositions d\'améliorations du jeu', 'Vous pouvez proposer des éléments du jeu à corriger ou à améliorer sur ce sujet.', '2018-04-08 00:00:00', '2018-04-08 00:00:00', NULL, 0, 8, 4),
(4, 'Tout sur les énigmes', 'Vous pouvez poser des questions si vous êtes bloqués sur des énigmes du jeu ou de la vie.', '2018-04-08 00:00:00', '2018-04-08 00:00:00', NULL, 0, 8, 3),
(36, 'unj', 'hhaaa', '2018-04-30 00:02:19', '2018-05-07 19:32:31', NULL, 2, 23, 4),
(34, 'a', 'a', '2018-04-18 13:58:50', '2018-04-18 13:58:50', NULL, 0, 8, 4),
(33, 'a', 'a', '2018-04-18 13:58:40', '2018-04-18 13:58:40', NULL, 0, 8, 4),
(35, 'MVC la galère', 'C\'est une architecture galère, au début. Et même ça ne servira pas dans des années à venir.', '2018-04-19 10:12:42', '2018-04-19 10:12:42', NULL, 0, 8, 1),
(37, 'Who is the sexiest woman in casa del papel', 'For me it is .......', '2018-05-07 19:25:37', '2018-05-07 19:25:37', 1, 2, 23, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tutorial`
--

DROP TABLE IF EXISTS `tutorial`;
CREATE TABLE IF NOT EXISTS `tutorial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  `idPuzzle` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`) USING BTREE,
  KEY `fk_puzzle` (`idPuzzle`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(80) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` text,
  `points` int(11) NOT NULL DEFAULT '0',
  `created` date DEFAULT NULL,
  `markSite` int(11) DEFAULT NULL,
  `noticeSite` text,
  `time` datetime DEFAULT NULL,
  `creatorMode` tinyint(1) DEFAULT NULL,
  `administrator` tinyint(1) DEFAULT NULL,
  `ban` datetime DEFAULT NULL,
  `test` int(11) DEFAULT NULL,
  `confirmKey` varchar(255) DEFAULT NULL,
  `confirm` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `email`, `password`, `points`, `created`, `markSite`, `noticeSite`, `time`, `creatorMode`, `administrator`, `ban`, `test`, `confirmKey`, `confirm`) VALUES
(23, 'jeremAdmin', 'ter@gmail.com', '49882d81304819f9305febe0d553b29e81308b5cb41c1f72de9b34ec66df52a974afe48ee4272f636446bebee57d1478c35997e53af89226e6d2e4045a0dc19c', 850, '2018-04-26', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL),
(28, 'Jeremdu27', 'jacovite@laposte.net', '49882d81304819f9305febe0d553b29e81308b5cb41c1f72de9b34ec66df52a974afe48ee4272f636446bebee57d1478c35997e53af89226e6d2e4045a0dc19c', 850, '2018-05-06', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `voters`
--

DROP TABLE IF EXISTS `voters`;
CREATE TABLE IF NOT EXISTS `voters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idTopic` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `voters`
--

INSERT INTO `voters` (`id`, `idUser`, `idTopic`, `rate`) VALUES
(1, 23, 37, 1),
(2, 23, 37, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
