<?php

namespace App\Http\Controllers;
use App\Models\Immobilier;
use App\Models\User;
use App\Models\RendezVous;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalImmobiliers = Immobilier::count();

        // Statistiques des utilisateurs (si nécessaire)
        $totalUsers = User::count();

        $totalrndv = RendezVous::count();

       

        return view('home', compact(
            'totalImmobiliers', // Nombre total de biens immobiliers
            'totalUsers',
            'totalrndv',
                      

        ));
    }
}
