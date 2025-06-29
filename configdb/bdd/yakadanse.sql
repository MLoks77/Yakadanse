-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 27 juin 2025 à 02:32
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `yakadanse`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `ID_compte` int(11) NOT NULL,
  `identifiant` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`ID_compte`, `identifiant`, `mot_de_passe`, `role`, `date_creation`, `date_modification`) VALUES
(1, 'Yakadanse.assoadmin', '$2y$10$43hBfnDqTZ/UuPFyoGAO3uVuWDqhbio1Mwy7ulwVnjgHQYyGEKG0S', 'admin', '2025-06-27 00:31:42', '2025-06-27 00:31:42');

-- --------------------------------------------------------

--
-- Structure de la table `gala`
--

CREATE TABLE `gala` (
  `id_gala` int(11) NOT NULL,
  `gala` tinyint(1) NOT NULL DEFAULT 0 CHECK (`gala` in (0,1))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gala`
--

INSERT INTO `gala` (`id_gala`, `gala`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE `prix` (
  `id_prix` int(11) NOT NULL,
  `type_prix` varchar(20) NOT NULL,
  `montant` decimal(5,2) NOT NULL,
  `description` text DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prix`
--

INSERT INTO `prix` (`id_prix`, `type_prix`, `montant`, `description`, `date_creation`, `date_modification`) VALUES
(1, 'Adulte', 8.00, 'Prix pour les adultes', '2025-06-26 23:46:20', '2025-06-26 23:46:20'),
(2, 'Enfant', 5.00, 'Prix pour les enfants', '2025-06-26 23:46:20', '2025-06-26 23:46:20'),
(3, 'danseuse1', 100.00, 'Prix pour 1 danseuse', '2025-06-26 23:46:20', '2025-06-26 23:46:20'),
(4, 'danseuse2', 180.00, 'Prix pour 2 danseuse', '2025-06-26 23:46:20', '2025-06-26 23:46:20'),
(5, 'danseuse3', 250.00, 'Prix pour 3 danseuse', '2025-06-26 23:46:20', '2025-06-26 23:46:20');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ID_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `n_adulte` int(11) NOT NULL DEFAULT 0 CHECK (`n_adulte` >= 0),
  `n_enfant` int(11) NOT NULL DEFAULT 0 CHECK (`n_enfant` >= 0),
  `prix` varchar(50) NOT NULL,
  `horaire` text NOT NULL,
  `id_status` int(11) DEFAULT NULL,
  `collectedonnee` text DEFAULT NULL,
  `date_reservation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déclencheurs `reservation`
--
DELIMITER $$
CREATE TRIGGER `calculer_prix_total` BEFORE INSERT ON `reservation` FOR EACH ROW BEGIN
    DECLARE prix_adulte DECIMAL(5,2);
    DECLARE prix_enfant DECIMAL(5,2);
    DECLARE prix_total DECIMAL(8,2);
    
    -- Récupérer les prix actuels
    SELECT montant INTO prix_adulte FROM prix WHERE type_prix = 'Adulte' LIMIT 1;
    SELECT montant INTO prix_enfant FROM prix WHERE type_prix = 'Enfant' LIMIT 1;
    
    -- Calculer le prix total
    SET prix_total = (NEW.n_adulte * prix_adulte) + (NEW.n_enfant * prix_enfant);
    
    -- Mettre à jour le champ prix
    SET NEW.prix = CONCAT(prix_total, ' €');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calculer_prix_total_update` BEFORE UPDATE ON `reservation` FOR EACH ROW BEGIN
    DECLARE prix_adulte DECIMAL(5,2);
    DECLARE prix_enfant DECIMAL(5,2);
    DECLARE prix_total DECIMAL(8,2);
    
    -- Récupérer les prix actuels
    SELECT montant INTO prix_adulte FROM prix WHERE type_prix = 'Adulte' LIMIT 1;
    SELECT montant INTO prix_enfant FROM prix WHERE type_prix = 'Enfant' LIMIT 1;
    
    -- Calculer le prix total
    SET prix_total = (NEW.n_adulte * prix_adulte) + (NEW.n_enfant * prix_enfant);
    
    -- Mettre à jour le champ prix
    SET NEW.prix = CONCAT(prix_total, ' €');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nom_status` varchar(50) NOT NULL,
  `valeur_status` tinyint(1) NOT NULL CHECK (`valeur_status` in (0,1)),
  `description` text DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`id_status`, `nom_status`, `valeur_status`, `description`, `date_creation`) VALUES
(1, 'En attente', 0, 'Réservation en attente de confirmation', '2025-06-26 23:46:20'),
(2, 'Confirmé', 1, 'Réservation confirmée', '2025-06-26 23:46:20'),
(3, 'Annulé', 0, 'Réservation annulée', '2025-06-26 23:46:20'),
(4, 'Terminé', 1, 'Réservation terminée', '2025-06-26 23:46:20');

-- --------------------------------------------------------

--
-- Structure de la table `texte`
--

CREATE TABLE `texte` (
  `ID_text` int(11) NOT NULL AUTO_INCREMENT,
  `type_texte` varchar(50) NOT NULL,
  `texte` text DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_text`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `texte`
--

INSERT INTO `texte` (`ID_text`, `type_texte`, `texte`, `date_creation`, `date_modification`) VALUES
(1, 'gala_texte', 'Les dernières nouvelles du gala', NOW(), NOW()),
(2, 'index_texte', 'Découvrez nos actualités et événements', NOW(), NOW());

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `ID_image` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `chemin_image` varchar(255) DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;