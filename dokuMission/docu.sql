-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 08 Décembre 2014 à 08:10
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `docu`
--
CREATE DATABASE IF NOT EXISTS `docu` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `docu`;

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `dateCreation` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_repertorier` (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `document`
--

INSERT INTO `document` (`id`, `theme_id`, `titre`, `dateCreation`) VALUES
(1, 1, 'Créer un diagramme des cas d''utilisation', '2014-11-17 00:00:00'),
(2, 5, 'Les films comiques', '2014-12-01 00:00:00'),
(3, 6, 'Les films tragiques', '2014-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE IF NOT EXISTS `domaine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monde_id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `FK_ASSOCIATION_2` (`monde_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `domaine`
--

INSERT INTO `domaine` (`id`, `monde_id`, `libelle`, `description`) VALUES
(1, 1, 'Développement', 'Prog, développement Web, dév d''applications'),
(2, 1, 'Analyse', NULL),
(3, 1, 'Réseau', 'Les glandeurs'),
(4, 2, 'Cinéma', NULL),
(5, 2, 'Sculpture / Architecture', NULL),
(6, 2, 'Dessin / Arabesque', NULL),
(7, 2, 'Peinture', NULL),
(8, 2, 'Musique', NULL),
(9, 2, 'Danse', NULL),
(10, 2, 'Littérature / Poésie', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

CREATE TABLE IF NOT EXISTS `droit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `droit`
--

INSERT INTO `droit` (`id`, `libelle`) VALUES
(1, 'Lecture'),
(2, 'Modification'),
(3, 'Suppression'),
(4, 'Création');

-- --------------------------------------------------------

--
-- Structure de la table `droitdacces`
--

CREATE TABLE IF NOT EXISTS `droitdacces` (
  `theme_id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `droit_id` int(11) NOT NULL,
  PRIMARY KEY (`theme_id`,`groupe_id`,`droit_id`),
  KEY `FK_DroitDacces2` (`groupe_id`),
  KEY `FK_DroitDacces3` (`droit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `droitdacces`
--

INSERT INTO `droitdacces` (`theme_id`, `groupe_id`, `droit_id`) VALUES
(1, 1, 1),
(5, 1, 1),
(1, 2, 1),
(1, 2, 2),
(1, 2, 3),
(1, 2, 4),
(5, 2, 1),
(5, 2, 2),
(5, 2, 4),
(1, 3, 1),
(1, 3, 2),
(1, 3, 3),
(1, 3, 4),
(5, 3, 1),
(5, 3, 2),
(5, 3, 3),
(5, 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id`, `libelle`) VALUES
(1, 'Utilisateur'),
(2, 'Editeur'),
(3, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `monde`
--

CREATE TABLE IF NOT EXISTS `monde` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `monde`
--

INSERT INTO `monde` (`id`, `libelle`) VALUES
(1, 'Informatique'),
(2, 'Art');

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE IF NOT EXISTS `partie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `contenu` text,
  `ordre` smallint(6) DEFAULT NULL,
  `niveau` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `partie`
--

INSERT INTO `partie` (`id`, `titre`, `contenu`, `ordre`, `niveau`) VALUES
(1, 'Introduction', 'Le diagramme des cas d''utilisation est un outil...', 1, 1),
(2, 'Introduction', 'Bla bla bla films comiques bla bla bla...', 1, 1),
(3, 'Développement', 'Les films comiques sont patati patata...', 2, 1),
(4, 'Bibliographie', 'Voici des exemples de films comiques :\r\n\r\n- Qu''est-ce qu''on a fait au bon Dieu.\r\n- \r\n-\r\n\r\n...', 3, 2),
(5, 'Introduction', 'Bla bla bla films tragiques bla bla bla...', 1, 1),
(6, 'Développement', 'Les films tragiques sont patati patata...', 2, 1),
(7, 'Bibliographie', 'Voici des exemples de films tragiques :\r\n\r\n- Le pianiste.\r\n- \r\n-\r\n\r\n...', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `partieversion`
--

CREATE TABLE IF NOT EXISTS `partieversion` (
  `version_id` int(11) NOT NULL,
  `partie_id` int(11) NOT NULL,
  PRIMARY KEY (`version_id`,`partie_id`),
  KEY `FK_PartieVersion2` (`partie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `partieversion`
--

INSERT INTO `partieversion` (`version_id`, `partie_id`) VALUES
(1, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(3, 7);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` int(11) DEFAULT NULL,
  `domaine_id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Contenir` (`domaine_id`),
  KEY `FK_declinerEn` (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`id`, `theme_id`, `domaine_id`, `libelle`) VALUES
(1, NULL, 2, 'Analyse fonctionnelle'),
(2, NULL, 8, 'Classique'),
(3, NULL, 8, 'Rock'),
(4, NULL, 8, 'Métal'),
(5, NULL, 4, 'Comédie'),
(6, NULL, 4, 'Tragédie'),
(7, NULL, 7, 'Pointillisme'),
(8, NULL, 7, 'Impressionisme'),
(9, NULL, 9, 'Classique'),
(10, NULL, 9, 'Tango');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupe_id` int(11) DEFAULT NULL,
  `monde_id` int(11) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_TRAVAILLERDANS` (`monde_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `groupe_id`, `monde_id`, `login`, `password`, `nom`, `prenom`, `mail`) VALUES
(1, 3, 1, 'jcheron', '0000', 'HERON', 'JC', 'myaddressmail@gmail.com'),
(2, 1, 1, 'Visitor', 'azerty', 'Itor', 'Elvis', 'El.Visitor@gmail.com'),
(3, 2, 1, 'Editor', '1324', 'Thor', 'Eddy', 'Eddy.Thor@gmail.com'),
(4, 2, 2, 'Modificator', '1234', 'Ficator', 'Moddy', 'Moddy.Ficator@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `version`
--

CREATE TABLE IF NOT EXISTS `version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `dateMaj` datetime DEFAULT NULL,
  `utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_AssocierA` (`document_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `version`
--

INSERT INTO `version` (`id`, `document_id`, `dateMaj`, `utilisateur_id`) VALUES
(1, 1, '2014-11-17 00:00:00', 1),
(2, 2, '2014-12-01 00:00:00', 3),
(3, 3, '2014-12-01 00:00:00', 4);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `FK_repertorier` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`);

--
-- Contraintes pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD CONSTRAINT `FK_ASSOCIATION_2` FOREIGN KEY (`monde_id`) REFERENCES `monde` (`id`);

--
-- Contraintes pour la table `droitdacces`
--
ALTER TABLE `droitdacces`
  ADD CONSTRAINT `FK_DroitDacces` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`),
  ADD CONSTRAINT `FK_DroitDacces2` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_DroitDacces3` FOREIGN KEY (`droit_id`) REFERENCES `droit` (`id`);

--
-- Contraintes pour la table `partieversion`
--
ALTER TABLE `partieversion`
  ADD CONSTRAINT `FK_PartieVersion` FOREIGN KEY (`version_id`) REFERENCES `version` (`id`),
  ADD CONSTRAINT `FK_PartieVersion2` FOREIGN KEY (`partie_id`) REFERENCES `partie` (`id`);

--
-- Contraintes pour la table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `FK_Contenir` FOREIGN KEY (`domaine_id`) REFERENCES `domaine` (`id`),
  ADD CONSTRAINT `FK_declinerEn` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_TRAVAILLERDANS` FOREIGN KEY (`monde_id`) REFERENCES `monde` (`id`),
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `version`
--
ALTER TABLE `version`
  ADD CONSTRAINT `FK_AssocierA` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`),
  ADD CONSTRAINT `version_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
