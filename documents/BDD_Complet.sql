-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 10 mai 2022 à 07:37
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `acfg_gestion_chataigneraie`
--
CREATE DATABASE IF NOT EXISTS `acfg_gestion_chataigneraie` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `acfg_gestion_chataigneraie`;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220505085540', '2022-05-05 09:02:00', 543);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ent_rs` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_pays` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_adresse` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_cp` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `ent_rs`, `ent_ville`, `ent_pays`, `ent_adresse`, `ent_cp`) VALUES
(1, 'ABC INFORMATIQUE', 'Friville', 'France', 'Zac Le Parc Allée des marettes', '80130 '),
(2, 'Agence Digiworks', 'Mont-Saint-Aignan', 'France', '85 Chemin de Clères', '76130'),
(3, 'AGEVOL Développement', 'Bihorel', 'France', '10 rue du Maréchal De Lattre de Tassigny', '76420'),
(4, 'Agglo du Pays de Dreux', 'Dreux cedex', 'France', '4 rue du Châteaudun BP20159', '28103'),
(5, 'AGISOFT Engineering', 'Martin Eglise', 'France', '79 rue Louis Blériot Zone EuroChannel', '76370'),
(6, 'ALSTOM Petitquevilly', 'PETIT QUEVILLY', 'France', '9 rue des patis CS50154', '76144'),
(8, 'Alternative-conseil', 'St Etienne du Rouvray', 'France', '13 Avenue des Canadiens', '76800'),
(10, 'APAVE', 'Mont Saint Aignan', 'France', '2 rue des mouettes', '76130'),
(11, 'ATTINEOS', 'Le Petit-Quevilly', 'France', '72 rue de la République', '76140'),
(12, 'AUTOLIV ELECTRONIC France', 'Saint-étienne-du-Rouvray', 'France', 'Boulevard Lénine', '76800'),
(13, 'Bearstudio', 'Le Petit-Quevilly', 'France', '72 rue de la République', '76140'),
(14, 'Benteler Aluminium System', 'Louviers', 'France', 'Parc industriel d''Incarville', '27400'),
(15, 'BIM&CO', 'Saint Romain de Colbosc', 'France', 'Parc Eco Normandie', '76430'),
(16, 'Centre Henri-Becquerel', 'Rouen Cedex 1', 'France', 'Rue d''Amiens', '76038'),
(17, 'CPAM Rouen-Elbeuf-Dieppe', 'Rouen Cedex', 'France', '50 avenue de Bretagne', '76039');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise_specialite`
--

DROP TABLE IF EXISTS `entreprise_specialite`;
CREATE TABLE IF NOT EXISTS `entreprise_specialite` (
  `entreprise_id` int(11) NOT NULL,
  `specialite_id` int(11) NOT NULL,
  PRIMARY KEY (`entreprise_id`,`specialite_id`),
  KEY `IDX_4841672AA4AEAFEA` (`entreprise_id`),
  KEY `IDX_4841672A2195E0F0` (`specialite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprise_specialite`
--

INSERT INTO `entreprise_specialite` (`entreprise_id`, `specialite_id`) VALUES
(16, 1),
(16, 2),
(16, 3),
(16, 4);

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

DROP TABLE IF EXISTS `fonction`;
CREATE TABLE IF NOT EXISTS `fonction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fon_libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fonction`
--

INSERT INTO `fonction` (`id`, `fon_libelle`) VALUES
(1, 'Directeur de production'),
(2, 'Administrateur Système et Réseaux'),
(3, 'Directeur de projets'),
(4, 'Responsable service développement'),
(5, 'Directeur des Systèmes d''information');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_id` int(11) DEFAULT NULL,
  `per_nom` varchar(38) COLLATE utf8mb4_unicode_ci NOT NULL,
  `per_prenom` varchar(38) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_mail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_tel_perso` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_tel_pro` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FCEC9EFA4AEAFEA` (`entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id`, `entreprise_id`, `per_nom`, `per_prenom`, `per_mail`, `per_tel_perso`, `per_tel_pro`) VALUES
(1, 17, 'Amouret', 'Anne', 'anne.amouret@cpam-rouen-elbeuf-dieppe.cnamts.fr', '0235036378', NULL),
(2, 3, 'Leuleu', 'Patrick', 'l.leuleu@agevol.fr', '332181832', NULL),
(4, 5, 'Barré', 'Stéphane', 's.barre@agisoft-e.fr', NULL, NULL),
(5, 4, 'Loïc', 'Soumillon', 'l.soumillon@dreux-agglomeration.fr', NULL, NULL),
(6, 6, 'Ronan', 'Pensec', 'ronan.pensec@alstomgroup.com', '0760901598', NULL),
(7, 6, 'Delmas', 'Christophe', 'christophe.delmas@alta-soft.com', '0972307020', '0972307020'),
(8, NULL, 'Lepelletier', 'Régis', 'r.leppeletier@alternative-conseil.com', NULL, NULL),
(9, 8, 'Avigni', 'David', 'david.avigni@ankapi.com', NULL, NULL),
(10, NULL, 'Bruneau', 'Jérémy', 'jeremy.bruneau@apave.com', '0778860116', NULL),
(11, 10, 'Henry', 'Frédéric', 'f.henry-cs@attineos.com', '0652333636', '0235764739'),
(12, 11, 'Michel', 'David', 'david.michel@autoliv.com', NULL, NULL),
(13, 12, 'Decamp', 'Renan', 'renan@bearstudio.fr', '0760391776', NULL),
(14, 13, 'Andres', 'Aurélien', 'aurelien.andres@benteler.com', '0633562780', NULL),
(15, 14, 'Lepiller', 'Antoine', 'alepiller@bimandco.com', '0763916210', NULL),
(16, 15, 'Le Denmat', 'Jean-Marc', 'jean-marc.le-denmat@chb.unicancer.fr', '0232082209', '0232082958'),
(17, 15, '', 'Jean-Marc', 'jean-marc.le-denmat@chb.unicancer.fr', '0232082209', '0232082958'),
(18, 17, 'Boulard', 'Christophe', 'christophe.boulard@assurance-maladie.fr', '0235036497', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `personne_fonction`
--

DROP TABLE IF EXISTS `personne_fonction`;
CREATE TABLE IF NOT EXISTS `personne_fonction` (
  `personne_id` int(11) NOT NULL,
  `fonction_id` int(11) NOT NULL,
  PRIMARY KEY (`personne_id`,`fonction_id`),
  KEY `IDX_CAD2D4F8A21BD112` (`personne_id`),
  KEY `IDX_CAD2D4F857889920` (`fonction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personne_fonction`
--

INSERT INTO `personne_fonction` (`personne_id`, `fonction_id`) VALUES
(2, 1),
(4, 2),
(11, 3),
(15, 4),
(16, 5);

-- --------------------------------------------------------

--
-- Structure de la table `personne_profil`
--

DROP TABLE IF EXISTS `personne_profil`;
CREATE TABLE IF NOT EXISTS `personne_profil` (
  `personne_id` int(11) NOT NULL,
  `profil_id` int(11) NOT NULL,
  PRIMARY KEY (`personne_id`,`profil_id`),
  KEY `IDX_D2AC8A7AA21BD112` (`personne_id`),
  KEY `IDX_D2AC8A7A275ED078` (`profil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personne_profil`
--

INSERT INTO `personne_profil` (`personne_id`, `profil_id`) VALUES
(2, 3),
(5, 1),
(7, 4),
(8, 3),
(10, 2),
(11, 4),
(16, 2);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `pro_type`) VALUES
(1, 'Responsable'),
(2, 'Tuteur'),
(3, 'Jury'),
(4, 'Envoi de CV');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spe_libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id`, `spe_libelle`) VALUES
(1, '1 SIO SLAM'),
(2, '2 SIO SLAM'),
(3, '1 SIO SISR'),
(4, '2 SIO SISR');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uti_login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uti_mdp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uti_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `uti_login`, `uti_mdp`, `uti_admin`) VALUES
(5, 'LyceeChatos', '6120cdb5f13b08aec0a29325a7662871d53a1115e070395bc64673ed5dbe78a3', 1),
(6, 'CatBar', '06980f0a5fc42bf64f2339f1a73c29884d3e8888b076c4887dd3ecc0e59ffea1', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entreprise_specialite`
--
ALTER TABLE `entreprise_specialite`
  ADD CONSTRAINT `FK_4841672A2195E0F0` FOREIGN KEY (`specialite_id`) REFERENCES `specialite` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4841672AA4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `FK_FCEC9EFA4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `personne_fonction`
--
ALTER TABLE `personne_fonction`
  ADD CONSTRAINT `FK_CAD2D4F857889920` FOREIGN KEY (`fonction_id`) REFERENCES `fonction` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CAD2D4F8A21BD112` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `personne_profil`
--
ALTER TABLE `personne_profil`
  ADD CONSTRAINT `FK_D2AC8A7A275ED078` FOREIGN KEY (`profil_id`) REFERENCES `profil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D2AC8A7AA21BD112` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
