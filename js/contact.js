document.addEventListener('DOMContentLoaded', function() {
    // Vérifie si nous sommes sur la page de connexion
    if (window.location.pathname.includes('Formulairecontact')) {
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

        // Fonction pour changer le fond avec transition
        function changeBackground() {
            const randomBackground = backgrounds[Math.floor(Math.random() * backgrounds.length)];
            
            // Crée un élément temporaire pour la transition
            const tempDiv = document.createElement('div');
            tempDiv.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url(${randomBackground});
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                opacity: 0;
                transition: opacity 1s ease-in-out;
                z-index: -1;
            `;
            
            document.body.appendChild(tempDiv);
            
            // Déclenche la transition
            requestAnimationFrame(() => {
                tempDiv.style.opacity = '1';
            });

            // Nettoie l'ancien fond après la transition
            setTimeout(() => {
                document.body.style.setProperty('background-image', `url(${randomBackground})`, 'important');
                tempDiv.remove();
            }, 800);
        }

        // Précharge les images
        preloadImages();
        
        // Change le fond initial
        changeBackground();
    }

});