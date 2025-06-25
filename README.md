# Yakadanse

Bienvenue sur le dépôt du site **Yakadanse**, association de danse à Saint-Pathus (77).

---

## Sommaire
- [Présentation](#présentation)
- [Aperçu du site](#aperçu-du-site)
- [Fonctionnalités](#fonctionnalités)
- [Structure du projet](#structure-du-projet)
- [Installation & utilisation](#installation--utilisation)
- [Technologies utilisées](#technologies-utilisées)
- [Contribuer](#contribuer)
- [Contact](#contact)

---

## Présentation
Yakadanse est une association qui propose des cours de danse pour tous les âges et tous les niveaux, ainsi qu'un gala annuel et de nombreux événements. Ce site web moderne et responsive permet de présenter l'association, les professeurs, les horaires, les tarifs, et de faciliter la prise de contact.

## Aperçu du site
- **Page d'accueil** : Présentation, disciplines, événements, témoignages, accès rapide aux autres pages.
- **Cours** : Horaires détaillés, tarifs, procédure d'inscription, équipe pédagogique.
- **Association** : Présentation de l'équipe du bureau, valeurs, histoire.
- **Gala** : Informations sur le spectacle annuel.
- **Contact** : Formulaire de contact simple et efficace.
- **Connexion** : Accès réservé au personnel.
- **Mentions légales** et **Plan du site** : Informations réglementaires et navigation.

## Fonctionnalités
- Design moderne, animations CSS/JS, responsive (mobile/tablette/desktop)
- Navigation claire (navbar, footer, fil d'Ariane)
- Sections dynamiques : horaires, tarifs, équipe, événements
- Formulaire de contact
- Gestion de la connexion (PHP)
- Utilisation d'images optimisées (WebP, AVIF, JPG)
- Intégration réseaux sociaux (footer)

## Structure du projet
```
Yakadanse/
│
├── index.php                # Page d'accueil
├── php/                     # Pages principales (cours, association, gala, contact, etc.)
│   ├── cours.php
│   ├── association.php
│   ├── gala.php
│   ├── formulairecontact.php
│   ├── connexion.php
│   ├── mentionlegales.php
│   ├── plan.php
│   └── ...
├── css/                     # Feuilles de style (accueil, main, footer)
│   ├── accueil.css
│   ├── main.css
│   └── footer.css
├── js/                      # Scripts JS (animations, effets, background)
│   ├── accueil.js
│   ├── main.js
│   └── contact.js
├── images/                  # Images du site (logo, équipe, galas, etc.)
│   └── equipe/              # Portraits des professeurs et membres du bureau
├── hero/                    # Bannières hero pour chaque page
├── includeindex/            # Inclusions HTML pour l'accueil (navbar, footer, hero)
├── include/                 # Inclusions HTML globales (navbar, footer)
├── configdb/                # Connexion et gestion de session PHP
└── ...
```

## Installation & utilisation
1. **Prérequis** :
   - Serveur web local (ex : XAMPP, WAMP, MAMP) ou hébergement PHP
   - PHP 7.4 ou supérieur
2. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/votre-utilisateur/Yakadanse.git
   ```
3. **Placer le dossier dans le répertoire web** (ex : `htdocs` pour XAMPP)
4. **Accéder au site** :
   - Ouvrir `http://localhost/Yakadanse/index.php` dans votre navigateur

## Technologies utilisées
- **HTML5 / CSS3** (avec Tailwind CSS via CDN)
- **JavaScript** (animations, effets visuels, accessibilité)
- **PHP** (pages dynamiques, gestion de session, formulaires)
- **Google Fonts** (Funnel Display, Didact Gothic, etc.)
- **Images optimisées** (WebP, AVIF, JPG)

## Contribuer
Les contributions sont les bienvenues !
- Forkez le projet
- Créez une branche (`git checkout -b feature/ma-feature`)
- Commitez vos modifications (`git commit -am 'Ajout d'une fonctionnalité'`)
- Poussez la branche (`git push origin feature/ma-feature`)
- Ouvrez une Pull Request

## Contact
- **Mail** : associationyakadanse@gmail.com
- **Facebook** : [Yakadanse Saint-Pathus](https://www.facebook.com/yakadanse.stpathus/)
- **Instagram** : [@ykads](https://www.instagram.com/ykads/)

---

© 2025 Yakadanse. Tous droits réservés. 
