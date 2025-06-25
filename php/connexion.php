<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yakadanse - Connexion </title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="../js/main.js"></script>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline:opsz,wght@10..72,100..900&family=Didact+Gothic&family=Funnel+Display:wght@300..800&family=Kurale&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <meta name="description" content="Yakadanse - Club de danse à Saint-Pathus. Découvrez nos cours de danse, nos spectacles et rejoignez notre communauté passionnée.">
    <meta name="keywords" content="danse, club, Saint-Pathus, cours, gala, association, Yakadanse">

</head>
<body>
    
    <?php require '../include/navbar.html'; ?>
    <section class="extra-space"></section>
    <main class="container mx-auto px-4 py-8 mt-10">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
            <h1 class="text-black text-2xl font-bold text-center mb-6">Connexion</h1>
            <h4 class="text-gray-500 font-bold text-center mb-2">Ce formulaire est réservé au personnel de Yakadanse</h4><br>

            <?php 
            if (isset($_GET['erreur']) && $_GET['erreur'] == 1) {
                echo '<script>alert("Identifiant ou mot de passe incorrect.");</script>';
            }
            ?>

            
            <form action="traitement_connexion.php" method="POST" class="space-y-4">
                <div>
                    <label for="identifiant" class="block text-sm  font-medium text-gray-700">identifiant</label>
                    <input type="identifiant" id="identifiant" name="identifiant" required 
                           class="text-black mt-5 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-400 focus:ring-pink-400 pr-10 py-3 px-4 text-lg">
                </div>

                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required 
                               class="text-black mt-5 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-400 focus:ring-pink-400 pr-10 py-3 px-4 text-lg">
                        <button type="button" id="togglePassword" 
                                class="text-black absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                    Se connecter
                </button>
            </form>
        </div>
    </main>
    <section class="extra-space"></section>
    <section class="extra-space"></section>
    <?php require '../include/footer.html'; ?>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    
    // Change l'icône
    this.querySelector('svg').innerHTML = type === 'password' 
        ? '<path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>'
        : '<path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/><path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/>';
    });

    </script>


</body>
</html>
