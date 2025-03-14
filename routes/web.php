<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImmobilierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

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

Route::get('/acheter', function () {
    return view('accueil.acheter');
})->name('app_acheter');

Route::get('/louer', function () {
    return view('accueil.louer');
})->name('app_louer');

Route::get('/connexion', function () {
    return view('auth.login');
})->name('app_connexion');

Route::get('/inscription', function () {
    return view('auth.register');
})->name('app_inscription');

Route::get('/profil', function () {
    return view('accueil.profil');
})->name('app_profil');


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
 