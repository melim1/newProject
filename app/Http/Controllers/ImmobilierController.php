<?php

namespace App\Http\Controllers;

use App\Models\Immobilier;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ImmobilierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct()
    {
        $this->middleware('permission:immobilier-list|immobilier-create|immobilier-edit|immobilier-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:immobilier-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:immobilier-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:immobilier-delete', ['only' => ['destroy']]);
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $immobiliers = Immobilier::latest()->paginate(12);

        return view('immobiliers.index', compact('immobiliers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('immobiliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request): RedirectResponse
     {
         $request->validate([
             "adresse" => 'required|max:255',
             "type" => 'required|max:255',
             "prix" => 'numeric',
             "surface" => 'numeric',
             "user_image" => 'required|image|mimes:jpeg,png,jpg',
             "description" => 'required|max:255',
             'photos' => 'required|array|max:5',  // La validation des images multiples
             'photos.*' => 'image|mimes:jpg,png,jpeg|max:5120',  // Chaque image doit être valide
         ]);

         $requestData = $request->all();

         // Upload de l'image principale
         $fileName = time() . $request->file('user_image')->getClientOriginalName();
         $path = $request->file('user_image')->storeAs('images', $fileName, 'public');
         $requestData['user_image'] = '/storage/' . $path;

         // Upload des images multiples et stockage des chemins
         $photosPaths = [];
         if ($request->hasFile('photos')) {
             $photos = $request->file('photos');
             foreach ($photos as $photo) {
                 $photoName = time() . $photo->getClientOriginalName();
                 $photoPath = $photo->storeAs('images', $path, 'public');
                 $photosPaths[] = '/storage/' . $photoPath;  // Ajoute chaque chemin dans le tableau
             }
         }

         // Enregistrement des chemins des photos dans la base de données
         $requestData['photos'] = json_encode($photosPaths);  // Encode le tableau en JSON

         Immobilier::create([
            'user_id' => auth()->id(),
            'adresse' => $requestData['adresse'],
            'type' => $requestData['type'],
            'prix' => $requestData['prix'],
            'surface' => $requestData['surface'],
            'user_image' => '/storage/' . $path,
            'description' => $requestData['description'],
            'photos' => json_encode(array_map(fn($path) => '/storage/' . $path, $photosPaths))
        ]);

         return redirect()->route('immobiliers.index')
             ->with('success', 'Immobilier créé avec succès.');
     }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Immobilier  $immobiliers
     * @return \Illuminate\Http\Response
     */
    public function show(Immobilier $immobiliers): View
    {
        return view('immobiliers.show', compact('immobiliers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Immobilier  $immobiliers
     * @return \Illuminate\Http\Response
     */
   /* public function edit(Immobilier $immobiliers): View
    {
        return view('immobiliers.edit', compact('immobiliers'));
    }
 */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Immobilier  $immobiliers
     * @return \Illuminate\Http\Response
     */
   /* public function update(Request $request, Immobilier $immobiliers): RedirectResponse
    {
        request()->validate([
            "adresse" => 'required|max:255',
            "type" => 'required|max:255',
            "prix" => 'numeric',
            "surface" => 'numeric',
            "user_image" => 'required|image|max:2048',
             "description" => 'required|max:255',
        ]);

        $immobiliers->update($request->all());

        return redirect()->route('immobiliers.index')
            ->with('success', 'immobilier updated successfully');
    }*/


    public function edit($id)
    {
        $immobilier = Immobilier::findOrFail($id);  // Trouve l'immobilier par ID
        return view('immobiliers.edit', compact('immobilier'));  // Affiche la vue d'édition avec les données de l'immobilier
    }

    // Mettre à jour un immobilier
    public function update(Request $request, $id)
    {
        $request->validate([
            'adresse' => 'required',
            'type' => 'required',
            'prix' => 'required|numeric',
            'surface' => 'required|numeric',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $immobilier = Immobilier::findOrFail($id);  // Trouve l'immobilier par ID

        // Mettre à jour les informations de l'immobilier
        $immobilier->adresse = $request->adresse;
        $immobilier->type = $request->type;
        $immobilier->prix = $request->prix;
        $immobilier->surface = $request->surface;
        $immobilier->description = $request->description;

        // Gérer l'image si elle est mise à jour
        if ($request->hasFile('user_image')) {
            $imageName = time() . '.' . $request->user_image->extension();
            $request->user_image->move(public_path('images'), $imageName);
            $immobilier->user_image = 'images/' . $imageName;
        }

        $immobilier->save();  // Enregistrer les changements dans la base de données

        return redirect()->route('immobiliers.index')->with('success', 'Immobilier mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Immobilier  $immobiliers
     * @return \Illuminate\Http\Response
     */
   /* public function destroy(Immobilier $immobiliers): RedirectResponse
    {
        $immobiliers->delete();

        return redirect()->route('immobiliers.index')
            ->with('success', 'immobilier deleted successfully');
    }*/

    public function destroy($id)
    {
        // Trouve l'immobilier par ID
        $immobilier = Immobilier::findOrFail($id);

        // Supprimer l'immobilier
        $immobilier->delete();

        // Retourne à la page d'index avec un message de succès
        return redirect()->route('immobiliers.index')->with('success', 'Immobilier supprimé avec succès');
    }


    public function acheter()
    {
        // Récupérer les biens de type "achat" en utilisant le champ existant
        $immobiliers = Immobilier::where('type', 'achat')->get();

        // Passer les données à la vue
        return view('accueil.acheter', compact('immobiliers'));
    }



    public function louer()
    {
        // Récupérer les biens de type "location"
        $immobiliers = Immobilier::where('type', 'location')->get();

        // Passer les données à la vue
        return view('accueil.louer', compact('immobiliers'));
    }




    /**
 * Affiche les détails d'un bien immobilier pour la vente.
 *
 * @param  int  $id
 * @return \Illuminate\View\View
 */
public function venteDetail($id): View
{
    // Récupère le bien immobilier par son ID
    $immobilier = Immobilier::findOrFail($id);

    // Retourne la vue avec les détails du bien immobilier
    return view('vente.detail', compact('immobilier'));
}



public function louerDetail($id): View
{
    // Récupère le bien immobilier par son ID
    $immobilier = Immobilier::findOrFail($id);

    // Retourne la vue avec les détails du bien immobilier
    return view('louer.detail', compact('immobilier'));
}



/**
 * Affiche le formulaire pour prendre un rendez-vous.

 * Affiche le formulaire pour envoyer une demande de rendez-vous.
 *
 * @param  int  $id
 * @return \Illuminate\View\View
 */
public function prendreRdv($id): View
{
    // Récupère le bien immobilier par son ID
    $immobilier = Immobilier::findOrFail($id);

    // Retourne la vue pour envoyer une demande de rendez-vous
    return view('rdv.create', compact('immobilier'));
}








public function echanger()
{
    $immobiliers = Immobilier::where('type', 'echange')->get();

    // Optionnel : exemple si tu veux calculer des propositions pour un des échanges (ex : le premier)
    $propositions = [];

    foreach ($immobiliers as $immobilier) {
        $caracs = json_decode($immobilier->caracteristiques_souhaitees, true);

        $matched = Immobilier::where('type', 'echange')
            ->where('user_id', '!=', $immobilier->user_id)
           // ->where('adresse', 'LIKE', '%' . $caracs['adresse'] . '%')
           // ->where('prix', '<=', $caracs['prix_max'])
           // ->where('surface', '>=', $caracs['surface_min'])
            ->get();

        $propositions[$immobilier->id] = $matched;
    }

    return view('accueil.echanger', compact('immobiliers', 'propositions'));
}







    public function echangeDetail($id): View
{
    // Récupère le bien immobilier par son ID
    $immobilier = Immobilier::findOrFail($id);

    // Retourne la vue avec les détails du bien immobilier
    return view('echange.detail', compact('immobilier'));
}





public function rechercher($ref)
{
    $immobilier = Immobilier::where('id', $ref)->first();

    if (!$immobilier) {
        return response()->json(['error' => 'Non trouvé'], 404);
    }

    // Supposons que tu as une relation images()
    return view('echange.detail', compact('immobilier'));

}

public function indexAccueil()
{
    $query = Immobilier::query();
    $searchPerformed = false;

    if (request()->hasAny(['type', 'budget', 'adresse'])) {
        $searchPerformed = true;

        // Filtrer par type (louer, achat, etc.)
        if ($type = request('type')) {
            $query->where('type', $type);
        }

        // Filtrer par budget maximal
        if ($budget = request('budget')) {
            $query->where('prix', '<=', (float) $budget);
        }

        // Filtrer par adresse partielle
        if ($adresse = request('adresse')) {
            $query->where('adresse', 'LIKE', "%{$adresse}%");
        }
    }

    $immobiliers = $query->paginate(6)->withQueryString();

    // Suggestions : autres biens aléatoires différents de ceux déjà affichés
    $suggestions = collect();
    if ($searchPerformed && $immobiliers->count() > 0) {
        $idsAffiches = $immobiliers->pluck('id')->toArray();
        $suggestions = Immobilier::whereNotIn('id', $idsAffiches)
                        ->inRandomOrder()
                        ->take(4)
                        ->get();
    }
    return view('accueil.home', [
        'immobiliers' => $immobiliers,
        'searchPerformed' => $searchPerformed,
        'suggestions' => $suggestions,
    ]);
}





}