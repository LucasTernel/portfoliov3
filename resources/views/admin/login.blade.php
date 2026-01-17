<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Lucas Ternel</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css']) 
    
    <style>
        /* RESET & BASE */
        * { box-sizing: border-box; }
        
        body {
            background-color: #050505; /* Noir Profond */
            color: white;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* EFFET DE FOND (GLOW) */
        .background-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(214, 243, 47, 0.08) 0%, rgba(5, 5, 5, 0) 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
            pointer-events: none;
        }

        /* CARTE DE LOGIN */
        .login-card {
            background: #0f0f0f;
            padding: 50px 40px;
            border-radius: 16px;
            border: 1px solid #222;
            width: 100%;
            max-width: 420px;
            text-align: center;
            position: relative;
            z-index: 10;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        /* LOGO */
        .brand-logo {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 40px;
            display: inline-block;
            letter-spacing: -1px;
            color: white;
            text-decoration: none;
        }
        .dot { color: #D6F32F; }

        /* FORMULAIRE */
        .form-group {
            margin-top: 20px;
            margin-bottom: 25px;
            text-align: left;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 0.8rem;
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input {
            width: 100%;
            padding: 15px;
            background: #151515;
            border: 1px solid #333;
            color: white;
            border-radius: 8px;
            outline: none;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #D6F32F;
            background: #1a1a1a;
            box-shadow: 0 0 15px rgba(214, 243, 47, 0.1);
        }

        input::placeholder { color: #444; }

        /* BOUTON */
        .btn-login {
            width: 100%;
            padding: 15px;
            background: #D6F32F;
            color: black;
            font-size: 0.95rem;
            font-weight: 800;
            border: none;
            border-radius: 50px; /* Pill shape */
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background: white;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* ERREURS */
        .error-message {
            background: rgba(255, 77, 77, 0.1);
            color: #ff4d4d;
            font-size: 0.85rem;
            padding: 10px;
            border-radius: 6px;
            margin-top: 5px;
            border: 1px solid rgba(255, 77, 77, 0.2);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ANIMATION */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Lien retour (optionnel) */
        .back-link {
            margin-top: 30px;
            display: inline-block;
            color: #444;
            font-size: 0.8rem;
            text-decoration: none;
            transition: 0.3s;
        }
        .back-link:hover { color: #888; }
    </style>
</head>
<body>

    <div class="background-glow"></div>

        <header class="site-header">
            <div class="logo">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo Lucas Ternel">
            </div>
        </header>

    <div class="login-card">
        
        <h1> Espace Admin </h1>

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="admin@lucasternel.com" required autofocus autocomplete="email">
                @error('email')
                    <div class="error-message">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn-login">Connexion</button>

            <a href="{{ url('/') }}" class="back-link">← Retour au site</a>
        </form>
    </div>

</body>
</html>