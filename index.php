<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                        Découvrez notre spectacle annuel et nos événements
                    </p>
                </div>

                <div class="flex justify-center">
                    <div class="event-card animate-fade-in-up max-w-2xl">
                        <h3 class="text-2xl font-bold mb-4">Gala de Juin</h3>
                        <p class="mb-4">Le spectacle incontournable de l'année où tous nos élèves montrent leur talent sur scène.</p>
                        <ul class="space-y-2 mb-6">
                            <li>• Chorégraphies originales</li>
                            <li>• Costumes magnifiques</li>
                            <li>• Ambiance festive</li>
                            <li>• Équipe technique professionnelle</li>
                        </ul>
                        <a href="php/gala.php" class="cta-button shine-effect focus-ring">
                            En savoir plus
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <!--
       Section Témoignages
        <section class="py-16 bg-gradient-to-br from-pink-50 to-purple-50">
            <div class="container mx-auto px-6 max-w-6xl">
                <div class="text-center mb-12 animate-fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 funnel-display">Ils nous font confiance</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Découvrez ce que nos élèves et leurs parents pensent de Yakadanse
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="testimonial-card animate-fade-in-left">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-pink-200 rounded-full flex items-center justify-center mr-4">
                                <span class="text-pink-600 font-bold">L</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Lucie, 12 ans</h4>
                                <p class="text-gray-600 text-sm">Élève depuis 5 ans</p>
                            </div>
                        </div>
                        <p class="text-gray-700 italic">"J'adore venir à Yakadanse ! Les professeurs sont super gentils et j'ai appris tellement de choses. Le gala de fin d'année est toujours magique !"</p>
                    </div>

                    <div class="testimonial-card animate-fade-in-up">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center mr-4">
                                <span class="text-purple-600 font-bold">M</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Marie, maman de Emma</h4>
                                <p class="text-gray-600 text-sm">Parent d'élève</p>
                            </div>
                        </div>
                        <p class="text-gray-700 italic">"Ma fille est épanouie depuis qu'elle fait de la danse ici. L'équipe est professionnelle et bienveillante. Je recommande vivement !"</p>
                    </div>

                    <div class="testimonial-card animate-fade-in-right">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mr-4">
                                <span class="text-blue-600 font-bold">T</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Thomas, 25 ans</h4>
                                <p class="text-gray-600 text-sm">Cours adultes</p>
                            </div>
                        </div>
                        <p class="text-gray-700 italic">"En tant qu'adulte débutant, j'ai trouvé ici un accueil parfait. Les cours sont adaptés et l'ambiance est très conviviale."</p>
                    </div>
                </div>
            </div>
        </section>
    </main>-->
<script src="js/main.js"></script>
<script src="js/accueil.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<?php require 'includeindex/footer.html'; ?>

</body>
</html>
