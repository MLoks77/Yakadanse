// Panneau d'administration - JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialisation
    initializePanel();
    
    // Gestionnaires d'événements
    setupEventListeners();
    
    // Chargement initial des données
    loadReservations();
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
    });
    
    // Fermeture des modales
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-backdrop') || e.target.classList.contains('btn-close-modal')) {
            closeModal();
        }
    });
    
    // Fermeture des notifications
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-close-notification')) {
            hideNotification();
        }
    });
}

// Gestion des réservations
function handleAcceptReservation(id) {
    if (confirm('Êtes-vous sûr de vouloir accepter cette réservation ?')) {
        fetch('admin_actions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=accept_reservation&id=${id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Réservation acceptée avec succès !', 'success');
                loadReservations();
            } else {
                showNotification('Erreur lors de l\'acceptation de la réservation', 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Erreur de connexion', 'error');
        });
    }
}

function handleDeleteReservation(id) {
    showConfirmModal(
        'Supprimer la réservation',
        'Êtes-vous sûr de vouloir supprimer cette réservation ? Cette action est irréversible.',
        () => {
            fetch('admin_actions.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=delete_reservation&id=${id}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Réservation supprimée avec succès !', 'success');
                    loadReservations();
                } else {
                    showNotification('Erreur lors de la suppression de la réservation', 'error');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showNotification('Erreur de connexion', 'error');
            });
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
                    loadReservations();
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
function loadReservations() {
    fetch('admin_actions.php?action=get_reservations')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateReservationsTable(data.reservations);
            updateAcceptedReservationsTable(data.accepted_reservations);
            updateCounters(data.reservations, data.accepted_reservations);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors du chargement des réservations', 'error');
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
function updateReservationsTable(reservations) {
    const tbody = document.getElementById('reservations-tbody');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    if (reservations.length === 0) {
        tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4 text-gray-500">Aucune réservation en attente</td></tr>';
        return;
    }
    
    reservations.forEach(reservation => {
        const row = document.createElement('tr');
        row.className = 'table-row border-b border-gray-200 hover:bg-gray-50';
        row.innerHTML = `
            <td class="px-4 py-3 text-sm">${reservation.prenom} ${reservation.nom}</td>
            <td class="px-4 py-3 text-sm">${reservation.mail}</td>
            <td class="px-4 py-3 text-sm text-center">${reservation.n_adulte}</td>
            <td class="px-4 py-3 text-sm text-center">${reservation.n_enfant}</td>
            <td class="px-4 py-3 text-sm font-medium">${reservation.prix}</td>
            <td class="px-4 py-3 text-sm">${reservation.horaire}</td>
            <td class="px-4 py-3 text-sm">${formatDate(reservation.date_reservation)}</td>
            <td class="px-4 py-3 text-sm">
                <div class="flex space-x-2">
                    <button class="btn-accept action-btn bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs" data-id="${reservation.ID_reservation}">
                        Accepter
                    </button>
                    <button class="btn-delete action-btn bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${reservation.ID_reservation}">
                        Supprimer
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function updateAcceptedReservationsTable(reservations) {
    const tbody = document.getElementById('accepted-reservations-tbody');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    if (reservations.length === 0) {
        tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4 text-gray-500">Aucune réservation acceptée</td></tr>';
        return;
    }
    
    reservations.forEach(reservation => {
        const row = document.createElement('tr');
        row.className = 'table-row border-b border-gray-200 hover:bg-gray-50';
        row.innerHTML = `
            <td class="px-4 py-3 text-sm">${reservation.prenom} ${reservation.nom}</td>
            <td class="px-4 py-3 text-sm">${reservation.mail}</td>
            <td class="px-4 py-3 text-sm text-center">${reservation.n_adulte}</td>
            <td class="px-4 py-3 text-sm text-center">${reservation.n_enfant}</td>
            <td class="px-4 py-3 text-sm font-medium">${reservation.prix}</td>
            <td class="px-4 py-3 text-sm">${reservation.horaire}</td>
            <td class="px-4 py-3 text-sm">${formatDate(reservation.date_reservation)}</td>
            <td class="px-4 py-3 text-sm">
                <button class="btn-delete action-btn bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs" data-id="${reservation.ID_reservation}">
                    Supprimer
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Mise à jour des compteurs
function updateCounters(pendingReservations, acceptedReservations) {
    const pendingCount = document.getElementById('pending-count');
    const acceptedCount = document.getElementById('accepted-count');
    
    if (pendingCount) {
        pendingCount.textContent = pendingReservations.length;
    }
    
    if (acceptedCount) {
        acceptedCount.textContent = acceptedReservations.length;
    }
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
            <button class="btn-close-notification ml-4 text-white hover:text-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
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
    modal.className = 'modal-backdrop fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
    modal.innerHTML = `
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">${title}</h3>
                <button class="btn-close-modal text-gray-400 hover:text-gray-600">
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
    
    // Gestionnaire pour le bouton de confirmation
    modal.querySelector('.btn-confirm').addEventListener('click', () => {
        closeModal();
        onConfirm();
    });
}

function closeModal() {
    const modal = document.querySelector('.modal-backdrop');
    if (modal) {
        modal.remove();
    }
}
