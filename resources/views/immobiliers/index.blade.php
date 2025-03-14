@extends('layouts.admin') <!-- Assurez-vous que cela pointe vers votre layout -->

@section('content')
<div class="container-fluid">
    <!-- Bouton Ajouter -->
    <div class="mb-4">
        <a href="{{ route('immobiliers.create') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus"></i> Ajouter un bien immobilier
        </a>
    </div>

    <div class="row">
        @foreach ($immobiliers as $immobilier)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-lg border-0">
                    <!-- Image du bien immobilier -->
                    <div class="card-img-top overflow-hidden" style="height: 200px;">
                        <img src="{{ asset($immobilier->user_image) }}" class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    
                    <div class="card-body">
                        <!-- Prix -->
                        <p class="card-text">
                            <strong>Prix :</strong> {{ $immobilier->prix }} €
                        </p>
                        <!-- Surface -->
                        <p class="card-text">
                            <strong>Surface :</strong> {{ $immobilier->surface }} m²
                        </p>
                        <!-- Localisation -->
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt"></i> {{ $immobilier->adresse }}
                        </p>
                        
                        <!-- Boutons d'action -->
                        <div class="mt-3 d-flex justify-content-between">
                            @role('Admin')
                            <!-- Bouton Supprimer -->
                            <form action="{{ route('immobiliers.destroy', $immobilier->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce bien ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>

                            <!-- Bouton Modifier -->
                            <a href="{{ route('immobiliers.edit', $immobilier->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection