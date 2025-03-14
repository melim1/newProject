<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Où rediriger les utilisateurs après la connexion.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Page par défaut pour les utilisateurs non administrateurs

    /**
     * Crée une nouvelle instance de contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    protected function username()
    {
        // Récupère la valeur du champ 'email_or_phone' depuis la requête
        $login = request('email_or_phone');

        // Vérifie si la valeur est un email ou un numéro de téléphone
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Fusionne la valeur dans la requête sous le bon champ ('email' ou 'phone')
        request()->merge([$field => $login]);

        // Retourne le champ à utiliser pour l'authentification
        return $field;
    }

    
    /**
     * La méthode qui sera appelée après que l'utilisateur soit authentifié.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated($request, $user)
    {
        // Vérifier si l'utilisateur a le rôle 'Admin'
        if ($user->hasRole('Admin')) {
            // Rediriger vers la page par défaut de l'administrateur
            return redirect()->route('home'); // Remplacez par la route que vous avez pour la page d'admin
        }

        // Si l'utilisateur n'a pas le rôle 'Admin', rediriger vers la page 'accueil/home.blade.php'
        return redirect()->route('accueil.home'); // Cette route doit correspondre à la page d'accueil (home.blade.php)
    }
}
