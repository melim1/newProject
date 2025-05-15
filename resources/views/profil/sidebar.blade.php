@extends('layouts.app')
@section('title', 'Profil utilisateur')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <button class="list-group-item list-group-item-action active" onclick="showSection('profile')">
                    Profil
                </button>
                <button class="list-group-item list-group-item-action" onclick="showSection('ajouter')">
                    Ajouter un bien
                </button>
                <button class="list-group-item list-group-item-action" onclick="showSection('mes_biens')">
                    Mes biens
                </button>
            </div>
        </div>

        <!-- Contenu dynamique -->
        <div class="col-md-9">
            <div id="section-profile">
                <h3>Profil de {{ $user->name }}</h3>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>

            <div id="section-ajouter" style="display: none;">
                <h3>Ajouter un bien immobilier</h3>
                <a href="{{ route('profil.showAddForm') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Aller au formulaire
                </a>
            </div>

            <div id="section-mes_biens" style="display: none;">
                <h3>Mes biens immobiliers</h3>
                @include('profil.mes_biens') {{-- Mets ici la vue partielle avec la liste filtrée --}}
            </div>
        </div>
    </div>
</div>

<script>
    function showSection(section) {
        // Masquer toutes les sections
        document.getElementById('section-profile').style.display = 'none';
        document.getElementById('section-ajouter').style.display = 'none';
        document.getElementById('section-mes_biens').style.display = 'none';

        // Supprimer l’état actif
        document.querySelectorAll('.list-group-item').forEach(btn => btn.classList.remove('active'));

        // Afficher la section sélectionnée
        document.getElementById('section-' + section).style.display = 'block';

        // Activer le bouton
        event.target.classList.add('active');
    }
</script>
@endsection
