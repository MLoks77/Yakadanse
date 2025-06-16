<?php
session_start();
include_once '../configdb/connexion.php';
if (isset($_POST['envoyer'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $identifiant = $_POST['Identifiant'];
        $mot_de_passe = $_POST['Mot_de_passe'];

        // Requête pour trouver l'utilisateur
        $sql = "SELECT * FROM utilisateur WHERE Identifiant = :Identifiant";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['Identifiant' => $identifiant]);
        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['Mot_de_passe'])) {
            // Connexion réussie
            $_SESSION['utilisateur_id'] = $utilisateur['ID_utilisateur'];
            $_SESSION['identifiant'] = $utilisateur['Identifiant'];
            $_SESSION['role'] = $utilisateur['role'];
            $_SESSION['nom'] = $utilisateur['Nom'];
            $_SESSION['prenom'] = $utilisateur['Prenom'];
            $_SESSION['Mail'] = $utilisateur['Mail'];

            echo "Connexion réussie !";
            // Redirection vers une page protégée
            header("Location: ../php/controlpanel.php");
            exit;
        } else {
            header("Location: ../connexion.php?erreur=1");
        }
    }
}
