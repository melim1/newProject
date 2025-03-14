<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
    <style>
        /* Styles pour le contenu */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 2rem;
        }

        .card-header {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .card-body {
            font-size: 1rem;
            color: #555;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 0.75rem 1.25rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .btn-link {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .btn-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Verify Your Email Address</div>

                    <div class="card-body">
                        <!-- Affichage du message de succès si un lien de vérification a été renvoyé -->
                        <div id="alert-success" class="alert-success" role="alert" style="display: none;">
                            A fresh verification link has been sent to your email address.
                        </div>

                        <p>Before proceeding, please check your email for a verification link.</p>
                        <p>If you did not receive the email,</p>
                        <form id="resend-form" class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn-link">click here to request another</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script pour afficher le message de succès si un lien de vérification a été renvoyé
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('resent')) {
            document.getElementById('alert-success').style.display = 'block';
        }

        // Gestion de la soumission du formulaire
        document.getElementById('resend-form').addEventListener('submit', function (e) {
            e.preventDefault();
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({})
            }).then(response => {
                if (response.ok) {
                    document.getElementById('alert-success').style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>