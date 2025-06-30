<?php
// Fichier pour gérer les actions AJAX du panneau d'administration

// Déterminer le Content-Type en fonction de l'action
$action = $_GET['action'] ?? $_POST['action'] ?? '';

// Ne pas définir le header JSON pour l'upload d'images
if ($action !== 'upload_image') {
    header('Content-Type: application/json');
}

require_once '../configdb/setup.php';

// Récupération de l'action demandée
switch($action) {
    case 'get_reservations':
        getReservations($pdo);
        break;
    case 'get_counters':
        getCounters($pdo);
        break;
    case 'test_connection':
        testConnection($pdo);
        break;
    case 'accept_reservation':
        acceptReservation($pdo);
        break;
    case 'delete_reservation':
        deleteReservation($pdo);
        break;
    case 'get_gala_status':
        getGalaStatus($pdo);
        break;
    case 'toggle_gala':
        toggleGala($pdo);
        break;
    case 'clear_all_reservations':
        clearAllReservations($pdo);
        break;
    case 'get_prix':
        getPrix($pdo);
        break;
    case 'update_prix':
        updatePrix($pdo);
        break;
    case 'get_prix_danseuses':
        getPrixDanseuses($pdo);
        break;
    case 'update_prix_danseuses':
        updatePrixDanseuses($pdo);
        break;
    case 'get_texte':
        getTexte($pdo);
        break;
    case 'update_texte':
        updateTexte($pdo);
        break;
    case 'delete_texte':
        deleteTexte($pdo);
        break;
    case 'upload_image':
        uploadImage($pdo);
        break;
    case 'delete_image':
        deleteImage($pdo);
        break;
    case 'get_image_status':
        getImageStatus($pdo);
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Action non reconnue']);
}

// Fonction pour récupérer les compteurs
function getCounters($pdo) {
    try {
        // Compter le total des réservations en attente
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as total 
            FROM reservation r 
            LEFT JOIN status s ON r.id_status = s.id_status 
            WHERE r.id_status IS NULL OR s.valeur_status = 0
        ");
        $stmt->execute();
        $totalPending = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        // Compter le total des réservations acceptées
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as total 
            FROM reservation r 
            LEFT JOIN status s ON r.id_status = s.id_status 
            WHERE s.valeur_status = 1
        ");
        $stmt->execute();
        $totalAccepted = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        echo json_encode([
            'success' => true,
            'total_pending' => $totalPending,
            'total_accepted' => $totalAccepted
        ]);
        
    } catch(PDOException $e) {
        error_log("Erreur SQL: " . $e->getMessage());
        echo json_encode([
            'success' => false, 
            'message' => 'Erreur lors de la récupération des compteurs',
            'debug' => $e->getMessage()
        ]);
    }
}

