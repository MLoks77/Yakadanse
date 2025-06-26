-- Création de la base de données Yakadanse
CREATE DATABASE IF NOT EXISTS yakadanse;
USE yakadanse;

-- Table des prix
CREATE TABLE prix (
    id_prix INT AUTO_INCREMENT PRIMARY KEY,
    type_prix VARCHAR(20) NOT NULL,
    montant DECIMAL(5,2) NOT NULL,
    description TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des statuts
CREATE TABLE status (
    id_status INT AUTO_INCREMENT PRIMARY KEY,
    nom_status VARCHAR(50) NOT NULL,
    valeur_status TINYINT(1) NOT NULL CHECK (valeur_status IN (0, 1)),
    description TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des réservations
CREATE TABLE reservation (
    ID_reservation INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(100) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    n_adulte INT NOT NULL DEFAULT 0 CHECK (n_adulte >= 0),
    n_enfant INT NOT NULL DEFAULT 0 CHECK (n_enfant >= 0),
    prix VARCHAR(50) NOT NULL,
    horaire TEXT NOT NULL,
    id_status INT,
    date_reservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Clés étrangères
    FOREIGN KEY (id_status) REFERENCES status(id_status) ON DELETE SET NULL,
    
    -- Index pour améliorer les performances
    INDEX idx_mail (mail),
    INDEX idx_date_reservation (date_reservation),
    INDEX idx_status (id_status)
);

-- Insertion des données initiales pour la table prix
INSERT INTO prix (type_prix, montant, description) VALUES
('Adulte', 8.00, 'Prix pour les adultes'),
('Enfant', 5.00, 'Prix pour les enfants');

-- Insertion des données initiales pour la table status
INSERT INTO status (nom_status, valeur_status, description) VALUES
('En attente', 0, 'Réservation en attente de confirmation'),
('Confirmé', 1, 'Réservation confirmée'),
('Annulé', 0, 'Réservation annulée'),
('Terminé', 1, 'Réservation terminée');

-- Création d'un trigger pour calculer automatiquement le prix total
DELIMITER //
CREATE TRIGGER calculer_prix_total
BEFORE INSERT ON reservation
FOR EACH ROW
BEGIN
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
END//
DELIMITER ;

-- Création d'un trigger pour les mises à jour
DELIMITER //
CREATE TRIGGER calculer_prix_total_update
BEFORE UPDATE ON reservation
FOR EACH ROW
BEGIN
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
END//
DELIMITER ;

-- Création d'une vue pour faciliter les requêtes
CREATE VIEW vue_reservations_completes AS
SELECT 
    r.ID_reservation,
    r.prenom,
    r.nom,
    r.mail,
    r.n_adulte,
    r.n_enfant,
    r.prix,
    r.horaire,
    s.nom_status,
    s.valeur_status,
    r.date_reservation,
    r.date_modification
FROM reservation r
LEFT JOIN status s ON r.id_status = s.id_status
ORDER BY r.date_reservation DESC;

-- Affichage des tables créées
SHOW TABLES;

-- Affichage de la structure des tables
DESCRIBE prix;
DESCRIBE status;
DESCRIBE reservation; 