<?php

session_start();

// Connexion à la base de données pour récupérer les prix
require "../configdb/setup.php";

// Récupérer les prix des danseuses
$stmt = $pdo->prepare("SELECT type_prix, montant FROM prix WHERE type_prix IN ('danseuse1', 'danseuse2', 'danseuse3')");
$stmt->execute();
$prix_danseuses = [];
while ($row = $stmt->fetch()) {
    $prix_danseuses[$row['type_prix']] = $row['montant'];
}

// Valeurs par défaut si les prix ne sont pas trouvés
$prix_danseuse1 = $prix_danseuses['danseuse1'] ?? 100.00;
$prix_danseuse2 = $prix_danseuses['danseuse2'] ?? 180.00;
$prix_danseuse3 = $prix_danseuses['danseuse3'] ?? 250.00;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/accueil.css">
    <link rel="stylesheet" href="../css/main.css">

    <link rel="icon" type="image/png" href="../images/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../images/favicon/favicon.svg" />
    <link rel="shortcut icon" href="../images/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Yakadanse" />
    <link rel="manifest" href="../images/favicon/site.webmanifest" />

    <meta name="description" content="Yakadanse - Club de danse à Saint-Pathus. Découvrez nos cours de danse, nos spectacles et rejoignez notre communauté passionnée.">
    <meta name="keywords" content="danse, club, Saint-Pathus, cours, gala, association, Yakadanse">

    <title>Yakadanse - Cours</title>