// Fonction pour récupérer les réservations
function getReservations($pdo) {
    try {
        // Paramètres de pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $type = isset($_GET['type']) ? $_GET['type'] : 'pending';
        $offset = ($page - 1) * $limit;
        
        if ($type === 'pending') {
            // Compter le total des réservations en attente
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as total 
                FROM reservation r 
                LEFT JOIN status s ON r.id_status = s.id_status 
                WHERE r.id_status IS NULL OR s.valeur_status = 0
            ");
            $stmt->execute();
            $totalPending = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Réservations en attente avec pagination
            $stmt = $pdo->prepare("
                SELECT r.*, s.nom_status 
                FROM reservation r 
                LEFT JOIN status s ON r.id_status = s.id_status 
                WHERE r.id_status IS NULL OR s.valeur_status = 0
                ORDER BY r.date_reservation DESC, r.ID_reservation DESC
                LIMIT :limit OFFSET :offset
            ");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Calculer les informations de pagination
            $totalPagesPending = ceil($totalPending / $limit);
            
            $response = [
                'success' => true,
                'reservations' => $reservations,
                'pagination' => [
                    'current_page' => $page,
                    'limit' => $limit,
                    'total_pending' => $totalPending,
                    'total_pages_pending' => $totalPagesPending,
                    'has_prev_pending' => $page > 1,
                    'has_next_pending' => $page < $totalPagesPending
                ]
            ];
        } else {
            // Compter le total des réservations acceptées
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as total 
                FROM reservation r 
                LEFT JOIN status s ON r.id_status = s.id_status 
                WHERE s.valeur_status = 1
            ");
            $stmt->execute();
            $totalAccepted = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Réservations acceptées avec pagination
            $stmt = $pdo->prepare("
                SELECT r.*, s.nom_status 
                FROM reservation r 
                LEFT JOIN status s ON r.id_status = s.id_status 
                WHERE s.valeur_status = 1
                ORDER BY r.date_reservation DESC, r.ID_reservation DESC
                LIMIT :limit OFFSET :offset
            ");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $accepted_reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Calculer les informations de pagination
            $totalPagesAccepted = ceil($totalAccepted / $limit);
            
            $response = [
                'success' => true,
                'accepted_reservations' => $accepted_reservations,
                'pagination' => [
                    'current_page' => $page,
                    'limit' => $limit,
                    'total_accepted' => $totalAccepted,
                    'total_pages_accepted' => $totalPagesAccepted,
                    'has_prev_accepted' => $page > 1,
                    'has_next_accepted' => $page < $totalPagesAccepted
                ]
            ];
        }
        
        echo json_encode($response);
        
    } catch(PDOException $e) {
        error_log("Erreur SQL: " . $e->getMessage());
        echo json_encode([
            'success' => false, 
            'message' => 'Erreur lors de la récupération des réservations',
            'debug' => $e->getMessage()
        ]);
    } catch(Exception $e) {
        error_log("Erreur générale: " . $e->getMessage());
        echo json_encode([
            'success' => false, 
            'message' => 'Erreur générale',
            'debug' => $e->getMessage()
        ]);
    }
}

// Fonction de test de connexion
function testConnection($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM reservation");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'message' => 'Connexion OK',
            'total_reservations' => $result['total']
        ]);
    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur de connexion',
            'debug' => $e->getMessage()
        ]);
    }
}

// Fonction pour accepter une réservation
function acceptReservation($pdo) {
    $id = $_POST['id'] ?? null;
    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'ID de réservation manquant']);
        return;
    }
    if (!is_numeric($id)) {
        echo json_encode(['success' => false, 'message' => 'ID de réservation invalide', 'debug' => $id]);
        return;
    }
    try {
        $stmt = $pdo->prepare("SELECT id_status FROM status WHERE nom_status = 'Confirmé' LIMIT 1");
        $stmt->execute();
        $status = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$status) {
            echo json_encode(['success' => false, 'message' => 'Statut "Confirmé" non trouvé']);
            return;
        }
        $stmt = $pdo->prepare("UPDATE reservation SET id_status = ? WHERE ID_reservation = ?");
        $stmt->execute([$status['id_status'], $id]);
        echo json_encode(['success' => true, 'message' => 'Réservation acceptée']);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'acceptation de la réservation', 'debug' => $e->getMessage()]);
    }
}

// Fonction pour supprimer une réservation
function deleteReservation($pdo) {
    $id = $_POST['id'] ?? null;
    
    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'ID de réservation manquant']);
        return;
    }
    
    try {
        $stmt = $pdo->prepare("DELETE FROM reservation WHERE ID_reservation = ?");
        $stmt->execute([$id]);
        
        echo json_encode(['success' => true, 'message' => 'Réservation supprimée']);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression de la réservation']);
    }
}

// Fonction pour récupérer le statut du gala
function getGalaStatus($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT gala FROM gala LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            echo json_encode(['success' => true, 'gala_status' => $result['gala']]);
        } else {
            // Créer une entrée par défaut si la table est vide
            $stmt = $pdo->prepare("INSERT INTO gala (gala) VALUES (0)");
            $stmt->execute();
            echo json_encode(['success' => true, 'gala_status' => 0]);
        }
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la récupération du statut du gala']);
    }
}

// Fonction pour basculer le statut du gala
function toggleGala($pdo) {
    try {
        // Récupérer le statut actuel
        $stmt = $pdo->prepare("SELECT gala FROM gala LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$result) {
            // Créer une entrée si elle n'existe pas
            $stmt = $pdo->prepare("INSERT INTO gala (gala) VALUES (1)");
            $stmt->execute();
            echo json_encode(['success' => true, 'message' => 'Inscriptions ouvertes']);
        } else {
            // Basculer le statut
            $newStatus = $result['gala'] == 1 ? 0 : 1;
            $stmt = $pdo->prepare("UPDATE gala SET gala = ?");
            $stmt->execute([$newStatus]);
            
            $message = $newStatus == 1 ? 'Inscriptions ouvertes' : 'Inscriptions fermées';
            echo json_encode(['success' => true, 'message' => $message]);
        }
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la modification du statut du gala']);
    }
}

