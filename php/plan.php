<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/accueil.css">

    <meta name="description" content="Yakadanse - Club de danse à Saint-Pathus. Découvrez nos cours de danse, nos spectacles et rejoignez notre communauté passionnée.">
    <meta name="keywords" content="danse, club, Saint-Pathus, cours, gala, association, Yakadanse">

    <title>Yakadanse - Plan</title>
</head>
<body>
<?php require '../include/navbar.html'; ?>
<?php require '../hero/defaulthero.html'; ?>

<section class="mt-8 mb-8">
    <h1 class="text-center text-2xl font-semibold mb-6">Navigation du site</h1>
    <div class="flex justify-center">
        <ul class="list-none space-y-3">
            <li><a href="../index.php" class="hover:underline">Page d'accueil</a></li>
            <li><a href="../php/cours.php" class="hover:underline">Nos cours</a></li>
            <li><a href="../php/gala.php" class="hover:underline">Gala</a></li>
            <li><a href="../php/association.php" class="hover:underline">l'association</a></li>
            <li><a href="../php/formulairecontact.php" class="hover:underline">Formulaire de contact</a></li>
            <li><a href="../php/mentionlegales.php" class="hover:underline">Mentions légales</a></li>
            <li><a href="../php/plan.php" class="hover:underline">Plan du site</a></li>
        </ul>
    </div>
</section>
<?php require '../include/footer.html'; ?>


    <script src="../js/main.js"></script>
    <script src="../js/accueil.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>