</head>
<body class="bg-gray-50">
<?php require '../include/navbar.php'; ?>
<?php require '../hero/courshero.html'; ?>

    <main class="min-h-screen py-16">
        <div class="container mx-auto px-6 max-w-7xl">
            <!-- Section Équipe EN PREMIER -->
            <div class="flex justify-center mb-16">
                <div class="w-full max-w-4xl">
                    <div class="py-8">
                        <h3 class="text-2xl font-bold mb-8 funnel-display text-center">Notre Équipe de Professeurs</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-8">
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/helena.webp" alt="Helena & Elodie" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Helena & Elodie</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/marylou.webp" alt="Marylou" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Marylou</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/charlotte-sabrina.jpg" alt="Charlotte & Sabrina" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Charlotte & Sabrina</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/lea.webp" alt="Léa" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Léa</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/pierrenadage.webp" alt="Pierre & Nadège" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Pierre & Nadège</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nouvelle section avec onglets -->
            <div class="w-full max-w-5xl mx-auto mb-16">
                <div class="tabs-container bg-white rounded-xl shadow-lg p-0">
                    <div class="flex border-b">
                        <button class="tab-link active" data-tab="tarifs">Tarifs</button>
                        <button class="tab-link" data-tab="inscription">Inscription</button>
                        <button class="tab-link" data-tab="horaires">Horaires</button>
                    </div>
                    <div class="tab-content p-8" id="tab-tarifs">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6 funnel-display flex items-center">
                            <svg class="w-8 h-8 mr-3 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            Tarifs Annuels
                        </h2>
                        <div class="space-y-4">
                            <div class="bg-gradient-to-r from-pink-50 to-purple-50 rounded-lg p-6 border-l-4 border-pink-500">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-lg">1 danseuse</span>
                                    <span class="text-2xl font-bold text-pink-600"><?php echo number_format($prix_danseuse1, 2, ',', ' '); ?>€</span>
                                </div>
                                <p class="text-gray-600">Inscription à l'année complète</p>
                            </div>
                            <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-lg p-6 border-l-4 border-purple-500">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-lg">2 personnes</span>
                                    <span class="text-2xl font-bold text-purple-600"><?php echo number_format($prix_danseuse2, 2, ',', ' '); ?>€</span>
                                </div>
                                <p class="text-gray-600">Même famille - Économie de <?php echo number_format($prix_danseuse1 * 2 - $prix_danseuse2, 2, ',', ' '); ?>€</p>
                            </div>
                            <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-lg p-6 border-l-4 border-blue-500">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-lg">3 personnes</span>
                                    <span class="text-2xl font-bold text-blue-600"><?php echo number_format($prix_danseuse3, 2, ',', ' '); ?>€</span>
                                </div>
                                <p class="text-gray-600">Même famille - Économie de <?php echo number_format($prix_danseuse1 * 3 - $prix_danseuse3, 2, ',', ' '); ?>€</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content p-8 hidden" id="tab-inscription">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6 funnel-display flex items-center">
                            <svg class="w-8 h-8 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Inscription
                        </h2>
                        <div class="space-y-6">
                            <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-lg p-6 border-l-4 border-green-500">
                                <h3 class="font-semibold text-lg mb-3 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Forum des Associations
                                </h3>
                                <div class="space-y-2 text-gray-700">
                                    <p><strong>Date :</strong> Premier dimanche de septembre</p>
                                    <p><strong>Heures :</strong> 10h - 16h</p>
                                    <p><strong>Lieu :</strong> Complexe sportif René Pluvinage</p>
                                    <p><strong>Adresse :</strong> 54 Rue des Sources, 77178 Saint-Pathus </p>
                                </div>
                                <br>
                                <div class="flex justify-center">
                                    <div class="w-full md:w-3/4 lg:w-2/3 rounded-lg overflow-hidden shadow-lg">
                                        <iframe 
                                            src="https://www.google.com/maps?q=54+Rue+des+Sources,+77178+Saint-Pathus&output=embed"
                                            width="100%" 
                                            height="400" 
                                            style="border:0;" 
                                            allowfullscreen="" 
                                            loading="lazy" 
                                            referrerpolicy="no-referrer-when-downgrade"
                                        ></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6 border-l-4 border-blue-500">
                                <h3 class="font-semibold text-lg mb-3 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Dossier d'Inscription
                                </h3>
                                <p class="text-gray-700">Un dossier d'inscription vous sera remis au stand Yakadanse lors du forum des associations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content p-8 hidden" id="tab-horaires">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6 funnel-display flex items-center">
                            <svg class="w-8 h-8 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Horaires des Cours
                        </h2>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-time">Samedi Matin</div>
                                <div class="timeline-content">
                                    <div class="timeline-card">
                                        <span class="font-semibold">6 ans</span> <span class="badge badge-primary ml-2">9h30 - 10h30</span><br>
                                        <span class="text-gray-600"><strong>Professeur :</strong> Helena & Elodie</span>
                                    </div>
                                    <div class="timeline-card">
                                        <span class="font-semibold">8-10 ans (S3)</span> <span class="badge badge-secondary ml-2">10h30 - 11h30</span><br>
                                        <span class="text-gray-600"><strong>Professeur :</strong> Helena & Elodie</span>
                                    </div>
                                    <div class="timeline-card">
                                        <span class="font-semibold">14-18 ans (Ados)</span> <span class="badge badge-success ml-2">11h30 - 13h</span><br>
                                        <span class="text-gray-600"><strong>Professeur :</strong> Léa</span>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-time">Samedi Après-midi</div>
                                <div class="timeline-content">
                                    <div class="timeline-card">
                                        <span class="font-semibold">6-7 ans (Bouts de chou)</span> <span class="badge badge-primary ml-2">14h30 - 15h30</span><br>
                                        <span class="text-gray-600"><strong>Professeur :</strong> Marylou</span>
                                    </div>
                                    <div class="timeline-card">
                                        <span class="font-semibold">11-13 ans</span> <span class="badge badge-secondary ml-2">13h - 14h30</span><br>
                                        <span class="text-gray-600"><strong>Professeur :</strong> Charlotte & Sabrina</span>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-time">Mardi Soir</div>
                                <div class="timeline-content">
                                    <div class="timeline-card">
                                        <span class="font-semibold">+ 18 ans (Adultes)</span> <span class="badge badge-success ml-2">19h45 - 21h15</span><br>
                                        <span class="text-gray-600"><strong>Professeur :</strong> Pierre & Nadège</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <button id="backToTop" title="Retour en haut" class="fixed bottom-8 right-8 z-50 bg-pink-600 text-white rounded-full p-3 shadow-lg hover:bg-pink-700 transition-all duration-300 hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
        </svg>
    </button>
    </main>

<?php require '../include/footer.html'; ?>
<script src="../js/accueil.js"></script>
<script src="../js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</body>
</html>

<script>
// Afficher/Masquer le bouton selon le scroll
window.addEventListener('scroll', function() {
    const btn = document.getElementById('backToTop');
    if (window.scrollY > 300) {
        btn.classList.remove('hidden');
    } else {
        btn.classList.add('hidden');
    }
});

// Scroll smooth vers le haut
document.getElementById('backToTop').addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>