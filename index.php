<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="images/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="images/favicon/favicon.svg" />
    <link rel="shortcut icon" href="images/favicon//favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Yakadanse" />
    <link rel="manifest" href="images/favicon/site.webmanifest" />

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/accueil.css">

    <meta name="description" content="Yakadanse - Club de danse à Saint-Pathus. Découvrez nos cours de danse, nos spectacles et rejoignez notre communauté passionnée.">
    <meta name="keywords" content="danse, club, Saint-Pathus, cours, gala, association, Yakadanse">

    <title>Yakadanse - Saint-Pathus</title>
</head>
<body>
<?php require 'includeindex/navbar.html'; ?>
<?php require 'includeindex/indexhero.html'; ?>

    <main class="min-h-screen bg-[#181F20]">
        <!-- Section Bienvenue -->
        <section class="py-16 bg-[#FFFAFA]">
            <div class="container mx-auto px-6 max-w-6xl">
                <div class="text-center mb-12 animate-fade-in-up">
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-800 mb-6 funnel-display gradient-text">
                     <span>Yakadanse</span>
                     <h6>Association de danse en Seine-et-Marne</h6><br>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Découvrez la passion de la danse dans notre club convivial de Saint-Pathus. 
                        Que vous soyez débutant ou confirmé, nous avons le cours qu'il vous faut !
                    </p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8 mt-12">
                    <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 card-hover animate-fade-in-left">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4 icon-bounce">
                                <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Cours pour tous</h3>
                            <p class="text-gray-600">Des cours adaptés à tous les niveaux, de 6 ans à l'âge adulte</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 card-hover animate-fade-in-up">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 icon-bounce">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Spectacles annuels</h3>
                            <p class="text-gray-600">Tout les ans l'association organise un gala au mois de Juin. Ce gala thématique se déroule au Pôle Culturel de Saint-Pathus sur deux représentations.</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 card-hover animate-fade-in-right">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 icon-bounce">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Communauté</h3>
                            <p class="text-gray-600">Partagez votre enthousiasme pour la danse dans un environnement chaleureux et encourageant, où l'entraide et la bienveillance sont au cœur de nos valeurs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Nos Disciplines -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6 max-w-6xl">
                <div class="text-center mb-12 animate-fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 funnel-display">Nos Disciplines</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Découvrez la diversité de nos cours de danse pour tous les âges et tous les niveaux
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Éveil et Initiation -->
                    <div class="discipline-card animate-fade-in-left">
                        <div class="text-center">
                            <span class="badge badge-primary mb-3">3-6 ans</span>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Éveil & Initiation</h3>
                            <p class="text-gray-700 mb-4">Pour les 3-6 ans</p>
                            <ul class="feature-list text-sm text-gray-600 space-y-2 text-left">
                                <li>Découverte du mouvement</li>
                                <li>Coordination et rythme</li>
                                <li>Expression corporelle</li>
                                <li>Jeux dansés</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Classique -->
                    <div class="discipline-card animate-fade-in-up">
                        <div class="text-center">
                            <span class="badge badge-secondary mb-3">7+ ans</span>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Danse Classique</h3>
                            <p class="text-gray-700 mb-4">À partir de 7 ans</p>
                            <ul class="feature-list text-sm text-gray-600 space-y-2 text-left">
                                <li>Technique académique</li>
                                <li>Barre au sol</li>
                                <li>Chorégraphies</li>
                                <li>Préparation aux pointes</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contemporain -->
                    <div class="discipline-card animate-fade-in-right">
                        <div class="text-center">
                            <span class="badge badge-success mb-3">Ados/Adultes</span>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Danse Contemporaine</h3>
                            <p class="text-gray-700 mb-4">Adolescents et adultes</p>
                            <ul class="feature-list text-sm text-gray-600 space-y-2 text-left">
                                <li>Expression libre</li>
                                <li>Improvisation</li>
                                <li>Création chorégraphique</li>
                                <li>Technique moderne</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Jazz -->
                    <div class="discipline-card animate-fade-in-left">
                        <div class="text-center">
                            <span class="badge badge-primary mb-3">Tous niveaux</span>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Jazz</h3>
                            <p class="text-gray-700 mb-4">Tous niveaux</p>
                            <ul class="feature-list text-sm text-gray-600 space-y-2 text-left">
                                <li>Rythme et dynamisme</li>
                                <li>Chorégraphies modernes</li>
                                <li>Technique jazz</li>
                                <li>Style commercial</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Hip-Hop -->
                    <div class="discipline-card animate-fade-in-up">
                        <div class="text-center">
                            <span class="badge badge-secondary mb-3">Ados/Adultes</span>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Hip-Hop</h3>
                            <p class="text-gray-700 mb-4">Adolescents et adultes</p>
                            <ul class="feature-list text-sm text-gray-600 space-y-2 text-left">
                                <li>Break dance</li>
                                <li>Street dance</li>
                                <li>Freestyle</li>
                                <li>Culture urbaine</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Adultes -->
                    <div class="discipline-card animate-fade-in-right">
                        <div class="text-center">
                            <span class="badge badge-success mb-3">Adultes</span>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Cours Adultes</h3>
                            <p class="text-gray-700 mb-4">Tous niveaux</p>
                            <ul class="feature-list text-sm text-gray-600 space-y-2 text-left">
                                <li>Remise en forme</li>
                                <li>Danse de salon</li>
                                <li>Zumba fitness</li>
                                <li>Cours débutants</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Nos Événements -->
        <section class="py-16 bg-[#FFFAFA]">
            <div class="container mx-auto px-6 max-w-6xl">
                <div class="text-center mb-12 animate-fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 funnel-display">Nos Événements</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Découvrez notre spectacle annuel
                    </p>
                </div>

            <section class="py-16">
                <div class="container mx-auto px-6 max-w-6xl flex flex-col md:flex-row items-center gap-12">
                    <!-- Texte à gauche -->
                    <div class="md:w-1/2 w-full mb-8 md:mb-0">
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 funnel-display">Gala de Juin</h3>
                        <p class="text-lg text-gray-700 mb-6">
                            Chaque année, les professeurs de Yakadanse accompagnent et préparent nos danseuses tout au long de la saison en vue du gala de fin d'année. Pour plus d'informations, rendez-vous sur la page dédiée.
                        </p>
