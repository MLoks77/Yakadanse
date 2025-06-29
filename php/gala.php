<?php

session_start();

require "../configdb/setup.php";

// Récupérer l'état du gala
$stmt = $pdo->query('SELECT gala FROM gala WHERE id_gala = 1 LIMIT 1');
$galaOuvert = $stmt->fetchColumn() == 1;

// Récupérer les prix
$stmt = $pdo->query("SELECT type_prix, montant FROM prix WHERE type_prix IN ('Adulte', 'Enfant')");
$prix = [];
while ($row = $stmt->fetch()) {
    $prix[$row['type_prix']] = $row['montant'];
}

// Récupérer le texte et l'image du gala
$stmt = $pdo->prepare("SELECT texte FROM texte WHERE type_texte = 'gala_texte' LIMIT 1");
$stmt->execute();
$galaTexte = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT chemin_image FROM image WHERE type = 'gala_img' LIMIT 1");
$stmt->execute();
$galaImage = $stmt->fetch(PDO::FETCH_ASSOC);

// Gestion de la notification
$notification = null;
$notificationType = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $galaOuvert) {
    // Sécurisation des entrées
    $nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $prenom = htmlspecialchars(trim($_POST['prenom'] ?? ''));
    $mail = filter_var(trim($_POST['mail'] ?? ''), FILTER_VALIDATE_EMAIL);
    $n_adulte = max(0, intval($_POST['n_adulte'] ?? 0));
    $n_enfant = max(0, intval($_POST['n_enfant'] ?? 0));
    $horaire = in_array($_POST['horaire'] ?? '', ['après-midi', 'soir']) ? $_POST['horaire'] : '';
    $collectedonnee = (isset($_POST['collectedonnee']) && $_POST['collectedonnee'] === 'on') ? 'accepte' : null;

    // Calcul du prix total (sécurité)
    $prix_total = ($n_adulte * ($prix['Adulte'] ?? 0)) + ($n_enfant * ($prix['Enfant'] ?? 0));
    $prix_str = number_format($prix_total, 2, ',', ' ') . ' €';

    // Validation
    if ($nom && $prenom && $mail && ($n_adulte > 0 || $n_enfant > 0) && $horaire && $collectedonnee) {
        try {
            $stmt = $pdo->prepare('INSERT INTO reservation (prenom, nom, mail, n_adulte, n_enfant, prix, horaire, id_status, collectedonnee) VALUES (?, ?, ?, ?, ?, ?, ?, 1, ?)');
            $stmt->execute([$prenom, $nom, $mail, $n_adulte, $n_enfant, $prix_str, $horaire, $collectedonnee]);
            $notification = 'Votre réservation a bien été prise en compte !';
            $notificationType = 'success';
        } catch (Exception $e) {
            $notification = "Erreur lors de l'enregistrement. Veuillez réessayer.";
            $notificationType = 'error';
        }
    } else {
        if ($n_adulte == 0 && $n_enfant == 0) {
            $notification = 'Veuillez sélectionner au moins un adulte ou un enfant pour réserver.';
        } else if (!$mail) {
            $notification = 'Merci de saisir une adresse e-mail valide.';
        } else if (!$collectedonnee) {
            $notification = 'Vous devez accepter la collecte de données pour réserver.';
        } else {
            $notification = 'Merci de remplir tous les champs correctement.';
        }
        $notificationType = 'error';
    }
}
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

    <meta name="description" content="Yakadanse - Club de danse à Saint-Pathus. Découvrez nos cours de danse, nos spectacles et rejoignez notre communauté passionnée.">
    <meta name="keywords" content="danse, club, Saint-Pathus, cours, gala, association, Yakadanse">

    <title>Yakadanse - Gala</title>


</head>
<body class="bg-gray-50">
<?php require '../include/navbar.php'; ?>
<?php require '../hero/galahero.html'; ?>

<!-- Notification -->
<?php if ($notification): ?>
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50">
        <div class="px-6 py-3 rounded-lg shadow-lg text-white <?php echo $notificationType === 'success' ? 'bg-green-600' : 'bg-red-600'; ?> animate-fade-in-up">
            <?php echo $notification; ?>
        </div>
    </div>
