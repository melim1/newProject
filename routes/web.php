<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImmobilierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('accueil.home');
})->name('app_accueil');





Route::get('/about', function () {
    return view('accueil.about');
})->name('app_about');





Route::get('/echanger', [ImmobilierController::class, 'echanger'])->name('app_echanger');

// Route pour afficher les détails d'un bien immobilier
Route::get('/echange/detail/{id}', [ImmobilierController::class, 'echangeDetail'])->name('echange.detail');




//afficher les maison de type vente
Route::get('/acheter', [ImmobilierController::class, 'acheter'])->name('app_acheter');

// Route pour afficher les détails d'un bien immobilier
Route::get('/vente/detail/{id}', [ImmobilierController::class, 'venteDetail'])->name('vente.detail');


//afficher les maison de type location
Route::get('/louer', [ImmobilierController::class, 'louer'])->name('app_louer');
// Route pour afficher les détails d'un bien immobilier
Route::get('/louer/detail/{id}', [ImmobilierController::class, 'louerDetail'])->name('louer.detail');


//3D

use App\Models\Immobilier;

Route::get('/vente/3Dshow/{id}', function ($id) {
    $immobilier = Immobilier::findOrFail($id);
    return view('/vente/3Dshow', compact('immobilier'));
})->name('3Dshow');




use App\Http\Controllers\CommentController;

// Afficher les commentaires pour un bien immobilier
Route::get('/vente/{id}', [CommentController::class, 'show'])->name('vente.show');

// Ajouter un commentaire
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');


// Modifier un commentaire
Route::put('/comment/{id}', [CommentController::class, 'update'])->name('comment.update');

// Supprimer un commentaire
Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');



use App\Http\Controllers\RendezVousController;

Route::post('/rendez-vous', [RendezVousController::class, 'store'])->name('rendez-vous.store');






use App\Http\Controllers\HistoriqueController;
Route::get('/historique', [HistoriqueController::class, 'index'])->name('app_historique')->middleware('auth');


# Messages

use Chatify\Http\Controllers\MessagesController;

Route::get('/messagerie', [MessagesController::class, 'index'])->name('messagerie')->middleware('auth');



Route::get('/messagerie/{id}', [MessagesController::class, 'versConversation'])->name('messagerie.utilisateur');


use App\Http\Controllers\NotificationController;



// web.php
Route::post('/notifications/markAsRead', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::post('/notifications/{id}/markAsRead', [NotificationController::class, 'markAsRead']);





// Pour les routes resource (recommandé)
Route::resource('rdvs', RendezVousController::class);

// Ou pour une route manuelle
Route::put('/rdvs/{rdv}', [RendezVousController::class, 'update'])->name('rdvs.update');







Route::middleware('auth')->group(function () {
    // Route pour récupérer le nombre de notifications non lues
    Route::get('/notifications/count', [NotificationController::class, 'count'])->name('notifications.count');

    // Route pour marquer toutes les notifications comme lues
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});






Route::get('/connexion', function () {
    return view('auth.login');
})->name('app_connexion');

Route::get('/inscription', function () {
    return view('auth.register');
})->name('app_inscription');





Auth::routes();

Route::get('/home', action: [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('immobiliers', ImmobilierController::class);

});

Route::get('/homeee', function () {
    return view('accueil.home'); // Assurez-vous que le fichier 'home.blade.php' est dans 'resources/views/accueil'
})->name('accueil.home');
















//notif admin

// Route pour afficher les notifications
// Route pour afficher la liste des notifications (avec pagination)
Route::get('/notifications', [NotificationController::class, 'notif'])->name('notification.index');

// Route pour afficher le nombre de notifications non lues
Route::get('/notifications/unread', [NotificationController::class, 'index'])->name('notifications.unread');

Route::patch('/notifications/{id}/read', [NotificationController::class, 'marquerLue'])->name('notification.markAsRead');





//Ajouter numero tlfn 
Route::post('/user/update-phone', [UserController::class, 'updatePhone'])->name('user.update.phone')->middleware('auth');



//compter les messages non lus

Route::get('/updateunseenmessage', [App\Http\Controllers\UserController::class, 'checkUnseenmessage']);






Route::middleware('auth:sanctum')->get('/user-info', function (Request $request) {
    return response()->json([
        'name' => $request->user()->name,
        'email' => $request->user()->email,
        'phone' => $request->user()->phone
    ]);
});





use App\Http\Controllers\ProfilController;

Route::get('/profil', [ProfilController::class, 'index'])->name('app_profil')->middleware('auth');



Route::middleware(['auth'])->group(function () {
    // Profil
    Route::get('/profil', [ProfilController::class, 'show'])->name('app_profil');
    Route::get('/profil/index', [ProfilController::class, 'index'])->name('profil.index');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    
    // Biens immobiliers
    Route::post('/profil/biens', [ProfilController::class, 'storeBien'])->name('profil.storeBien');


    Route::get('/profil/biens/{id}/edit', [ProfilController::class, 'edit'])->name('profil.biens.edit');
    Route::put('/profil/biens/{id}', [ProfilController::class, 'updateImmob'])->name('profil.biens.update');



  


    Route::get('/profil/{id}', [ProfilController::class, 'destroy'])->name('profil.biens.destroy');


});


Route::post('/notifications/{notification}/mark-as-read', function ($notificationId) {
    $notification = auth()->user()->notifications()->findOrFail($notificationId);
    $notification->markAsRead();
    
    return response()->json(['success' => true]);
})->middleware('auth');






use App\Http\Controllers\EchangerController;

Route::get('/echanger/search', [EchangerController::class, 'search'])
     ->name('echanger.search'); // Nom cohérent avec le contrôleur



     Route::get('/echange/create', [EchangerController::class, 'create'])->name('echange.create');
Route::post('/echange', [EchangerController::class, 'store'])->name('echange.store');

    

Route::get('/offres-similaires/{id}', [EchangerController::class, 'offresSimilaires'])->name('offres.similaires');






Route::get('/immobiliers/rechercher/{ref}', [ImmobilierController::class, 'rechercher'])->name('rechercher');
