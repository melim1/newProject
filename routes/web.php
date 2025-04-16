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








//afficher les maison de type vente
Route::get('/acheter', [ImmobilierController::class, 'acheter'])->name('app_acheter');

// Route pour afficher les détails d'un bien immobilier
Route::get('/vente/detail/{id}', [ImmobilierController::class, 'venteDetail'])->name('vente.detail');


//afficher les maison de type location
Route::get('/louer', [ImmobilierController::class, 'louer'])->name('app_louer');
// Route pour afficher les détails d'un bien immobilier
Route::get('/louer/detail/{id}', [ImmobilierController::class, 'louerDetail'])->name('louer.detail');




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





use App\Http\Controllers\ProfilController;

Route::get('/profil', [ProfilController::class, 'index'])->name('app_profil')->middleware('auth');


use App\Http\Controllers\HistoriqueController;
Route::get('/historique', [HistoriqueController::class, 'index'])->name('app_historique')->middleware('auth');


# Messages

use Chatify\Http\Controllers\MessagesController;

Route::get('/messagerie', [MessagesController::class, 'index'])->name('messagerie')->middleware('auth');






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



//compter les messages non lus

Route::get('/updateunseenmessage', [App\Http\Controllers\UserController::class, 'checkUnseenmessage']);
