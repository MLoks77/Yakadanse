<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/accueil.css">

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
                        <div class="flex flex-wrap justify-center gap-8 sm:grid sm:grid-cols-3 md:grid-cols-5">
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/helena.webp" alt="Helena Omiel" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Helena Omiel</span>
                                <h5 alt="role dans l'association" class="text-sm">Secrétaire</h5>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/emilie.jpg" alt="Emilie Omiel" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Emilie Omiel</span>
                                <h5 alt="role dans l'association" class="text-sm">Secrétaire adjointe</h5>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/valerie.webp" alt="Valérie Derenes" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Valérie Derenes</span>
                                <h6 alt="role dans l'association" class="text-sm">Trésorière & Responsable couture</h6>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/charlotte-sabrina.jpg" alt="Sophie Devincenzi" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Sophie Devincenzi</span>
                                <h5 alt="role dans l'association" class="text-sm">Trésorière adjointe</h5>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="../images/equipe/marylou.webp" alt="Marylou Charles" class="professor-image-simple mb-2">
                                <span class="font-medium text-gray-800 text-center">Marylou Charles</span>
                                <h5 alt="role dans l'association" class="text-sm">Responsable communication</h5>
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
                    <a href="php/formulairecontact.php" class="inline-block bg-pink-200 text-white px-8 py-3 rounded-lg font-semibold hover:bg-pink-400 transition-colors duration-300">
                        Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </section>
    </main>
<?php require '../include/footer.html'; ?>
<script src="../js/accueil.js"></script>
<script src="../js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</body>
</html>
