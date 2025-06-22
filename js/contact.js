document.addEventListener('DOMContentLoaded', function() {
    // Vérifie si nous sommes sur la page de connexion
    if (window.location.pathname.includes('formulairecontact')) {
        // Tableau des images de fond possibles
        const backgrounds = [
            '../images/gradiant.png',
            '../images/gradiant2.png',
            '../images/gradiant3.png',
            '../images/gradiant4.png',
            '../images/gradiant5.png'
        ];
        
        // Fonction pour précharger les images
        function preloadImages() {
            backgrounds.forEach(src => {
                const img = new Image();
                img.src = src;
            });
        }

        // Nouvelle fonction de changement de fond avec transition noire
        function changeBackgroundWithFade() {
            const randomBackground = backgrounds[Math.floor(Math.random() * backgrounds.length)];

            // Met le fond du body en noir dès le départ
            document.body.style.background = 'black';
            document.body.style.backgroundImage = '';

            // Crée un div pour la transition de fond
            const bgTransitionDiv = document.createElement('div');
            bgTransitionDiv.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: url(${randomBackground}) center center / cover no-repeat fixed;
                opacity: 0;
                transition: opacity 400ms linear;
                z-index: -1;
                pointer-events: none;
            `;
            document.body.appendChild(bgTransitionDiv);

            // Lance le fondu de l'image (du noir vers l'image)
            setTimeout(() => {
                bgTransitionDiv.style.opacity = '1';
            }, 10);

            // Après la transition, applique l'image sur le body et supprime le div
            setTimeout(() => {
                document.body.style.backgroundImage = `url(${randomBackground})`;
                document.body.style.backgroundSize = 'cover';
                document.body.style.backgroundPosition = 'center';
                document.body.style.backgroundRepeat = 'no-repeat';
                document.body.style.backgroundAttachment = 'fixed';
                bgTransitionDiv.remove();
            }, 410);
        }

        // Précharge les images
        preloadImages();
        // Change le fond initial avec la nouvelle animation
        changeBackgroundWithFade();
    }

});