// Fonction pour vider toutes les réservations
function clearAllReservations($pdo) {
    try {
        $stmt = $pdo->prepare("DELETE FROM reservation");
        $stmt->execute();
        
        echo json_encode(['success' => true, 'message' => 'Toutes les réservations ont été supprimées']);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors du vidage des réservations']);
    }
}

// Fonction pour récupérer les prix
function getPrix($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT type_prix, montant FROM prix WHERE type_prix IN ('Adulte', 'Enfant')");
        $stmt->execute();
        $prix = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $prix_adulte = 8.00;
        $prix_enfant = 5.00;
        
        foreach ($prix as $p) {
            if ($p['type_prix'] == 'Adulte') {
                $prix_adulte = $p['montant'];
            } elseif ($p['type_prix'] == 'Enfant') {
                $prix_enfant = $p['montant'];
            }
        }
        
        echo json_encode([
            'success' => true,
            'prix_adulte' => $prix_adulte,
            'prix_enfant' => $prix_enfant
        ]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la récupération des prix']);
    }
}

// Fonction pour mettre à jour les prix
function updatePrix($pdo) {
    $prix_adulte = $_POST['prix_adulte'] ?? null;
    $prix_enfant = $_POST['prix_enfant'] ?? null;
    
    if (!$prix_adulte || !$prix_enfant) {
        echo json_encode(['success' => false, 'message' => 'Prix manquants']);
        return;
    }
    
    try {
        // Mettre à jour le prix adulte
        $stmt = $pdo->prepare("UPDATE prix SET montant = ? WHERE type_prix = 'Adulte'");
        $stmt->execute([$prix_adulte]);
        
        // Mettre à jour le prix enfant
        $stmt = $pdo->prepare("UPDATE prix SET montant = ? WHERE type_prix = 'Enfant'");
        $stmt->execute([$prix_enfant]);
        
        echo json_encode(['success' => true, 'message' => 'Prix mis à jour']);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour des prix']);
    }
}

// Fonction pour récupérer les prix des danseuses
function getPrixDanseuses($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT type_prix, montant FROM prix WHERE type_prix IN ('danseuse1', 'danseuse2', 'danseuse3')");
        $stmt->execute();
        $prix = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $prix_danseuse1 = 100.00;
        $prix_danseuse2 = 180.00;
        $prix_danseuse3 = 250.00;
        
        // Vérifier si les prix existent et les créer si nécessaire
        $prix_existants = [];
        foreach ($prix as $p) {
            $prix_existants[] = $p['type_prix'];
            if ($p['type_prix'] == 'danseuse1') {
                $prix_danseuse1 = $p['montant'];
            } elseif ($p['type_prix'] == 'danseuse2') {
                $prix_danseuse2 = $p['montant'];
            } elseif ($p['type_prix'] == 'danseuse3') {
                $prix_danseuse3 = $p['montant'];
            }
        }
        
        // Créer les prix manquants
        if (!in_array('danseuse1', $prix_existants)) {
            $stmt = $pdo->prepare("INSERT INTO prix (type_prix, montant, description) VALUES ('danseuse1', ?, 'Prix pour 1 danseuse')");
            $stmt->execute([$prix_danseuse1]);
        }
        if (!in_array('danseuse2', $prix_existants)) {
            $stmt = $pdo->prepare("INSERT INTO prix (type_prix, montant, description) VALUES ('danseuse2', ?, 'Prix pour 2 danseuses')");
            $stmt->execute([$prix_danseuse2]);
        }
        if (!in_array('danseuse3', $prix_existants)) {
            $stmt = $pdo->prepare("INSERT INTO prix (type_prix, montant, description) VALUES ('danseuse3', ?, 'Prix pour 3 danseuses')");
            $stmt->execute([$prix_danseuse3]);
        }
        
        echo json_encode([
            'success' => true,
            'prix_danseuse1' => $prix_danseuse1,
            'prix_danseuse2' => $prix_danseuse2,
            'prix_danseuse3' => $prix_danseuse3
        ]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la récupération des prix des danseuses', 'debug' => $e->getMessage()]);
    }
}

