// Panneau d'administration - JavaScript

// Variables globales pour la pagination séparée
let currentPagePending = 1;
let currentPageAccepted = 1;
let itemsPerPagePending = 10;
let itemsPerPageAccepted = 10;

document.addEventListener('DOMContentLoaded', function() {
    // Initialisation
    initializePanel();
    
    // Gestionnaires d'événements
    setupEventListeners();
    
    // Chargement initial des données
    loadPendingReservations();
    loadAcceptedReservations();
    loadGalaStatus();
    loadPrix();
});

// Initialisation du panneau
function initializePanel() {
    console.log('Panneau d\'administration initialisé');
}

// Configuration des écouteurs d'événements
function setupEventListeners() {
    // Boutons de statut des réservations
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-accept')) {
            handleAcceptReservation(e.target.dataset.id);
        }
        if (e.target.classList.contains('btn-delete')) {
            handleDeleteReservation(e.target.dataset.id);
        }
        if (e.target.classList.contains('btn-toggle-gala')) {
            handleToggleGala();
        }
        if (e.target.classList.contains('btn-clear-all')) {
            handleClearAllReservations();
        }
        if (e.target.classList.contains('btn-update-prix')) {
            handleUpdatePrix();
        }
        // Gestion de la pagination pour les réservations en attente
        if (e.target.classList.contains('btn-prev-page-pending')) {
            changePagePending(currentPagePending - 1);
        }
        if (e.target.classList.contains('btn-next-page-pending')) {
            changePagePending(currentPagePending + 1);
        }
        if (e.target.classList.contains('btn-page-number-pending')) {
            const page = parseInt(e.target.dataset.page);
            changePagePending(page);
        }
        // Gestion de la pagination pour les réservations acceptées
        if (e.target.classList.contains('btn-prev-page-accepted')) {
            changePageAccepted(currentPageAccepted - 1);
        }
        if (e.target.classList.contains('btn-next-page-accepted')) {
            changePageAccepted(currentPageAccepted + 1);
        }
        if (e.target.classList.contains('btn-page-number-accepted')) {
            const page = parseInt(e.target.dataset.page);
            changePageAccepted(page);
        }
    });
}

// Fonction pour changer de page pour les réservations en attente
function changePagePending(page) {
    if (page < 1) return;
    currentPagePending = page;
    loadPendingReservations();
}

// Fonction pour changer de page pour les réservations acceptées
function changePageAccepted(page) {
    if (page < 1) return;
    currentPageAccepted = page;
    loadAcceptedReservations();
}

// Fonction pour changer le nombre d'éléments par page pour les réservations en attente
function changeItemsPerPagePending(limit) {
    itemsPerPagePending = limit;
    currentPagePending = 1; // Retour à la première page
    loadPendingReservations();
}

// Fonction pour changer le nombre d'éléments par page pour les réservations acceptées
function changeItemsPerPageAccepted(limit) {
    itemsPerPageAccepted = limit;
    currentPageAccepted = 1; // Retour à la première page
    loadAcceptedReservations();
}

// Fonction de test de connexion
function testConnection() {
    console.log('Test de connexion à la base de données...');
    
    fetch('admin_actions.php?action=test_connection')
    .then(response => {
        console.log('Réponse test:', response.status, response.statusText);
        return response.json();
    })
    .then(data => {
        console.log('Résultat test:', data);
        if (data.success) {
            showNotification(`Connexion OK - ${data.total_reservations} réservations trouvées`, 'success');
        } else {
            showNotification(`Erreur: ${data.message}`, 'error');
        }
    })
    .catch(error => {
        console.error('Erreur test:', error);
        showNotification('Erreur de connexion au serveur', 'error');
    });
}

// Gestion des réservations
function handleAcceptReservation(id) {
    showConfirmModal(
        'Accepter la réservation',
        'Accepter cette réservation ?',
        () => {
            fetch('admin_actions.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=accept_reservation&id=${id}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Réservation acceptée avec succès !', 'success');
                    loadPendingReservations();
                    loadAcceptedReservations();
                } else {
                    showNotification('Erreur lors de l\'acceptation de la réservation', 'error');
                }
            })
            .catch(() => showNotification('Erreur de connexion', 'error'));
        }
    );
}

function handleDeleteReservation(id) {
    showConfirmModal(
        'Supprimer la réservation',
        'Supprimer cette réservation ? Cette action est irréversible.',
        () => {
            fetch('admin_actions.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=delete_reservation&id=${id}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Réservation supprimée avec succès !', 'success');
                    loadPendingReservations();
                    loadAcceptedReservations();
                } else {
                    showNotification('Erreur lors de la suppression de la réservation', 'error');
                }
            })
            .catch(() => showNotification('Erreur de connexion', 'error'));
        }
    );
}