<?php endif; ?>


    <!-- Section d'introduction indépendante et centrée -->
    <section class="mb-12 px-0 py-0 flex flex-col items-center">
    <br><br>
        <h1 class="text-3xl md:text-4xl font-extrabold text-pink-600 mb-6 text-center">Gala Yakadanse</h1>
        <div class="flex flex-col md:flex-row items-center md:items-start justify-center gap-8 max-w-4xl mx-auto">
            <div class="flex-1 text-left">
                <p class="text-base md:text-lg text-gray-700 mb-6 mx-3">
                    Chaque année, notre Gala s'articule autour d'un thème original et festif, soigneusement choisi pour offrir une expérience unique à tous les participants. Ce thème guide la décoration, les costumes, les chorégraphies et l'ambiance générale de la soirée, permettant à chacun de s'immerger pleinement dans l'univers proposé.
                    Réservez vos places dès maintenant !
                </p>
                <ul class="space-y-2 text-gray-600 text-sm md:text-base">
                    <li class="flex items-center gap-2 mx-3">
                        <span class="inline-block w-2 h-2 bg-pink-400 rounded-full"></span>
                        Ouvert à tous
                    </li>
                    <li class="flex items-center gap-2 mx-3">
                        <span class="inline-block w-2 h-2 bg-pink-400 rounded-full"></span>
                        Deux horaires : après-midi ou soir
                    </li>
                    <li class="flex items-center gap-2 mx-3">
                        <span class="inline-block w-2 h-2 bg-pink-400 rounded-full"></span>
                        Encadré·e par une équipe technique de professionnel·le·s
                    </li>
                </ul>
            </div>
            <div class="flex-1 flex justify-center">
                <img src="../images/final.jpg" alt="Gala Yakadanse" class="w-full max-w-md object-cover rounded-lg">
            </div>
        </div>
        <section class="extra-space"></section>
    </section>


    <!-- Section double : Prix & Formulaire (toujours côte à côte sur desktop, centrée sur mobile) -->
    <h1 class="bg-[#FFFAFA] text-3xl md:text-4xl font-extrabold text-pink-600 text-center">Réserver vos place<br><br></h1>
    
    <!-- Section Nouvelles du Gala -->
    <section class="bg-[#FFFAFA] py-8">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-pink-600 mb-6 text-center">Les dernières nouvelles du gala</h2>
                
                <?php if ($galaTexte && $galaTexte['texte']): ?>
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <?php if ($galaImage && $galaImage['chemin_image']): ?>
                            <div class="md:w-1/3 flex-shrink-0">
                                <img src="../images/img/<?php echo htmlspecialchars($galaImage['chemin_image']); ?>" 
                                     alt="Image du gala" 
                                     class="w-full h-48 object-cover rounded-lg shadow-md">
                            </div>
                        <?php endif; ?>
                        
                        <div class="<?php echo ($galaImage && $galaImage['chemin_image']) ? 'md:w-2/3' : 'w-full'; ?>">
                            <div class="prose prose-lg max-w-none">
                                <p class="text-gray-700 leading-relaxed">
                                    <?php echo nl2br(htmlspecialchars($galaTexte['texte'])); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="text-gray-500 text-lg">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p>Aucune nouvelle information</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <section class="w-full flex justify-center bg-[#FFFAFA] pb-2">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 w-full max-w-5xl">
            <!-- Colonne Prix -->
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-pink-600 mb-6 text-center md:text-left">Tarifs du Gala</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between bg-pink-50 rounded-lg px-5 py-4">
                        <span class="font-semibold text-lg text-gray-800">Adulte</span>
                        <span class="text-xl font-bold text-pink-600"><?php echo isset($prix['Adulte']) ? number_format($prix['Adulte'], 2, ',', ' ') . ' €' : '—'; ?></span>
                    </div>
                    <div class="flex items-center justify-between bg-purple-50 rounded-lg px-5 py-4">
                        <span class="font-semibold text-lg text-gray-800">Enfant</span>
                        <span class="text-xl font-bold text-purple-600"><?php echo isset($prix['Enfant']) ? number_format($prix['Enfant'], 2, ',', ' ') . ' €' : '—'; ?></span>
                    </div>
                </div>
                <!-- Section : Comment se déroule le paiement ? -->
                <div class="mt-8 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-pink-600 mb-3">Comment se déroule le paiement&nbsp;?</h3>
                    <p class="text-gray-700 text-base">
                        Après avoir réservé vos places via le formulaire ou en présentiel, le paiement pourra s'effectuer sur place, le jour du gala, à l'accueil de l'événement. Merci de prévoir l'appoint.<br>
                        Une fois le paiement effectué, vos billets vous seront remis directement.
                    </p>
                </div>
                <!-- Section : Comment se déroule la collecte -->
                <div class="mt-8 rounded-lg p-6 ">
                    <h3 class="text-xl font-semibold text-pink-600 mb-3">Collecte des données</h3>
                    <p class="text-gray-700 text-base">
                    Après chaque Gala, vos données personnelles enregistrées sur notre site seront supprimées afin de garantir la confidentialité et d'éviter toute fuite d'informations.
                </p>
                </div>
            </div>
            <!-- Colonne Formulaire -->
            <div class="relative">
                <?php if ($galaOuvert): ?>
                <form method="post" class="bg-white rounded-xl shadow-lg p-8 space-y-6" id="formReservation" autocomplete="off">
                    <h2 class="text-2xl font-bold text-pink-600 mb-4 text-center md:text-left">Réserver vos places</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="prenom" class="block text-gray-700 font-semibold mb-1">Prénom</label>
                            <input type="text" name="prenom" id="prenom" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-400" maxlength="100">
                        </div>
                        <div>
                            <label for="nom" class="block text-gray-700 font-semibold mb-1">Nom</label>
                            <input type="text" name="nom" id="nom" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-400" maxlength="100">
                        </div>
                    </div>
                    <div>
                        <label for="mail" class="block text-gray-700 font-semibold mb-1">Adresse e-mail</label>
                        <input type="email" name="mail" id="mail" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-400" maxlength="255">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="n_adulte" class="block text-gray-700 font-semibold mb-1">Nombre d'adultes</label>
                            <input type="number" name="n_adulte" id="n_adulte" min="0" value="0" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-400">
                        </div>
                        <div>
                            <label for="n_enfant" class="block text-gray-700 font-semibold mb-1">Nombre d'enfants</label>
                            <input type="number" name="n_enfant" id="n_enfant" min="0" value="0" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-400">
                        </div>
                    </div>
                    <div>
                        <span class="block text-gray-700 font-semibold mb-1">Horaire</span>
                        <div class="flex gap-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="horaire" value="après-midi" required class="form-radio text-pink-600">
                                <span class="ml-2">Après-midi</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="horaire" value="soir" required class="form-radio text-pink-600">
                                <span class="ml-2">Soir</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-lg text-gray-800">Prix total :</span>
                        <span id="prixTotal" class="text-xl font-bold text-pink-600">0,00 €</span>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="collectedonnee" id="collectedonnee" required class="form-checkbox text-pink-600">
                            <span class="ml-2 text-gray-700">En cochant cette case, j'accepte que mes <a href="../php/mentionlegales.php" target="_blank" class="text-pink-600 underline">mes données à caractère personnel</a>  soient collectées pour m'inscrire à cet évènement. Je suis informé(e)
                        que mes données seront supprimées à l'issue de cet évènement et que je peux exercer mes droits au titre du RGPB en adressant ma demande à : associationyakadanse@gmail.com</span>
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 rounded-lg transition-all duration-200 shadow-lg">Réserver</button>
                </form>
                <?php else: ?>
                <div class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-80 backdrop-blur rounded-xl z-10">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-700 mb-2">Les réservations ne sont pas encore ouvertes</div>
                        <div class="text-gray-500">Revenez bientôt pour réserver vos places au gala !</div>
                    </div>
                </div>
                <form class="bg-white rounded-xl shadow-lg p-8 space-y-6 filter blur-sm pointer-events-none select-none" aria-hidden="true">
                    <h2 class="text-2xl font-bold text-pink-600 mb-4">Réserver vos places</h2>
                    <!-- Formulaire désactivé -->
                </form>
                <?php endif; ?>
            </div>
        </div>
    </section>

