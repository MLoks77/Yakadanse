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
(2, 'Enfant', 5.00, 'Prix pour les enfants', '2025-06-26 23:46:20', '2025-06-26 23:46:20');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ID_reservation` int(11) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `n_adulte` int(11) NOT NULL DEFAULT 0 CHECK (`n_adulte` >= 0),
  `n_enfant` int(11) NOT NULL DEFAULT 0 CHECK (`n_enfant` >= 0),
  `prix` varchar(50) NOT NULL,
  `horaire` text NOT NULL,
  `id_status` int(11) DEFAULT NULL,
  `date_reservation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
-- Doublure de structure pour la vue `vue_reservations_completes`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_reservations_completes` (
`ID_reservation` int(11)
,`prenom` varchar(100)
,`nom` varchar(100)
,`mail` varchar(255)
,`n_adulte` int(11)
,`n_enfant` int(11)
,`prix` varchar(50)
,`horaire` text
,`nom_status` varchar(50)
,`valeur_status` tinyint(1)
,`date_reservation` timestamp
,`date_modification` timestamp
);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_reservations_completes`
--
DROP TABLE IF EXISTS `vue_reservations_completes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_reservations_completes`  AS SELECT `r`.`ID_reservation` AS `ID_reservation`, `r`.`prenom` AS `prenom`, `r`.`nom` AS `nom`, `r`.`mail` AS `mail`, `r`.`n_adulte` AS `n_adulte`, `r`.`n_enfant` AS `n_enfant`, `r`.`prix` AS `prix`, `r`.`horaire` AS `horaire`, `s`.`nom_status` AS `nom_status`, `s`.`valeur_status` AS `valeur_status`, `r`.`date_reservation` AS `date_reservation`, `r`.`date_modification` AS `date_modification` FROM (`reservation` `r` left join `status` `s` on(`r`.`id_status` = `s`.`id_status`)) ORDER BY `r`.`date_reservation` DESC ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`ID_compte`),
  ADD UNIQUE KEY `identifiant` (`identifiant`),
  ADD KEY `idx_identifiant` (`identifiant`),
  ADD KEY `idx_role` (`role`);

--
-- Index pour la table `gala`
--
ALTER TABLE `gala`
  ADD PRIMARY KEY (`id_gala`);

--
-- Index pour la table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id_prix`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ID_reservation`),
  ADD KEY `idx_mail` (`mail`),
  ADD KEY `idx_date_reservation` (`date_reservation`),
  ADD KEY `idx_status` (`id_status`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `ID_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `gala`
--
ALTER TABLE `gala`
  MODIFY `id_gala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id_prix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID_reservation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
