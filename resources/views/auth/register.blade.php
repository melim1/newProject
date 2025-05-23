<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>Inscription</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            overflow: hidden;
            -webkit-text-size-adjust: 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container-login {
            display: flex;
            max-width: 900px;
            width: 90%;
            min-height: 650px;
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .image-section {
            width: 50%;
            background-image: url('/images/img1.jpg');
            background-position: center;
            background-size: cover;
            border-top-right-radius: 300px;
            border-bottom-right-radius: 300px;
            box-shadow: inset 0 0 40px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: zoomInImage 2s ease forwards;
        }

        .image-section::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.25);
            border-top-right-radius: 300px;
            border-bottom-right-radius: 300px;
        }

        .login-section {
            width: 50%;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
            opacity: 0;
            animation: fadeInRight 1s ease forwards;
            animation-delay: 0.3s;
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
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
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
            box-shadow: 0 5px 15px rgba(0, 102, 255, 0.3);
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

        /* Styles pour les erreurs */
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .is-invalid:focus {
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container-login {
                flex-direction: column;
                width: 100%;
                min-height: auto;
                border-radius: 15px;
            }

            .image-section {
                width: 100%;
                height: 250px;
                border-radius: 0;
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
                box-shadow: none;
            }

            .image-section::after {
                border-radius: 0;
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
            }

            .login-section {
                width: 100%;
                padding: 30px 20px;
                max-height: none;
            }
        }

        /* Animations */
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes zoomInImage {
            from {
                transform: scale(1.1);
            }

            to {
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <div class="container-login">
        <div class="image-section"></div>
        <div class="login-section">
            <div class="login-header">
                <h3><i class="bi bi-person-plus me-2"></i>Inscription</h3>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="name">Nom complet</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name') }}" required autofocus placeholder="Votre nom complet" />
                    </div>
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email">Adresse e-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required placeholder="Votre adresse e-mail" />
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="phone">Téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                        <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               name="phone" value="{{ old('phone') }}" placeholder="Votre téléphone" />
                    </div>
                    @error('phone')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" required placeholder="Votre mot de passe" />
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation">Confirmer mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input id="password_confirmation" type="password" class="form-control" 
                               name="password_confirmation" required placeholder="Confirmez votre mot de passe" />
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-person-plus me-2"></i> S'inscrire
                </button>

                <div class="links mt-3">
                    <span>Vous avez déjà un compte ?</span>
                    <a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Se connecter</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>