<!-- FAQ --><br><br><br>
<section>
<section class="max-w-3xl mx-auto my-16">
    <h2 class="text-3xl font-bold text-center text-pink-600 mb-8">FAQ - Questions fréquentes</h2>
    <div class="space-y-4" id="faqAccordion">
        <div class="bg-white rounded-lg shadow-md">
            <button type="button" class="w-full flex justify-between items-center px-6 py-4 text-lg font-semibold text-gray-800 focus:outline-none faq-toggle">
                Comment puis-je réserver mes places pour le gala ?
                <span class="ml-2 text-pink-600">+</span>
            </button>
            <div class="faq-content px-6 pb-4 text-gray-600">
            <br>Remplissez le formulaire de réservation sur cette page, choisissez le nombre de places et l'horaire, puis validez. Ou rendez vous à l'un de nos cours afin d'en discuter avec la personne en charge.
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md">
            <button type="button" class="w-full flex justify-between items-center px-6 py-4 text-lg font-semibold text-gray-800 focus:outline-none faq-toggle">
                Puis-je réserver pour plusieurs personnes ?
                <span class="ml-2 text-pink-600">+</span>
            </button>
            <div class="faq-content px-6 pb-4 text-gray-600">
            <br>Oui, vous pouvez indiquer le nombre d'adultes et d'enfants dans le formulaire. Le prix total sera calculé automatiquement.
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md">
            <button type="button" class="w-full flex justify-between items-center px-6 py-4 text-lg font-semibold text-gray-800 focus:outline-none faq-toggle">
                Comment le prix est-il calculé ?
                <span class="ml-2 text-pink-600">+</span>
            </button>
            <div class="faq-content px-6 pb-4 text-gray-600">
            <br>Le prix dépend du nombre d'adultes et d'enfants sélectionnés, selon les tarifs affichés à gauche du formulaire.
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md">
            <button type="button" class="w-full flex justify-between items-center px-6 py-4 text-lg font-semibold text-gray-800 focus:outline-none faq-toggle">
                Comment se déroule le paiement ?
                <span class="ml-2 text-pink-600">+</span>
            </button>
            <div class="faq-content px-6 pb-4 text-gray-600">
                <br>Le paiement se déroule sur place lors du gala avant le début de du spectacle ou en présentiel à l'un de nos cours.
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md">
            <button type="button" class="w-full flex justify-between items-center px-6 py-4 text-lg font-semibold text-gray-800 focus:outline-none faq-toggle">
                Qu'advient-il de mes données ?
                <span class="ml-2 text-pink-600">+</span>
            </button>
            <div class="faq-content px-6 pb-4 text-gray-600">
                <br>Vos données sont stockées temporairement sur notre site web pendant la période de réservation afin de faciliter la gestion des places. Celles-ci seront supprimées après chaque gala.
            </div>
        </div>
    </div>
