<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/accueil.css">

    <link rel="icon" type="image/png" href="../images/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../images/favicon/favicon.svg" />
    <link rel="shortcut icon" href="../images/favicon//favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Yakadanse" />
    <link rel="manifest" href="../images/favicon/site.webmanifest" />

    <meta name="description" content="Yakadanse - Club de danse à Saint-Pathus. Découvrez nos cours de danse, nos spectacles et rejoignez notre communauté passionnée.">
    <meta name="keywords" content="danse, club, Saint-Pathus, cours, gala, association, Yakadanse">

    <title>L'association</title>
</head>
<body>
<?php require '../include/navbar.html'; ?>
<?php require '../hero/associationhero.html'; ?>

    <main class="min-h-screen py-16">
    <div class="container mx-auto px-6 max-w-7xl">
            <!-- Section Équipe EN PREMIER -->
            <div class="flex justify-center mb-8">
                <div class="w-full max-w-4xl">
                    <div class="py-8">
                        <h3 class="text-2xl font-bold mb-8 funnel-display text-center">Nos membres du Bureau</h3>
                        <h6 class="text-1xl font-bold mb-8 funnel-display text-center"> Découvrez les membres en charge des spectacles et du bon fonctionnement de l'association.</h6>
                        <div class="flex flex-wrap justify-center gap-13 sm:grid sm:grid-cols-3 md:grid-cols-5">
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/helena.webp" alt="Helena Omiel" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Helena Omiel</span>
                                <h4 alt="role dans l'association" class="text-sm text-center">Secrétaire</h4>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/emilie.webp" alt="Emilie Omiel" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Emilie Omiel</span>
                                <h4 alt="role dans l'association" class="text-sm text-center">Secrétaire adjointe</h4>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/valerie.webp" alt="Valérie Derenes" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Valérie Derenes</span>
                                <h4 alt="role dans l'association" class="text-sm text-center">Trésorière <br>&<br>Responsable couture</h4>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/sophie.webp" alt="Sophie Devincenzi" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Sophie Devincenzi</span>
                                <h4 alt="role dans l'association" class="text-sm text-center">Trésorière adjointe</h4>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/marylou.webp" alt="Marylou Charles" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Marylou Charles</span>
                                <h4 alt="role dans l'association" class="text-sm text-center">Responsable communication</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <section class="pt-8 pb-8">
        <div class="container mx-auto px-6 max-w-4xl">
            <h1 class="text-3xl font-bold text-center mb-8 funnel-display">À propos de l'association</h1>
            <div class="prose prose-lg mx-auto text-black-700 leading-relaxed">
                <p class="mb-6">
                    Yakadanse est une association regroupant professeurs et bénévoles, qui partagent une passion pour la danse ! Plusieurs styles se mélangent selon les cours, du modern-jazz, du contemporain, du classique et même du hip-hop !
                </p>
                
                <p class="mb-6">
                    Depuis plusieurs années, nos membres et nos bénévoles mettent le cœur à l'ouvrage pour entretenir l'énergie de cette association et la tenir debout.
                </p>
                
                <p class="mb-8">
                    Vous aussi, participez à l'aventure exceptionnelle et vous verrez... y a qu'à danser !
                </p>
                
                <div class="text-center">
                    <a href="php/formulairecontact.php" class="inline-block bg-pink-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-pink-700 transition-colors duration-300">
                        Nous contacter
                    </a>
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