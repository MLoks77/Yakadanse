<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/accueil.css">
    <link rel="stylesheet" href="../css/main.css">

    <meta name="description" content="Yakadanse - Club de danse à Saint-Pathus. Découvrez nos cours de danse, nos spectacles et rejoignez notre communauté passionnée.">
    <meta name="keywords" content="danse, club, Saint-Pathus, cours, gala, association, Yakadanse">

    <title>Cours - Yakadanse</title>
</head>
<body class="bg-gray-50">
<?php require '../include/navbar.html'; ?>
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
            <!-- Grille principale -->
            <div class="grid lg:grid-cols-2 gap-12">
                
                <!-- Colonne de gauche : Tarifs et Inscriptions -->
                <div class="space-y-8">
                    
                    <!-- Section Tarifs -->
                    <div class="bg-white rounded-xl shadow-lg p-8 animate-fade-in-left">
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
                                    <span class="text-2xl font-bold text-pink-600">100€</span>
                                </div>
                                <p class="text-gray-600">Inscription à l'année complète</p>
                            </div>
                            
                            <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-lg p-6 border-l-4 border-purple-500">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-lg">2 personnes</span>
                                    <span class="text-2xl font-bold text-purple-600">180€</span>
                                </div>
                                <p class="text-gray-600">Même famille - Économie de 20€</p>
                            </div>
                            
                            <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-lg p-6 border-l-4 border-blue-500">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-lg">3 personnes</span>
                                    <span class="text-2xl font-bold text-blue-600">250€</span>
                                </div>
                                <p class="text-gray-600">Même famille - Économie de 50€</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section Inscription -->
                    <div class="bg-white rounded-xl shadow-lg p-8 animate-fade-in-left">
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
                                    <p><strong>Heures :</strong> 8h - 17h</p>
                                    <p><strong>Lieu :</strong> Complexe sportif René Pluvinage</p>
                                    <p><strong>Adresse :</strong> Saint-Pathus</p>
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
                </div>

                <!-- Colonne de droite : Horaires détaillés -->
                <div class="space-y-8">
                    
                    <!-- Section Horaires -->
                    <div class="bg-white rounded-xl shadow-lg p-8 animate-fade-in-right">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6 funnel-display flex items-center">
                            <svg class="w-8 h-8 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Horaires des Cours
                        </h2>

                        <!-- Samedi Matin -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                Samedi Matin
                            </h3>
                            <div class="space-y-4">
                                <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-lg p-4 border-l-4 border-orange-500">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-semibold">6 ans</span>
                                        <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold">9h30 - 10h30</span>
                                    </div>
                                    <p class="text-gray-600"><strong>Professeur :</strong> Helena & Elodie</p>
                                </div>
                                
                                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg p-4 border-l-4 border-yellow-500">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-semibold">8-10 ans (S3)</span>
                                        <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">10h30 - 11h30</span>
                                    </div>
                                    <p class="text-gray-600"><strong>Professeur :</strong> Helena & Elodie</p>
                                </div>
                                
                                <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-lg p-4 border-l-4 border-red-500">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-semibold">14-18 ans (Ados)</span>
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">11h30 - 13h</span>
                                    </div>
                                    <p class="text-gray-600"><strong>Professeur :</strong> Léa</p>
                                </div>
                            </div>
                        </div>

                        <!-- Samedi Après-midi -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                Samedi Après-midi
                            </h3>
                            <div class="space-y-4">
                                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg p-4 border-l-4 border-blue-500">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-semibold">6-7 ans (Bouts de chou)</span>
                                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">14h30 - 15h30</span>
                                    </div>
                                    <p class="text-gray-600"><strong>Professeur :</strong> Marylou</p>
                                </div>
                                
                                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 rounded-lg p-4 border-l-4 border-cyan-500">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-semibold">11-13 ans</span>
                                        <span class="bg-cyan-500 text-white px-3 py-1 rounded-full text-sm font-semibold">13h - 14h30</span>
                                    </div>
                                    <p class="text-gray-600"><strong>Professeur :</strong> Charlotte & Sabrina</p>
                                </div>
                            </div>
                        </div>

                        <!-- Mardi Soir -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                Mardi Soir
                            </h3>
                            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-4 border-l-4 border-purple-500">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold">+ 18 ans (Adultes)</span>
                                    <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">19h45 - 21h15</span>
                                </div>
                                <p class="text-gray-600"><strong>Professeur :</strong> Pierre & Nadège</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php require '../include/footer.html'; ?>
<script src="../js/accueil.js"></script>
<script src="../js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</body>
</html>