</section>
</section>
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
// Calcul dynamique du prix total et validation du bouton
const prixAdulte = <?php echo isset($prix['Adulte']) ? floatval($prix['Adulte']) : 0; ?>;
const prixEnfant = <?php echo isset($prix['Enfant']) ? floatval($prix['Enfant']) : 0; ?>;

function updatePrixTotal() {
    const nAdulte = parseInt(document.getElementById('n_adulte')?.value || 0);
    const nEnfant = parseInt(document.getElementById('n_enfant')?.value || 0);
    let total = (nAdulte * prixAdulte) + (nEnfant * prixEnfant);
    document.getElementById('prixTotal').textContent = total.toLocaleString('fr-FR', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' €';
}

function checkReservationValidity() {
    const nAdulte = parseInt(document.getElementById('n_adulte')?.value || 0);
    const nEnfant = parseInt(document.getElementById('n_enfant')?.value || 0);
    const submitBtn = document.querySelector('#formReservation button[type="submit"]');
    if (!submitBtn) return;
    submitBtn.disabled = (nAdulte === 0 && nEnfant === 0);
    if(submitBtn.disabled) {
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Prix total et validation
    if(document.getElementById('formReservation')){
        const nAdulteInput = document.getElementById('n_adulte');
        const nEnfantInput = document.getElementById('n_enfant');
        nAdulteInput.addEventListener('input', () => { updatePrixTotal(); checkReservationValidity(); });
        nEnfantInput.addEventListener('input', () => { updatePrixTotal(); checkReservationValidity(); });
        updatePrixTotal();
        checkReservationValidity();
    }

    // FAQ smooth accordéon
    document.querySelectorAll('.faq-content').forEach(content => {
        content.style.maxHeight = '0px';
        content.style.overflow = 'hidden';
        content.style.transition = 'max-height 0.4s cubic-bezier(0.4,0,0.2,1)';
    });
    document.querySelectorAll('.faq-toggle').forEach(btn => {
        btn.setAttribute('aria-expanded', 'false');
        btn.addEventListener('click', function() {
            const content = this.parentElement.querySelector('.faq-content');
            const isOpen = this.getAttribute('aria-expanded') === 'true';
            // Fermer tous les autres
            document.querySelectorAll('.faq-toggle').forEach(b => {
                b.setAttribute('aria-expanded', 'false');
                b.querySelector('span').textContent = '+';
                const c = b.parentElement.querySelector('.faq-content');
                c.style.maxHeight = '0px';
            });
            if (!isOpen) {
                this.setAttribute('aria-expanded', 'true');
                this.querySelector('span').textContent = '–';
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });
});
</script>