-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 13 déc. 2020 à 10:51
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
-- Base de données : `tutube`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`) VALUES
(8, 'Nakatox', 'vincent.loron@sfr.fr', 'bonsoir'),
(9, 'Denvuss', 'martin.revollat@gmail.com', 'pute'),
(10, 'Alexandre', 'lala.non@oui.fr', 'lala');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `url`, `title`, `description`) VALUES
(12, 'https://www.youtube.com/watch?v=_fNHOBCJ64k', 'bonsoir', 'grgsrgs'),
(13, 'https://www.youtube.com/watch?v=_fNHOBCJ64k', 'bonsoir', 'grgsrgs'),
(11, 'https://www.youtube.com/watch?v=_fNHOBCJ64k', 'bonsoir', 'grgsrgs'),
(14, 'https://www.youtube.com/watch?v=_fNHOBCJ64k', 'bonsoir', 'grgsrgs'),
(15, 'https://www.youtube.com/watch?v=_fNHOBCJ64k', 'bonsoir', 'grgsrgs'),
(16, 'https://www.youtube.com/watch?v=_fNHOBCJ64k', 'bonsoir', 'grgsrgs');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