<button>
<a href="php/gala.php" class="flex justify-center gap-2 items-center mx-auto shadow-xl text-lg bg-pink-400 hover:bg-pink-600 transition-colors duration-300 text-white lg:font-semibold isolation-auto border-pink-400 hover:border-pink-600 before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0 before:rounded-full before:bg-pink-500 hover:text-white before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700 relative z-10 px-4 py-2 overflow-hidden border-2 rounded-full group" style="text-decoration: none;">
    Découvrir
    <svg
      class="w-8 h-8 justify-end group-hover:rotate-90 group-hover:bg-pink-50 text-pink-50 ease-linear duration-300 rounded-full border border-pink-600 group-hover:border-none p-2 rotate-45"
      viewBox="0 0 16 19"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
        class="fill-white group-hover:fill-pink-600"
      ></path>
    </svg>
</a>
</button>
    </div>
                    <div class="md:w-1/2 w-full flex justify-center">
                        <div id="animation-carousel" class="relative w-full" data-carousel="static">
                            <!-- Carousel wrapper -->
                            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                 <!-- Item 1 -->
                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                    <img src="images/groupe5.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Groupe de danseurs">
                                </div>
                                <!-- Item 2 -->
                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                    <img src="images/final.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Final du gala">
                                </div>
                                <!-- Item 3 -->
                                <div class="hidden duration-200 ease-linear" data-carousel-item="active">
                                    <img src="images/groupe.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Groupe de danseurs">
                                </div>
                                <!-- Item 4 -->
                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                    <img src="images/groupe2.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Groupe de danseurs">
                                </div>
                                <!-- Item 5 -->
                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                    <img src="images/groupe3.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Groupe de danseurs">
                                </div>
                                 <!-- Item 6 -->
                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                    <img src="images/groupe4.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Groupe de danseurs">
                                </div>
                            </div>
                            <!-- Slider controls -->
                            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-white-800/30 group-hover:bg-white/50 dark:group-hover:bg-white-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                    </svg>
                                    <span class="sr-only">Précédente</span>
                                </span>
                            </button>
                            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-white-800/30 group-hover:bg-white/50 dark:group-hover:bg-white-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="sr-only">Prochaine</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            </div>
        </section>
    
      
        <section class="py-16 bg-gradient-to-br from-pink-50 to-purple-50">
            <div class="container mx-auto px-6 max-w-6xl">
                <div class="text-center mb-12 animate-fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 funnel-display">Nous retrouver</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Retrouvez Yakadanse à l'adresse suivante :<br>
                        <span class="font-semibold">77178 Saint-Pathus, France</span><br>
                    </p>
                </div>
                <div class="flex justify-center">
                    <div class="w-full md:w-3/4 lg:w-2/3 rounded-lg overflow-hidden shadow-lg">
                        <iframe 
                            src="https://www.google.com/maps?q=49.07136666617248,2.798486328527565&output=embed"
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
        </section>

    <button id="backToTop" title="Retour en haut" class="fixed bottom-8 right-8 z-50 bg-pink-600 text-white rounded-full p-3 shadow-lg hover:bg-pink-700 transition-all duration-300 hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
        </svg>
    </button>
    </main>
<script src="js/main.js"></script>
<script src="js/accueil.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<?php require 'includeindex/footer.html'; ?>

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