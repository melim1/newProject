<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immobilier;


class EchangerController extends Controller
{
    /**
     * Recherche de biens à échanger
     */
    public function search(Request $request)
    {
        // Validation des entrées
        $validated = $request->validate([
            'ville' => 'nullable|string|max:100',
            'surface' => 'nullable|integer|min:0',
            'prix_min' => 'nullable|numeric|min:0',
            'prix_max' => 'nullable|numeric|min:0',
            'type' => 'nullable|in:appartement,maison,villa,terrain'
        ]);
        
        // Construction de la requête
        $query = Immobilier::where('type', 'echange'); // Adaptez selon votre schéma DB
        
        if ($request->filled('ville')) {
            $query->where('adresse', 'like', '%'.$request->ville.'%');
        }
        
       
        
        if ($request->filled('surface')) {
            $query->where('surface', '>=', $request->surface);
        }
        
        // Filtre par fourchette de prix
        if ($request->filled('prix_min') && $request->filled('prix_max')) {
            $query->whereBetween('prix', [$request->prix_min, $request->prix_max]);
        } else {
            if ($request->filled('prix_min')) {
                $query->where('prix', '>=', $request->prix_min);
            }
            if ($request->filled('prix_max')) {
                $query->where('prix', '<=', $request->prix_max);
            }
        }
        
        // Tri et pagination
        $immobiliers = $query->orderBy('created_at', 'desc')
                            ->paginate(9)
                            ->appends($request->query());
        
        return view('accueil.echanger', compact('immobiliers'));
    }









    public function create()
{
    return view('echange.create');
}



public function store(Request $request)
{
    $request->validate([
        "adresse" => 'required|max:255',
        "type" => 'required|max:255',
        "prix" => 'numeric',
        "surface" => 'numeric',
        "user_image" => 'required|image|mimes:jpeg,png,jpg|max:5120',
        "description" => 'required|max:255',
        'photos' => 'required|array|max:5',
        'photos.*' => 'image|mimes:jpg,png,jpeg|max:5120',
        'carac_adresse' => 'nullable|string|max:255',
        'carac_prix_max' => 'nullable|numeric',
        'carac_surface_min' => 'nullable|numeric',
    ]);

    $requestData = $request->all();
     
    // Upload de l'image principale
    $fileName = time() . '_' . uniqid() . $request->file('user_image')->getClientOriginalName();
    $path = $request->file('user_image')->storeAs('images', $fileName, 'public');
    $requestData['user_image'] = '/storage/' . $path;
    
    // Upload des images multiples et stockage des chemins
    $photosPaths = [];
    if ($request->hasFile('photos')) {
        $photos = $request->file('photos');
        foreach ($photos as $photo) {
            $photoName = time() . '_' . uniqid() . $photo->getClientOriginalName();
            $photoPath = $photo->storeAs('images', $photoName, 'public');
            $photosPaths[] = '/storage/' . $photoPath;
        }
    }

    // Enregistrement des chemins des photos dans la base de données
    $requestData['photos'] = json_encode($photosPaths);

    // Enregistrement des caractéristiques souhaitées
    $requestData['caracteristiques_souhaitees'] = json_encode([
        'adresse' => $request->carac_adresse,
        'prix_max' => $request->carac_prix_max,
        'surface_min' => $request->carac_surface_min,
    ]);

    Immobilier::create([
        'user_id' => auth()->id(),
        'adresse' => $requestData['adresse'],
        'type' => $requestData['type'],
        'prix' => $requestData['prix'],
        'surface' => $requestData['surface'],
        'user_image' => $requestData['user_image'],
        'description' => $requestData['description'],
        'photos' => $requestData['photos'],
        'caracteristiques_souhaitees' => $requestData['caracteristiques_souhaitees'],
    ]);

    return redirect()->route('app_echanger')->with('success', 'Offre d\'échange ajoutée avec succès !');
}





public function offresSimilaires($id)
{
    // Récupère l'immobilier par son ID
    $immobilier = Immobilier::findOrFail($id);
// Décoder les caractéristiques souhaitées de l'utilisateur
$caracteristiques = json_decode($immobilier->caracteristiques_souhaitees);

// Récupérer toutes les offres de type "échange"
$offresSimilaires = Immobilier::where('type', 'echange')
    ->where(function($query) use ($caracteristiques) {
        // Comparer les adresses
        $query->where('adresse', 'like', '%' . $caracteristiques->adresse . '%')
              ->where('prix', '<=', $caracteristiques->prix_max)
              ->where('surface', '>=', $caracteristiques->surface_min);
    })
    ->get();
 // Retourner la vue avec les offres similaires
    return view('echange.offres_similaires', compact('immobilier', 'offresSimilaires'));

}







}