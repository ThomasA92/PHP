-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 12 Octobre 2015 à 14:50
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `diw3_entreprise`
--

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

CREATE TABLE IF NOT EXISTS `employes` (
  `id_employes` int(4) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(20) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `sexe` enum('m','f') NOT NULL,
  `service` varchar(30) DEFAULT NULL,
  `date_embauche` date DEFAULT NULL,
  `salaire` float DEFAULT NULL,
  `id_secteur` int(2) NOT NULL,
  PRIMARY KEY (`id_employes`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7958 ;

--
-- Contenu de la table `employes`
--

INSERT INTO `employes` (`id_employes`, `prenom`, `nom`, `sexe`, `service`, `date_embauche`, `salaire`, `id_secteur`) VALUES
(7256, 'daniel', 'chevel', 'm', 'informatique', '2010-07-05', 1700, 10),
(7369, 'julien', 'cottet', 'm', 'secretariat', '2007-01-18', 1170, 10),
(7499, 'fabrice', 'grand', 'm', 'comptabilite', '2003-02-20', 1600, 10),
(7521, 'elodie', 'fellier', 'f', 'secretariat', '2002-02-22', 1250, 10),
(7566, 'stephanie', 'lafaye', 'f', 'assistant manager', '1998-04-02', 1775, 10),
(7654, 'damien', 'durand', 'm', 'commercial', '2005-09-28', 1250, 30),
(7698, 'thomas', 'winter', 'm', 'commercial', '1998-05-03', 2550, 20),
(7782, 'laura', 'blanchet', 'f', 'direction', '1998-06-09', 3050, 10),
(7788, 'jean-pierre', 'laborde', 'm', 'direction', '1997-12-09', 5000, 10),
(7839, 'thierry', 'desprez', 'm', 'standardiste', '2009-11-17', 1100, 10),
(7844, 'emilie', 'sennard', 'f', 'commercial', '1999-09-11', 1800, 40),
(7845, 'celine', 'perrin', 'f', 'commercial', '2006-09-10', 1500, 10),
(7846, 'melanie', 'collier', 'f', 'commercial', '2000-09-08', 1900, 30),
(7847, 'chloe', 'dubar', 'f', 'commercial', '2001-09-05', 2100, 30),
(7848, 'guillaume', 'miller', 'm', 'commercial', '2006-07-02', 1700, 20),
(7876, 'nathalie', 'martin', 'f', 'juridique', '2012-01-12', 3200, 10),
(7900, 'benoit', 'lagarde', 'm', 'chef de projet', '1999-01-03', 2050, 10),
(7902, 'mathieu', 'vignal', 'm', 'informatique', '2008-12-03', 1800, 10),
(7934, 'amandine', 'thoyer', 'f', 'charge de communication', '2010-01-23', 1500, 40);

-- --------------------------------------------------------

--
-- Structure de la table `localite`
--

CREATE TABLE IF NOT EXISTS `localite` (
  `id_localite` int(5) NOT NULL AUTO_INCREMENT,
  `id_secteur` tinyint(3) unsigned NOT NULL,
  `ville` varchar(255) NOT NULL,
  `chiffre_affaires` int(10) NOT NULL,
  PRIMARY KEY (`id_localite`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `localite`
--

INSERT INTO `localite` (`id_localite`, `id_secteur`, `ville`, `chiffre_affaires`) VALUES
(1, 10, 'paris', 525345),
(2, 20, 'marseille', 501236),
(3, 30, 'lyon', 377569),
(4, 40, 'bordeaux', 350988),
(5, 50, 'paris', 122689),
(7, 60, 'lille', 333333);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