// Gestion du gala
function handleToggleGala() {
    fetch('admin_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=toggle_gala'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            loadGalaStatus();
        } else {
            showNotification('Erreur lors de la modification du statut du gala', 'error');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur de connexion', 'error');
    });
}

// Gestion du vidage des réservations
function handleClearAllReservations() {
    showConfirmModal(
        'Vider toutes les réservations',
        'ATTENTION : Cette action va supprimer TOUTES les réservations de la base de données. Cette action est irréversible. Êtes-vous absolument sûr ?',
        () => {
            fetch('admin_actions.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=clear_all_reservations'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Toutes les réservations ont été supprimées !', 'success');
                    loadPendingReservations();
                    loadAcceptedReservations();
                } else {
                    showNotification('Erreur lors du vidage des réservations', 'error');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showNotification('Erreur de connexion', 'error');
            });
        }
    );
}

// Gestion des prix
function handleUpdatePrix() {
    const prixAdulte = document.getElementById('prix_adulte').value;
    const prixEnfant = document.getElementById('prix_enfant').value;
    
    if (!prixAdulte || !prixEnfant) {
        showNotification('Veuillez remplir tous les champs de prix', 'error');
        return;
    }
    
    fetch('admin_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=update_prix&prix_adulte=${prixAdulte}&prix_enfant=${prixEnfant}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Prix mis à jour avec succès !', 'success');
            loadPrix();
        } else {
            showNotification('Erreur lors de la mise à jour des prix', 'error');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur de connexion', 'error');
    });
}

// Chargement des données
function loadPendingReservations() {
    fetch(`admin_actions.php?action=get_reservations&page=${currentPagePending}&limit=${itemsPerPagePending}&type=pending`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateReservationsTable(data.reservations, data.pagination);
            loadCounters();
        } else {
            showNotification(data.message || 'Erreur lors du chargement', 'error');
        }
    })
    .catch(() => showNotification('Erreur de connexion au serveur', 'error'));
}

function loadAcceptedReservations() {
    fetch(`admin_actions.php?action=get_reservations&page=${currentPageAccepted}&limit=${itemsPerPageAccepted}&type=accepted`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateAcceptedReservationsTable(data.accepted_reservations, data.pagination);
        } else {
            showNotification(data.message || 'Erreur lors du chargement', 'error');
        }
    })
    .catch(() => showNotification('Erreur de connexion au serveur', 'error'));
}

// Fonction pour charger les compteurs
function loadCounters() {
    // Charger les compteurs depuis une requête séparée
    fetch('admin_actions.php?action=get_counters')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCounters(data.total_pending, data.total_accepted);
        }
    })
    .catch(error => {
        console.error('Erreur lors du chargement des compteurs:', error);
    });
}

function loadGalaStatus() {
    fetch('admin_actions.php?action=get_gala_status')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateGalaStatus(data.gala_status);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}

function loadPrix() {
    fetch('admin_actions.php?action=get_prix')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('prix_adulte').value = data.prix_adulte;
            document.getElementById('prix_enfant').value = data.prix_enfant;
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}

