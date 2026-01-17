<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance | Lucas Ternel</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* RESET & BASE */
        body {
            background-color: #050505; /* Ton Noir Profond */
            color: white;
            font-family: 'Inter', sans-serif; /* Ta police (ou celle par défaut) */
            height: 100vh;
            margin: 0;
            overflow: hidden; /* Pas de scroll */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* 1. LOGO EN HAUT À GAUCHE */
        .maintenance-logo {
            position: absolute;
            top: 30px;
            left: 40px;
            z-index: 10;
        }
        .maintenance-logo img {
            height: 50px; /* Ajuste la taille selon ton logo */
            width: auto;
        }
        /* Si tu n'as pas d'image et veux du texte stylisé pour le logo : */
        .logo-text {
            font-weight: 800;
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
            letter-spacing: -1px;
        }
        .logo-dot { color: #D6F32F; }

        /* 2. CONTENU CENTRÉ */
        .maintenance-content {
            text-align: center;
            padding: 20px;
            max-width: 600px;
            animation: fadeIn 1s ease-out;
        }

        /* 3. LE LOADER NÉON */
        .loader-wrapper {
            margin-bottom: 40px;
            display: flex;
            justify-content: center;
        }
        .loader {
            width: 60px;
            height: 60px;
            border: 4px solid #222;
            border-top: 4px solid #D6F32F; /* Ton Vert */
            border-radius: 50%;
            animation: spin 1s linear infinite;
            box-shadow: 0 0 15px rgba(214, 243, 47, 0.1);
        }

        h1 {
            font-size: 3rem;
            font-weight: 900;
            margin: 0 0 15px 0;
            line-height: 1.1;
        }
        
        .highlight { color: #D6F32F; }

        p.desc {
            color: #888;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        /* 4. MAIL DE CONTACT */
        .contact-box {
            border-top: 1px solid #ffffff;
            padding-top: 30px;
            margin-top: 20px;
        }
        .contact-label {
            display: block;
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .contact-link {
            color: white;
            font-size: 1.2rem;
            text-decoration: none;
            border-bottom: 1px solid #D6F32F;
            padding-bottom: 5px;
            transition: 0.3s;
        }
        .contact-link:hover {
            color: #D6F32F;
            border-color: transparent;
        }

        /* Animations */
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* Lien Admin discret (Optionnel, caché en bas à droite) */
        .admin-shortcut {
            position: absolute;
            bottom: 20px;
            right: 20px;
            color: #222;
            text-decoration: none;
            font-size: 0.8rem;
        }
        .admin-shortcut:hover { color: #444; }

        /* Responsive Mobile */
        @media (max-width: 600px) {
            .maintenance-logo { top: 20px; left: 20px; }
            h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>

   <header class="site-header">
        <div class="logo">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo Lucas Ternel">
        </div>
    </header>

    <div class="maintenance-content">
        
        <div class="loader-wrapper">
            <div class="loader"></div>
        </div>

        <h1>Site en <span class="highlight">Maintenance</span></h1>
        
        <p class="desc">
            Je suis actuellement en train d'effectuer des mises à jour importantes pour améliorer l'expérience. 
            Le site sera de retour très rapidement.
        </p>

        <div class="contact-box">
            <span class="contact-label">Besoin de me joindre ?</span>
            <a href="mailto:lucas.ternel62@gmail.com" class="contact-link">lucas.ternel62@gmail.com</a>
        </div>

    </div>

</body>
</html>