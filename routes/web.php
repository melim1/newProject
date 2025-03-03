<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\user\ProfileController;
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
    return view('accueil.connexion');
})->name('app_connexion');

Route::get('/inscription', function () {
    return view('accueil.inscription');
})->name('app_inscription');

Auth::routes();

/*Route::middleware(['auth'])->group(function () {
    Route::get('user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('user/profile', [ProfileController::class, 'update'])->name('profile.update');
});*/
#route::get('user/profile',[ProfileController::class,'index'])->name('user.profile');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
