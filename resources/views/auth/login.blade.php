<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            font-family: 'Arial', sans-serif;
        }

        .image-section {
            flex: 1;
            /* Prend tout l'espace disponible à gauche */
            background-image: url('/images/pic.jpg');
            /* Chemin de l'image dans public/images */
            background-size: cover;
            background-position: center;
        }

        .login-section {
            width: 550px;
            /* Largeur fixe pour le formulaire */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .login-form {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            /* Coins légèrement arrondis */
            animation: fadeIn 1s ease-in-out;
            /* Animation de fondu */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                /* Début invisible */
                transform: translateY(20px);
                /* Décalage vers le bas */
            }

            to {
                opacity: 1;
                /* Fin visible */
                transform: translateY(0);
                /* Pas de décalage */
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-header h3 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            /* Couleur de texte sombre */
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Assombrir au survol */
        }

        .btn-link {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .btn-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-check-label {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <!-- Section de l'image à gauche -->
    <div class="image-section"></div>

    <!-- Section du formulaire de connexion à droite -->
    <div class="login-section">
        <div class="login-form">
            <div class="login-header">
                <h3>Connexion</h3>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email_or_phone" class="form-label">Adresse e-mail ou Numéro de téléphone</label>
                    <input id="email_or_phone" type="text" class="form-control" name="email_or_phone" required
                        autocomplete="email_or_phone" autofocus
                        placeholder="Entrez votre e-mail ou numéro de téléphone">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input id="password" type="password" class="form-control" name="password" required
                        autocomplete="current-password" placeholder="Entrez votre mot de passe">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}" class="btn-link">Mot de passe oublié ?</a>
                    <br> <!-- Saut de ligne pour séparer les liens -->
                    <span>Vous n'avez pas de compte ?</span> <!-- Nouvelle phrase -->
                    <a href="{{ route('register') }}" class="btn-link">S'inscrire</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>