<!DOCTYPE html>
<html>
<head>
    <title>Demande de rendez-vous refusée</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border: 1px solid #dddddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <!-- En-tête -->
        <div style="text-align: center; padding-bottom: 20px; border-bottom: 1px solid #eeeeee;">
            <h1 style="color: #333333; font-size: 24px; margin: 0;">Demande de rendez-vous refusée</h1>
        </div>

        <!-- Contenu -->
        <div style="padding: 20px 0; color: #555555; font-size: 16px; line-height: 1.6;">
            <p>Bonjour <strong>{{ $rendezVous->nom_complet }}</strong>,</p>
            <p>Nous regrettons de vous informer que votre demande de rendez-vous a été refusée .</p>
            <p>Si vous avez des questions ou souhaitez plus d'informations, n'hésitez pas à nous contacter.</p>
            <p>Merci de votre compréhension.</p>
        </div>

      
    </div>
</body>
</html>