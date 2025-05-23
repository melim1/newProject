<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Immobilier;
use Illuminate\Support\Facades\Http;

class ImmobilierChatbotController extends Controller
{
    public function search(Request $request)
    {
        $message = strtolower($request->input('message'));

        // Analyse rapide pour détecter si c’est un message immobilier
        $isImmobilier = $this->contientMotCleImmobilier($message);

        $resultats = collect(); // vide par défaut

        if ($isImmobilier) {
            $resultats = $this->rechercheImmobilier($message);
        }

        // Appel à l'IA OpenRouter dans tous les cas
        $reponseIA = $this->askOpenRouter($message, $resultats);

        // Si on a des résultats, on les ajoute à la réponse IA
        if ($resultats->isNotEmpty()) {
            $reponseIA .= "\n\n";
            foreach ($resultats as $bien) {
                $url = '';
                switch (strtolower($bien->type)) {
                    case 'achat':
                        $url = url('/vente/detail/' . $bien->id);
                        break;
                    case 'location':
                        $url = url('/louer/detail/' . $bien->id);
                        break;
                    case 'échange':
                    case 'echange':
                        
                        $url = url('/echange/detail/' . $bien->id);
                        break;
                }

                $reponseIA .= "🏠 *{$bien->type}*\n";
                $reponseIA .= "📍 Adresse : {$bien->adresse}\n";
                $reponseIA .= "📐 Surface : {$bien->surface} m²\n";
                $reponseIA .= "💰 Prix : " . number_format($bien->prix, 0, ',', ' ') . " DA\n";
                $reponseIA .= "📝 Description : " . ($bien->description ?? 'Aucune description') . "\n";
                $reponseIA .= "🔗 Lien : {$url}\n";
                $reponseIA .= "--------------------------------\n";
            }
        }

        return response()->json(['response' => $reponseIA]);
    }

    private function contientMotCleImmobilier($message)
    {
        $keywords = ['appartement', 'maison', 'location', 'achat', 'échange', 'villa', 'studio', 'terrain'];
        foreach ($keywords as $word) {
            if (str_contains($message, $word)) {
                return true;
            }
        }
        return false;
    }

    private function rechercheImmobilier($message)
    {
        $query = Immobilier::query();

        $types = ['location', 'achat', 'échange', 'echange'];
        foreach ($types as $type) {
            if (str_contains($message, $type)) {
                $query->where('type', 'like', '%' . $type . '%');
                break;
            }
        }

        if (preg_match('/(\d{2,4})\s*(m²|m2|metre[s]? carré[s]?|mètre[s]? carré[s]?)/i', $message, $matches)) {
            $surface = floatval($matches[1]);
            $query->where('surface', '>=', $surface);
        }

        if (preg_match('/(\d[\d\s]*)\s*(da|dinar|millions?)/i', $message, $matches)) {
            $prix = floatval(str_replace(' ', '', $matches[1]));
            if (stripos($matches[2], 'million') !== false) {
                $prix *= 1000000;
            }
            $query->where('prix', '<=', $prix);
        }

        $villes = ['alger', 'oran', 'constantine', 'bejaia', 'tizi', 'blida', 'setif'];
        foreach ($villes as $ville) {
            if (str_contains($message, $ville)) {
                $query->where('adresse', 'like', '%' . ucfirst($ville) . '%');
                break;
            }
        }

        return $query->take(5)->get();
    }

    private function askOpenRouter($userMessage, $biens)
    {
        $openRouterToken = env('OPENROUTER_API_KEY');

        $systemPrompt = "Tu es un assistant immobilier pour les utilisateurs en Algérie, mais tu peux aussi répondre à d'autres questions (tech, culture, etc.) de manière naturelle.";
        $userPrompt = "Utilisateur : \"$userMessage\"";

        if ($biens->isNotEmpty()) {
            $userPrompt .= "\nRéponds avec une phrase introductive polie et claire avant de lister les biens.";
        } elseif ($this->contientMotCleImmobilier($userMessage)) {
            $userPrompt .= "\nAucun bien n’a été trouvé. Réponds gentiment qu’il n’y a rien de disponible.";
        } else {
            $userPrompt .= "\nRéponds simplement comme un assistant IA classique.";
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $openRouterToken,
            'Content-Type' => 'application/json',
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'openai/gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $userPrompt],
            ],
            'max_tokens' => 200,
        ]);

        $json = $response->json();

        return $json['choices'][0]['message']['content'] ?? "Je suis là pour vous aider !";
    }
}
