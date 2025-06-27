<?php
// Fichier pour gérer les actions AJAX du panneau d'administration
header('Content-Type: application/json');

require_once '../configdb/setup.php';

// Récupération de l'action demandée
$action = $_GET['action'] ?? $_POST['action'] ?? '';

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
    
    try {
        // Récupérer l'ID du statut "Confirmé"
        $stmt = $pdo->prepare("SELECT id_status FROM status WHERE nom_status = 'Confirmé' LIMIT 1");
        $stmt->execute();
        $status = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$status) {
            echo json_encode(['success' => false, 'message' => 'Statut "Confirmé" non trouvé']);
            return;
        }
        
        // Mettre à jour la réservation
        $stmt = $pdo->prepare("UPDATE reservation SET id_status = ? WHERE ID_reservation = ?");
        $stmt->execute([$status['id_status'], $id]);
        
        echo json_encode(['success' => true, 'message' => 'Réservation acceptée']);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'acceptation de la réservation']);
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
?> 