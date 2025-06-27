<?php
session_start();

require '../configdb/setup.php';

if (isset($_POST['envoyer']) && isset($_POST['identifiant']) && isset($_POST['password'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $identifiant = $_POST['identifiant'];
        $password = $_POST['password'];

        // Requête pour trouver l'utilisateur
        $sql = "SELECT * FROM compte WHERE identifiant = :identifiant";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['identifiant' => $identifiant]);
        $compte = $stmt->fetch();

        if ($compte && password_verify($password, $compte['mot_de_passe'])) {
            // Connexion réussie
            $_SESSION['ID_compte'] = $compte['ID_compte'];
            $_SESSION['identifiant'] = $compte['identifiant'];
            $_SESSION['role'] = $compte['role'];

           
            header("Location: ../php/controlpanel.php");
            exit;
        } else {
            header("Location: ../php/connexion.php?erreur=1");
            exit;
        }
    }
}
?>
