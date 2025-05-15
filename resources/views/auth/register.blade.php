<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
            background-image: url('/images/pic.jpg');
            background-size: cover;
            background-position: center;
        }

        .register-section {
            width: 550px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .register-form {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .register-header h3 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
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

    <!-- Section du formulaire d'inscription à droite -->
    <div class="register-section">
        <div class="register-form">
            <div class="register-header">
                <h3><i class="bi bi-person-plus me-2"></i>Inscription</h3>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input id="name" type="text" class="form-control" name="name" required autocomplete="name"
                            autofocus placeholder="Entrez votre nom">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email_or_phone" class="form-label">Adresse e-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                        <input id="email_or_phone" type="text" class="form-control" name="email_or_phone" required
                            autocomplete="email_or_phone" placeholder="Entrez votre e-mail">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" required
                            autocomplete="new-password" placeholder="Entrez votre mot de passe">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirmez le mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Confirmez votre mot de passe">
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>S'inscrire
                    </button>
                </div>
                <div class="text-center mt-3">
                    <p>
                        Vous avez déjà un compte ?
                        <a href="{{ route('login') }}" class="btn-link">
                            <i class="bi bi-box-arrow-in-right"></i> Se connecter
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
