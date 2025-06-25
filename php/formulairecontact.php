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

    <title>Yakadanse - Contact</title>
</head>
<body>
<?php require '../include/navbar.html'; ?>

    <main class="flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 text-center mb-2">Contactez-nous</h1>
                <p class="text-gray-600 text-center mb-6">Une question ? Remplissez le formulaire ci-dessous et nous vous répondrons rapidement.</p>
            </div>
            <form class="mt-8 space-y-6" action="#" method="POST">
                <div class="rounded-md -space-y-px">
                    <div class="mb-4">
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input id="nom" name="nom" type="text" autocomplete="name" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-pink-400 focus:border-pink-400 focus:z-10 sm:text-sm" placeholder="Nom">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                        <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-pink-400 focus:border-pink-400 focus:z-10 sm:text-sm" placeholder="E-mail">
                    </div>
                    <div class="mb-4">
                        <label for="sujet" class="block text-sm font-medium text-gray-700">Sujet</label>
                        <input id="sujet" name="sujet" type="text" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-pink-400 focus:border-pink-400 focus:z-10 sm:text-sm" placeholder="Sujet de votre message">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea id="message" name="message" rows="4" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-pink-400 focus:border-pink-400 focus:z-10 sm:text-sm" placeholder="Votre message"></textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-400 transition">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </main>

<?php require '../include/footer.html'; ?>

<script src="../js/contact.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</body>
</html>
