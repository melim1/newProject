
<!DOCTYPE html>
<html>
<head>
    <title> Rendez-vous validé</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border: 1px solid #dddddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <!-- En-tête -->
        <div style="text-align: center; padding-bottom: 20px; border-bottom: 1px solid #eeeeee;">
            <h1 style="color: #333333; font-size: 24px; margin: 0;">Demande de rendez-vous Accepté</h1>
        </div>

        <!-- Contenu -->
        <div style="padding: 20px 0; color: #555555; font-size: 16px; line-height: 1.6;">
            <p>Bonjour <strong>{{ $rendezVous->nom_complet }}</strong>,</p>
            <p>Votre rendez-vous a été validé.</p>
        <p><strong>Date du rendez-vous :</strong> {{ $rendezVous->date_visite }}</p>
        <p><strong>Heure du rendez-vous :</strong> {{ $rendezVous->heure_visite }}</p>
        <p>Merci de votre confiance.</p>
           
        </div>

      
    </div>
</body>
</html>