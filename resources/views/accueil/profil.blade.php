@extends('layouts.app')
@section('title', 'Profil')

@section('content')
<div class="container mt-5">
    <!-- Affichage du bouton de déconnexion si l'utilisateur est connecté -->
    @auth
        <div class="d-flex justify-content-between align-items-center">
            <h1>Profil de {{ $user->name }}</h1>
            <a href="{{ route('logout') }}" class="btn btn-danger" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
            </a>
        </div>

        <!-- Formulaire de déconnexion caché -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @else
        <p>Vous n'êtes pas connecté.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
    @endauth
</div>

<div class="container">
    <!-- Informations de l'utilisateur -->
    <div class="mb-4">
        <div class="p-4 bg-white rounded shadow-sm border">
            <p class="mb-2"><strong>Nom :</strong> {{ $user->name }}</p>
            <p class="mb-0"><strong>Email :</strong> {{ $user->email }}</p>
        </div>
    </div>
</div>
@endsection
