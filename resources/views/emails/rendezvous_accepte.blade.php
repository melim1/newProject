<!DOCTYPE html>
<html>
<head>
    <title>Rendez-vous validé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007BFF;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Bonjour {{ $rendezVous->nom_complet }},</h1>
        <p>Votre rendez-vous a été validé.</p>
        <p><strong>Date du rendez-vous :</strong> {{ $rendezVous->date_visite }}</p>
        <p><strong>Heure du rendez-vous :</strong> {{ $rendezVous->heure_visite }}</p>
        <p>Merci de votre confiance.</p>
        <div class="footer">
            <p>Cordialement,</p>
        </div>
    </div>
</body>
</html>