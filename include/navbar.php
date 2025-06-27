
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<!-- Police -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline:opsz,wght@10..72,100..900&family=Didact+Gothic&family=Funnel+Display:wght@300..800&family=Kurale&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../css/main.css">

<header class="bg-[#181F20]">
    <nav class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="../index.php">
                <img src="../images/logoYKADSnoir.jpg" alt="Logo" class="w-16 h-16">
                </a>
            </div>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="../index.php" class="text-white hover:text-pink-200 hover:padding-2 transition-colors duration-200">Accueil</a>
                <a href="cours.php" class="text-white hover:text-pink-200 transition-colors duration-200">Cours de danse</a>
                <a href="gala.php" class="text-white hover:text-pink-200 transition-colors duration-200">Gala</a>
                <a href="association.php" class="text-white hover:text-pink-200 transition-colors duration-200">L'association</a>
                <a href="formulairecontact.php" class="text-white hover:text-pink-200 transition-colors duration-200">Nous contacter</a>
                <p class="border-1 border-r-1 border-white h-10"></p>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="controlpanel.php" class="text-white hover:text-pink-200 font-semibold py-2 px-4 rounded-lg transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Admin
                    </a>
                <?php else: ?>
                    <a href="connexion.php" class="text-white hover:text-pink-200 font-semibold py-2 px-4 rounded-lg transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        Se connecter
                    </a>
                <?php endif; ?>
            </div>

            <!-- Menu mobile -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menu mobile déroulant -->
        <div id="mobile-menu" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="../index.php" class="block px-3 py-2 text-white hover:text-pink-200 transition-colors duration-200">Accueil</a>
                <a href="cours.php" class="block px-3 py-2 text-white hover:text-pink-200 transition-colors duration-200">Cours de danse</a>
                <a href="gala.php" class="block px-3 py-2 text-white hover:text-pink-200 transition-colors duration-200">Gala</a>
                <a href="association.php" class="block px-3 py-2 text-white hover:text-pink-200 transition-colors duration-200">L'association</a>
                <a href="formulairecontact.php" class="block px-3 py-2 text-white hover:text-pink-200 transition-colors duration-200">Nous Contacter</a>
                <div class="border-t border-gray-700 my-2"></div>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="controlpanel.php" class="block px-3 py-2 text-white hover:text-pink-200 transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Admin
                    </a>
                <?php else: ?>
                    <a href="connexion.php" class="block px-3 py-2 text-white hover:text-pink-200 transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        Se connecter
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Fermer le menu si on clique en dehors
        document.addEventListener('click', function(event) {
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    });
</script>