// Mise à jour des tableaux
function updateReservationsTable(reservations, pagination) {
    const tbody = document.getElementById('reservations-tbody');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    if (reservations.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-gray-500">Aucune réservation en attente</td></tr>';
        return;
    }
    
    reservations.forEach(reservation => {
        const row = document.createElement('tr');
        row.className = 'table-row border-b border-gray-200 hover:bg-gray-50';
        
        // Calcul du total des places
        const totalPlaces = parseInt(reservation.n_adulte) + parseInt(reservation.n_enfant);
        const placesText = `${reservation.n_adulte}A ${reservation.n_enfant}E`;
        
        row.innerHTML = `
            <td class="px-4 py-3 text-sm">
                <div class="font-medium text-gray-900">${reservation.prenom} ${reservation.nom}</div>
                <div class="text-gray-500 text-xs">${reservation.mail}</div>
                <div class="text-gray-400 text-xs">${formatDate(reservation.date_reservation)}</div>
            </td>
            <td class="px-4 py-3 text-sm text-center">
                <div class="font-medium text-gray-900">${totalPlaces}</div>
                <div class="text-gray-500 text-xs">${placesText}</div>
            </td>
            <td class="px-4 py-3 text-sm font-medium text-green-600">${reservation.prix}</td>
            <td class="px-4 py-3 text-sm text-gray-900">${reservation.horaire}</td>
            <td class="px-4 py-3 text-sm text-center">${reservation.collectedonnee === 'accepte' ? '<span class=\'text-green-600 font-bold\'>✔</span>' : '<span class=\'text-red-500\'>✖</span>'}</td>
            <td class="px-4 py-3 text-sm">
                <div class="flex flex-col space-y-1">
                    <button class="btn-accept action-btn bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs" data-id="${reservation.ID_reservation}">
                        ✓
                    </button>
                    <button class="btn-delete action-btn bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${reservation.ID_reservation}">
                        ✕
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
    
    // Mettre à jour la pagination pour ce tableau
    updateTablePagination('reservations', pagination, 'pending');
}

function updateAcceptedReservationsTable(reservations, pagination) {
    const tbody = document.getElementById('accepted-reservations-tbody');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    if (reservations.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-gray-500">Aucune réservation acceptée</td></tr>';
        return;
    }
    
    reservations.forEach(reservation => {
        const row = document.createElement('tr');
        row.className = 'table-row border-b border-gray-200 hover:bg-gray-50';
        
        // Calcul du total des places
        const totalPlaces = parseInt(reservation.n_adulte) + parseInt(reservation.n_enfant);
        const placesText = `${reservation.n_adulte}A ${reservation.n_enfant}E`;
        
        row.innerHTML = `
            <td class="px-4 py-3 text-sm">
                <div class="font-medium text-gray-900">${reservation.prenom} ${reservation.nom}</div>
                <div class="text-gray-500 text-xs">${reservation.mail}</div>
                <div class="text-gray-400 text-xs">${formatDate(reservation.date_reservation)}</div>
            </td>
            <td class="px-4 py-3 text-sm text-center">
                <div class="font-medium text-gray-900">${totalPlaces}</div>
                <div class="text-gray-500 text-xs">${placesText}</div>
            </td>
            <td class="px-4 py-3 text-sm font-medium text-green-600">${reservation.prix}</td>
            <td class="px-4 py-3 text-sm text-gray-900">${reservation.horaire}</td>
            <td class="px-4 py-3 text-sm text-center">${reservation.collectedonnee === 'accepte' ? '<span class=\'text-green-600 font-bold\'>✔</span>' : '<span class=\'text-red-500\'>✖</span>'}</td>
            <td class="px-4 py-3 text-sm">
                <button class="btn-delete action-btn bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs w-full" data-id="${reservation.ID_reservation}">
                    ✕
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
    
    // Mettre à jour la pagination pour ce tableau
    updateTablePagination('accepted-reservations', pagination, 'accepted');
}

// Mise à jour des compteurs
function updateCounters(pendingReservations, acceptedReservations) {
    const pendingCount = document.getElementById('pending-count');
    const acceptedCount = document.getElementById('accepted-count');
    
    if (pendingCount) {
        pendingCount.textContent = pendingReservations;
    }
    
    if (acceptedCount) {
        acceptedCount.textContent = acceptedReservations;
    }
}

// Mise à jour de la pagination pour un tableau spécifique
function updateTablePagination(tableId, pagination, type) {
    const tableContainer = document.querySelector(`#${tableId}-container`);
    if (!tableContainer) return;
    
    // Supprimer l'ancienne pagination
    const oldPagination = tableContainer.querySelector('.pagination-controls');
    if (oldPagination) {
        oldPagination.remove();
    }
    
    const totalPages = type === 'pending' ? pagination.total_pages_pending : pagination.total_pages_accepted;
    const totalItems = type === 'pending' ? pagination.total_pending : pagination.total_accepted;
    const hasPrev = type === 'pending' ? pagination.has_prev_pending : pagination.has_prev_accepted;
    const hasNext = type === 'pending' ? pagination.has_next_pending : pagination.has_next_accepted;
    const currentPage = type === 'pending' ? currentPagePending : currentPageAccepted;
    const itemsPerPage = type === 'pending' ? itemsPerPagePending : itemsPerPageAccepted;
    
    // Toujours afficher la pagination, même avec une seule page
    const paginationDiv = document.createElement('div');
    paginationDiv.className = 'pagination-controls flex items-center justify-between px-6 py-4 border-t border-gray-200 bg-gray-50';
    
    // Informations sur la pagination
    const startItem = (currentPage - 1) * itemsPerPage + 1;
    const endItem = Math.min(currentPage * itemsPerPage, totalItems);
    
    paginationDiv.innerHTML = `
        <div class="text-sm text-gray-700">
            Affichage de ${startItem} à ${endItem} sur ${totalItems} réservations
        </div>
        <div class="flex items-center space-x-2">
            <button class="btn-prev-page-${type} px-3 py-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 ${!hasPrev ? 'opacity-50 cursor-not-allowed' : ''}" ${!hasPrev ? 'disabled' : ''}>
                Précédent
            </button>
            <div class="flex space-x-1">
                ${generatePageNumbers(currentPage, totalPages, type)}
            </div>
            <button class="btn-next-page-${type} px-3 py-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 ${!hasNext ? 'opacity-50 cursor-not-allowed' : ''}" ${!hasNext ? 'disabled' : ''}>
                Suivant
            </button>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-700 ml-3">Par page</span>
            <select onchange="changeItemsPerPage${type === 'pending' ? 'Pending' : 'Accepted'}(parseInt(this.value))" class="text-sm border border-gray-300 rounded-md px-2 py-1">
                <option value="10" ${itemsPerPage === 10 ? 'selected' : ''}>10</option>
                <option value="25" ${itemsPerPage === 25 ? 'selected' : ''}>25</option>
                <option value="50" ${itemsPerPage === 50 ? 'selected' : ''}>50</option>
                <option value="100" ${itemsPerPage === 100 ? 'selected' : ''}>100</option>
            </select>
        </div>
    `;
    
    tableContainer.appendChild(paginationDiv);
}

function generatePageNumbers(currentPage, totalPages, type) {
    let pages = [];
    const maxVisiblePages = 5;
    
    if (totalPages <= maxVisiblePages) {
        // Afficher toutes les pages
        for (let i = 1; i <= totalPages; i++) {
            pages.push(i);
        }
    } else {
        // Logique pour afficher un sous-ensemble des pages
        if (currentPage <= 3) {
            pages = [1, 2, 3, 4, 5, '...', totalPages];
        } else if (currentPage >= totalPages - 2) {
            pages = [1, '...', totalPages - 4, totalPages - 3, totalPages - 2, totalPages - 1, totalPages];
        } else {
            pages = [1, '...', currentPage - 1, currentPage, currentPage + 1, '...', totalPages];
        }
    }
    
    return pages.map(page => {
        if (page === '...') {
            return '<span class="px-2 py-1 text-gray-500">...</span>';
        }
        const isActive = page === currentPage;
        return `
            <button class="btn-page-number-${type} px-3 py-1 text-sm font-medium rounded-md ${isActive ? 'bg-blue-500 text-white' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-50'}" data-page="${page}">
                ${page}
            </button>
        `;
    }).join('');
}

function updateGalaStatus(status) {
    const btn = document.getElementById('gala-toggle-btn');
    const statusText = document.getElementById('gala-status-text');
    const statusTextControl = document.getElementById('gala-status-text-control');
    
    if (status == 1) {
        btn.className = 'btn-toggle-gala status-btn bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200';
        btn.textContent = 'Fermer les inscriptions';
        statusText.textContent = 'Inscriptions ouvertes';
        statusText.className = 'text-green-600 font-medium';
        statusTextControl.textContent = 'Inscriptions ouvertes';
        statusTextControl.className = 'font-medium text-green-600';
    } else {
        btn.className = 'btn-toggle-gala status-btn bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200';
        btn.textContent = 'Ouvrir les inscriptions';
        statusText.textContent = 'Inscriptions fermées';
        statusText.className = 'text-red-600 font-medium';
        statusTextControl.textContent = 'Inscriptions fermées';
        statusTextControl.className = 'font-medium text-red-600';
    }
}

// Utilitaires
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm ${
        type === 'success' ? 'bg-green-500 text-white' :
        type === 'error' ? 'bg-red-500 text-white' :
        'bg-blue-500 text-white'
    }`;
    
    notification.innerHTML = `
        <div class="flex items-center justify-between">
            <span>${message}</span>
            <button class="btn-close-notification ml-4 text-white hover:text-gray-200 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Ajouter le gestionnaire d'événement directement sur le bouton de fermeture
    const closeBtn = notification.querySelector('.btn-close-notification');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            hideNotification();
        });
    }
    
    // Auto-fermeture après 5 secondes
    setTimeout(() => {
        hideNotification();
    }, 5000);
}

function hideNotification() {
    const notification = document.querySelector('.notification');
    if (notification) {
        notification.classList.add('hide');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }
}

function showConfirmModal(title, message, onConfirm) {
    const modal = document.createElement('div');
    // Utilisation d'un fond semi-transparent avec backdrop-blur pour un effet de flou et d'opacité corrects
    modal.className = 'modal-backdrop fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50';
    modal.innerHTML = `
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4  border-1 border-black">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">${title}</h3>
                <button class="btn-close-modal text-gray-400 hover:text-gray-600 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="text-gray-600 mb-6">${message}</p>
            <div class="flex justify-end space-x-3">
                <button class="btn-close-modal px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
                    Annuler
                </button>
                <button class="btn-confirm px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded font-medium">
                    Confirmer
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Ajouter les gestionnaires d'événements pour les boutons de fermeture
    const closeButtons = modal.querySelectorAll('.btn-close-modal');
    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            closeModal();
        });
    });
    
    // Gestionnaire pour le bouton de confirmation
    const confirmBtn = modal.querySelector('.btn-confirm');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', () => {
            closeModal();
            onConfirm();
        });
    }
    
    // Fermer la modale en cliquant sur l'arrière-plan
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });
}

function closeModal() {
    const modal = document.querySelector('.modal-backdrop');
    if (modal) {
        modal.remove();
    }
}