// Fonction pour mettre à jour les prix des danseuses
function updatePrixDanseuses($pdo) {
    $prix_danseuse1 = $_POST['prix_danseuse1'] ?? null;
    $prix_danseuse2 = $_POST['prix_danseuse2'] ?? null;
    $prix_danseuse3 = $_POST['prix_danseuse3'] ?? null;
    
    if (!$prix_danseuse1 || !$prix_danseuse2 || !$prix_danseuse3) {
        echo json_encode(['success' => false, 'message' => 'Prix des danseuses manquants']);
        return;
    }
    
    try {
        // Mettre à jour le prix danseuse1
        $stmt = $pdo->prepare("UPDATE prix SET montant = ? WHERE type_prix = 'danseuse1'");
        $stmt->execute([$prix_danseuse1]);
        
        // Mettre à jour le prix danseuse2
        $stmt = $pdo->prepare("UPDATE prix SET montant = ? WHERE type_prix = 'danseuse2'");
        $stmt->execute([$prix_danseuse2]);
        
        // Mettre à jour le prix danseuse3
        $stmt = $pdo->prepare("UPDATE prix SET montant = ? WHERE type_prix = 'danseuse3'");
        $stmt->execute([$prix_danseuse3]);
        
        echo json_encode(['success' => true, 'message' => 'Prix des danseuses mis à jour']);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour des prix des danseuses']);
    }
}

// Fonction pour récupérer un texte
function getTexte($pdo) {
    $type = $_GET['type'] ?? '';
    
    if (!$type) {
        echo json_encode(['success' => false, 'message' => 'Type de texte manquant']);
        return;
    }
    
    try {
        $stmt = $pdo->prepare("SELECT texte FROM texte WHERE type_texte = ? LIMIT 1");
        $stmt->execute([$type]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'texte' => $result ? $result['texte'] : null
        ]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la récupération du texte']);
    }
}

