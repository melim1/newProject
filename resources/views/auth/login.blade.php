<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Connexion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            overflow: hidden;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Conteneur principal */
        .container-login {
            display: flex;
            width: 900px;
            height: 600px;
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Demi-cercle gauche avec image */
        .image-section {
            width: 50%;
            background-image: url('/images/immob.jpg');
            background-position: center;
            background-size: cover;
            border-top-right-radius: 300px;
            border-bottom-right-radius: 300px;
            box-shadow: inset 0 0 40px rgba(0,0,0,0.3);
            position: relative;

            /* Animation apparition image */
            animation: fadeIn 1.5s ease forwards;
            opacity: 0;
        }

        /* Option: overlay sombre */
        .image-section::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.25);
            border-top-right-radius: 300px;
            border-bottom-right-radius: 300px;
        }

        /* Section formulaire */
        .login-section {
            width: 50%;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;

            /* Animation apparition formulaire */
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
        }

        .login-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .login-header h3 {
            font-weight: 700;
            font-size: 2rem;
            color: #333;
        }

        form {
            width: 100%;
        }

        label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border-radius: 15px;
            border: 1px solid #ccc;
            padding: 14px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0,123,255,0.3);
            outline: none;
        }

        .input-group-text {
            background-color: #f0f2f5;
            border: none;
            border-radius: 15px 0 0 15px;
            color: #007bff;
            font-size: 1.2rem;
        }

        .input-group .form-control {
            border-radius: 0 15px 15px 0;
            border-left: none;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #666;
            user-select: none;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 0.3rem;
            cursor: pointer;
        }

        .btn-primary {
            margin-top: 25px;
            background: linear-gradient(90deg, #0066ff 0%, #0052cc 100%);
            border: none;
            border-radius: 25px;
            padding: 14px 0;
            font-weight: 700;
            font-size: 1.1rem;
            transition: background 0.3s ease;
            width: 100%;
            box-shadow: 0 5px 15px rgba(0,102,255,0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0052cc 0%, #003d99 100%);
        }

        .links {
            margin-top: 25px;
            text-align: center;
            font-size: 0.9rem;
            color: #777;
        }

        .links a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            margin-left: 8px;
        }

        .links a:hover {
            text-decoration: underline;
        }

        /* Animations keyframes */
        @keyframes fadeInUp {
          0% {
            opacity: 0;
            transform: translateY(30px);
          }
          100% {
            opacity: 1;
            transform: translateY(0);
          }
        }

        @keyframes fadeIn {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container-login {
                flex-direction: column;
                height: auto;
                width: 100%;
                border-radius: 0;
            }

            .image-section {
                width: 100%;
                height: 250px;
                border-radius: 0;
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
                box-shadow: none;
                position: relative;
            }

            .image-section::after {
                border-radius: 0;
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
            }

            .login-section {
                width: 100%;
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container-login">
        <div class="image-section"></div>
        <div class="login-section">
            <div class="login-header">
                <h3><i class="bi bi-person-circle me-2"></i>Connexion</h3>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email_or_phone">Adresse e-mail ou Numéro de téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                        <input id="email_or_phone" type="text" class="form-control" name="email_or_phone" required
                            autocomplete="email_or_phone" autofocus placeholder="Entrez votre e-mail ou numéro de téléphone" />
                    </div>
                </div>
                <div class="mb-4">
                    <label for="password">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" required
                            autocomplete="current-password" placeholder="Entrez votre mot de passe" />
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" />
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Se connecter
                </button>
                <div class="links mt-3">
                    <a href="{{ route('password.request') }}"><i class="bi bi-question-circle"></i> Mot de passe oublié ?</a>
                    <br />
                    <span>Vous n'avez pas de compte ?</span>
                    <a href="{{ route('register') }}"><i class="bi bi-person-plus"></i> S'inscrire</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>