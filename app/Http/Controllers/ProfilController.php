<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immobilier;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function index(): View
    {
        $immobiliers = Immobilier::latest()->paginate(12);
        return view('accueil.profil', compact('immobiliers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show(): View
    {
        $user = Auth::user();
        $biens = Immobilier::where('user_id', auth()->id())->get();
        $notifications = $user->notifications;

        return view('accueil.profil', compact('user', 'biens', 'notifications'));
    }












    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Valider les entrées du formulaire avec des messages personnalisés
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
'phone' => [
    'nullable',
    'string',
    'regex:/^(05|06|07)[0-9]{8}$/',
    'max:10'
],        ], [
            'avatar.max' => 'L\'avatar ne doit pas dépasser 5 Mo',
            'avatar.mimes' => 'Seuls les formats JPEG, PNG, JPG et GIF sont acceptés'
        ]);
    
        // Gestion de l'avatar
        if ($request->hasFile('avatar')) {
            try {
                // Suppression sécurisée de l'ancien avatar
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
    
                // Stockage avec nom de fichier unique
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $validatedData['avatar'] = $avatarPath;
                
            } catch (\Exception $e) {
                Log::error('Erreur lors du traitement de l\'avatar : '.$e->getMessage());
                return back()->with('error', 'Une erreur est survenue lors du traitement de l\'image');
            }
        }
    
        // Mise à jour des données
        try {
            $user->update($validatedData);
            
            // Si l'email a changé, on peut vouloir revalider l'email
            if ($user->wasChanged('email')) {
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
            }
            
            return back()->with('success', 'Profil mis à jour avec succès');
            
        } catch (\Exception $e) {
            Log::error('Erreur mise à jour profil : '.$e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour');
        }
    }

    public function storeBien(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            "adresse" => 'required|max:255',
            "type" => 'required|max:255',
            "prix" => 'numeric',
            "surface" => 'numeric',
            "user_image" => 'required|image|mimes:jpeg,png,jpg|max:5120',
            "description" => 'required|max:255',
            'photos' => 'required|array|max:5',
            'photos.*' => 'image|mimes:jpg,png,jpeg|max:5120',
        ]);
    
        // Gestion de l'image principale
        $mainImagePath = $request->file('user_image')->store('images', 'public');
        
        // Gestion des photos multiples
        $photosPaths = [];
        foreach ($request->file('photos') as $photo) {
            $photosPaths[] = $photo->store('images', 'public');
        }
    
        Immobilier::create([
            'user_id' => auth()->id(),
            'adresse' => $validatedData['adresse'],
            'type' => $validatedData['type'],
            'prix' => $validatedData['prix'],
            'surface' => $validatedData['surface'],
            'user_image' => '/storage/' . $mainImagePath,
            'description' => $validatedData['description'],
            'photos' => json_encode(array_map(fn($path) => '/storage/' . $path, $photosPaths))
        ]);
    
        return redirect()->route('app_profil')->with('success', 'Bien ajouté avec succès.');
    }

    public function edit($id): View
    {
        $immobilier = Immobilier::findOrFail($id);
        return view('profil.edit', compact('immobilier'));
    }

    public function updateImmob(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'adresse' => 'required',
            'type' => 'required',
            'prix' => 'required|numeric',
            'surface' => 'required|numeric',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $immobilier = Immobilier::findOrFail($id);
        $data = $request->except('user_image');

        // Gestion de l'image
        if ($request->hasFile('user_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($immobilier->user_image && file_exists(public_path($immobilier->user_image))) {
                unlink(public_path($immobilier->user_image));
            }
            
            $imagePath = $request->file('user_image')->store('images', 'public');
            $data['user_image'] = '/storage/' . $imagePath;
        }

        $immobilier->update($data);

        return redirect()->route('app_profil')->with('success', 'Bien immobilier mis à jour avec succès');
    }










    public function destroy($id)
    {
        // Trouve l'immobilier par ID
        $immobilier = Immobilier::findOrFail($id);

        // Supprimer l'immobilier
        $immobilier->delete();

        // Retourne à la page d'index avec un message de succès
        return redirect()->route('app_profil')->with('success', 'Immobilier supprimé avec succès');
    }
}