// Fonction pour mettre à jour un texte
function updateTexte($pdo) {
    $type = $_POST['type'] ?? '';
    $texte = $_POST['texte'] ?? '';
    
    if (!$type) {
        echo json_encode(['success' => false, 'message' => 'Type de texte manquant']);
        return;
    }
    
    try {
        // Vérifier si le texte existe déjà
        $stmt = $pdo->prepare("SELECT ID_text FROM texte WHERE type_texte = ? LIMIT 1");
        $stmt->execute([$type]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($existing) {
            // Mettre à jour le texte existant
            $stmt = $pdo->prepare("UPDATE texte SET texte = ? WHERE type_texte = ?");
            $stmt->execute([$texte, $type]);
        } else {
            // Créer un nouveau texte
            $stmt = $pdo->prepare("INSERT INTO texte (type_texte, texte) VALUES (?, ?)");
            $stmt->execute([$type, $texte]);
        }
        
        echo json_encode(['success' => true, 'message' => 'Texte mis à jour avec succès']);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour du texte']);
    }
}

// Fonction pour supprimer un texte
function deleteTexte($pdo) {
    $type = $_POST['type'] ?? '';
    
    if (!$type) {
        echo json_encode(['success' => false, 'message' => 'Type de texte manquant']);
        return;
    }
    
    try {
        $stmt = $pdo->prepare("UPDATE texte SET texte = NULL WHERE type_texte = ?");
        $stmt->execute([$type]);
        
        echo json_encode(['success' => true, 'message' => 'Texte supprimé avec succès']);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression du texte']);
    }
}

// Fonction pour uploader une image
function uploadImage($pdo) {
    // Définir le header JSON pour la réponse
    header('Content-Type: application/json');
    
    $type = $_POST['type'] ?? '';
    
    if (!$type) {
        echo json_encode(['success' => false, 'message' => 'Type d\'image manquant']);
        return;
    }
    
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errorMessage = 'Aucune image fournie';
        if (isset($_FILES['image'])) {
            switch ($_FILES['image']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $errorMessage = 'Le fichier dépasse la taille maximale autorisée par PHP';
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $errorMessage = 'Le fichier dépasse la taille maximale autorisée par le formulaire';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $errorMessage = 'Le fichier n\'a été que partiellement uploadé';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $errorMessage = 'Aucun fichier n\'a été uploadé';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $errorMessage = 'Dossier temporaire manquant';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $errorMessage = 'Échec de l\'écriture du fichier sur le disque';
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $errorMessage = 'Une extension PHP a arrêté l\'upload du fichier';
                    break;
            }
        }
        echo json_encode(['success' => false, 'message' => $errorMessage]);
        return;
    }
    
    $file = $_FILES['image'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    
    if (!in_array($file['type'], $allowedTypes)) {
        echo json_encode(['success' => false, 'message' => 'Type de fichier non autorisé. Types acceptés: JPEG, PNG, GIF, WebP']);
        return;
    }
    
    if ($file['size'] > 5 * 1024 * 1024) { // 5MB max
        echo json_encode(['success' => false, 'message' => 'Fichier trop volumineux (max 5MB)']);
        return;
    }
    
    try {
        // Vérifier que le dossier de destination existe
        $uploadDir = '../images/img/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                echo json_encode(['success' => false, 'message' => 'Impossible de créer le dossier de destination']);
                return;
            }
        }
        
        // Vérifier les permissions d'écriture
        if (!is_writable($uploadDir)) {
            echo json_encode(['success' => false, 'message' => 'Le dossier de destination n\'est pas accessible en écriture']);
            return;
        }
        
        // Générer un nom de fichier unique
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = $type . '_' . time() . '.' . $extension;
        $uploadPath = $uploadDir . $filename;
        
        // Supprimer l'ancienne image si elle existe
        $stmt = $pdo->prepare("SELECT chemin_image FROM image WHERE type = ? LIMIT 1");
        $stmt->execute([$type]);
        $oldImage = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($oldImage && $oldImage['chemin_image']) {
            $oldPath = $uploadDir . $oldImage['chemin_image'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }
        
        // Uploader la nouvelle image
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            // Mettre à jour la base de données
            $stmt = $pdo->prepare("SELECT ID_image FROM image WHERE type = ? LIMIT 1");
            $stmt->execute([$type]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existing) {
                $stmt = $pdo->prepare("UPDATE image SET chemin_image = ? WHERE type = ?");
                $stmt->execute([$filename, $type]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO image (type, chemin_image) VALUES (?, ?)");
                $stmt->execute([$type, $filename]);
            }
            
            echo json_encode(['success' => true, 'message' => 'Image uploadée avec succès', 'filename' => $filename]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'upload de l\'image. Vérifiez les permissions du dossier.']);
        }
    } catch(PDOException $e) {
        error_log("Erreur PDO lors de l'upload d'image: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Erreur de base de données lors de l\'upload de l\'image']);
    } catch(Exception $e) {
        error_log("Erreur générale lors de l'upload d'image: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'upload de l\'image']);
    }
}

// Fonction pour supprimer une image
function deleteImage($pdo) {
    $type = $_POST['type'] ?? '';
    
    if (!$type) {
        echo json_encode(['success' => false, 'message' => 'Type d\'image manquant']);
        return;
    }
    
    try {
        // Récupérer le chemin de l'image
        $stmt = $pdo->prepare("SELECT chemin_image FROM image WHERE type = ? LIMIT 1");
        $stmt->execute([$type]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result && $result['chemin_image']) {
            $imagePath = '../images/img/' . $result['chemin_image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        // Supprimer de la base de données
        $stmt = $pdo->prepare("UPDATE image SET chemin_image = NULL WHERE type = ?");
        $stmt->execute([$type]);
        
        echo json_encode(['success' => true, 'message' => 'Image supprimée avec succès']);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression de l\'image']);
    }
}

// Fonction pour récupérer le statut des images
function getImageStatus($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT type, chemin_image FROM image WHERE chemin_image IS NOT NULL");
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $status = [];
        foreach ($images as $image) {
            $status[$image['type']] = $image['chemin_image'];
        }
        
        echo json_encode([
            'success' => true,
            'images' => $status
        ]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la récupération du statut des images']);
    }
}
?> 