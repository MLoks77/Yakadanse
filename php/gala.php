<?php

session_start()

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
    <link rel="stylesheet" href="../css/accueil.css">

    <meta name="description" content="Yakadanse - Club de danse à Saint-Pathus. Découvrez nos cours de danse, nos spectacles et rejoignez notre communauté passionnée.">
    <meta name="keywords" content="danse, club, Saint-Pathus, cours, gala, association, Yakadanse">

    <title>Yakadanse - Gala</title>
</head>
<body>
<?php require '../include/navbar.php'; ?>
<?php require '../hero/galahero.html'; ?>

    <main>
        <h1>Bienvenue</h1>
        <section>
            <h2>Notre contenu</h2>
            <p>Contenu principal</p>
        </section>
    </main>

<?php require '../include/footer.html'; ?>
<button id="backToTop" title="Retour en haut" class="fixed bottom-8 right-8 z-50 bg-pink-600 text-white rounded-full p-3 shadow-lg hover:bg-pink-700 transition-all duration-300 hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
        </svg>
</button>
</body>
</html>

<script src="../js/main.js"></script>
    <script src="../js/accueil.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

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