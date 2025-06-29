<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="../images/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../images/favicon/favicon.svg" />
    <link rel="shortcut icon" href="../images/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Yakadanse" />
    <link rel="manifest" href="../images/favicon/site.webmanifest" />
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/panel.css">

    <meta name="description" content="Yakadanse - Panneau d'administration">
    <meta name="keywords" content="admin, yakadanse, réservations, gala">

    <title>Yakadanse - Panneau d'Administration</title>
</head>
<body class="bg-gray-50">
<?php require '../include/navbar.php'; ?>
<?php require '../hero/panel.html'; ?>
    <main class="min-h-screen py-8">
        <!-- En-tête du panneau -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Panneau d'Administration</h1>
                    <p class="text-gray-600">Gérez les réservations, le formulaire du gala, et les prix des tickets</p>
                </div>
                
                <!-- Bouton de déconnexion -->
                <div class="flex items-center space-x-3">
                    <a href="../configdb/logout.php" class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-xs sm:text-sm font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md w-full sm:w-auto justify-center sm:justify-start">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Se déconnecter
                    </a>
                </div>
            </div>

            <!-- Cartes de statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="stats-card bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Réservations en attente</p>
                            <p class="text-2xl font-semibold text-gray-900" id="pending-count">-</p>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Réservations acceptées</p>
                            <p class="text-2xl font-semibold text-gray-900" id="accepted-count">-</p>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Statut du Gala</p>
                            <p class="text-lg font-semibold" id="gala-status-text">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contrôles rapides -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Contrôle du Gala -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contrôle du Gala</h3>
                    <div class="space-y-3">
                        <p class="text-sm text-gray-600">Statut actuel : <span id="gala-status-text-control" class="font-medium">-</span></p>
                        <button id="gala-toggle-btn" class="btn-toggle-gala status-btn w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200">
                            Chargement...
                        </button>
                    </div>
                </div>

                <!-- Gestion des Prix -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Gestion des Prix</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prix Adulte (€)</label>
                            <input type="number" id="prix_adulte" step="0.01" min="0" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prix Enfant (€)</label>
                            <input type="number" id="prix_enfant" step="0.01" min="0" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <button class="btn-update-prix w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200">
                            Mettre à jour
                        </button>
                    </div>
                </div>

                <!-- Gestion des Prix des Danseuses -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Prix des Cours</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">1 danseuse (€)</label>
                            <input type="number" id="prix_danseuse1" step="0.01" min="0" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">2 danseuses (€)</label>
                            <input type="number" id="prix_danseuse2" step="0.01" min="0" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">3 danseuses (€)</label>
                            <input type="number" id="prix_danseuse3" step="0.01" min="0" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <button class="btn-update-prix-danseuses w-full bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200">
                            Mettre à jour
                        </button>
                    </div>
                </div>

                <!-- Actions de masse -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Supprimer les données</h3>
                    <div class="space-y-3">
                        <button class="btn-clear-all w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200">
                            Vider toutes les réservations
                        </button>
                        <p class="text-xs text-gray-500">⚠️ Cette action est irréversible, veuillez vider la base de donnée après chaque gala afin de respecter les mentions légales établis.</p>
                    </div>
                </div>

                <!-- Actualisation -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Base de donnée</h3>
                    <div class="space-y-3">
                        <button onclick="loadPendingReservations(); loadAcceptedReservations();" class="w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200">
                            Actualiser les données
                        </button>
                        <button onclick="testConnection()" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200">
                            Test Connexion DB
                        </button>
                        <p class="text-xs text-gray-500">Recharge les données depuis la base</p>
                    </div>
                </div>
            </div>

            <!-- Tableaux des réservations -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Réservations en attente -->
                <div id="reservations-container" class="bg-white rounded-lg shadow-sm border border-gray-200 flex flex-col min-h-[500px]">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Réservations en attente</h3>
                        <p class="text-sm text-gray-600">Nouvelles demandes de réservation</p>
                    </div>
                    <div class="flex-1 overflow-y-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                    <th class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Places</th>
                                    <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horaire</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Données</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="reservations-tbody" class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-gray-500">
                                        <div class="spinner mx-auto"></div>
                                        <p class="mt-2">Chargement des réservations...</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Réservations acceptées -->
                <div id="accepted-reservations-container" class="bg-white rounded-lg shadow-sm border border-gray-200 flex flex-col min-h-[500px]">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Réservations acceptées</h3>
                        <p class="text-sm text-gray-600">Réservations confirmées</p>
                    </div>
                    <div class="flex-1 overflow-y-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                    <th class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Places</th>
                                    <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horaire</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Données</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="accepted-reservations-tbody" class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-gray-500">
                                        <div class="spinner mx-auto"></div>
                                        <p class="mt-2">Chargement des réservations...</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php require '../include/footer.html'; ?>

<script src="../js/main.js"></script>
<script src="../js/panel.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>
