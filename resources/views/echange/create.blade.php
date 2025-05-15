@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 1000px; /* Augmentation de la largeur */
        margin-top: 30px;
    }

    h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #4e79a7;
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 5px;
        font-size: 1rem;
        
        
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-success {
        background-color: #4e79a7;
        color: white;
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 1rem;
        border: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-success:hover {
        background-color: #357ab7;
        transform: scale(1.05);
    }

    .mb-3 label {
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .mb-3 {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    h5 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #4e79a7;
    }

    /* Style pour la grille */
    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .col-6 {
        width: 48%;
    }

    /* Centrer les boutons */
    .button-container {
        text-align: center;
        margin-top: 20px;
    }

    /* Sections distinctes avec fond grisé et bordures subtiles */
    .section {
        background-color: #f5f5f5;
        padding: 10px; /* Réduction de la hauteur des sections */
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px; /* Réduction de l'espace entre les sections */
    
    
        background-image: url('/src/pano9.jpg'); /* Remplacez par le chemin de votre image */
    background-size: cover; /* L'image couvre toute la section */
    background-position: center; /* Centrer l'image */
    background-repeat: no-repeat; /* Empêche l'image de se répéter */
    padding: 20px; /* Ajoute de l'espace autour du contenu */
    border-radius: 10px; /* Ajoute des coins arrondis à la section */
  }

    .section h5 {
        margin-top: 0;
    }

    .section .row {
        margin-bottom: 15px;
    }
</style>

<div class="container">
    <h2>Ajouter une offre d'échange</h2>
    <form method="POST" action="{{ route('echange.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type" value="echange">

        <!-- Section 1: Informations de base -->
        <div class="section">
            <h5>Informations de l'offre</h5>
            <div class="row">
                <div class="col-6 mb-3">
                    <label>Adresse</label>
                    <input type="text" name="adresse" class="form-control" required>
                </div>

                <div class="col-6 mb-3">
                    <label>Prix</label>
                    <input type="number" name="prix" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label>Surface (m²)</label>
                    <input type="number" name="surface" class="form-control" required>
                </div>

                <div class="col-6 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label>Image principale</label>
                    <input type="file" name="user_image" class="form-control">
                </div>

                <div class="col-6 mb-3">
                    <label>Photos supplémentaires</label>
                    <input type="file" name="photos[]" class="form-control" multiple>
                </div>
            </div>
        </div>

        <!-- Section 2: Critères d'échange -->
        <div class="section">
            <h5>Caractéristiques souhaitées pour l'échange</h5>

            <div class="row">
                <div class="col-6 mb-3">
                    <label>Adresse souhaitée</label>
                    <input type="text" name="carac_adresse" class="form-control">
                </div>

                <div class="col-6 mb-3">
                    <label>Prix souhaité (max)</label>
                    <input type="number" name="carac_prix_max" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label>Surface souhaitée (min)</label>
                    <input type="number" name="carac_surface_min" class="form-control">
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="button-container">
            <button type="submit" class="btn btn-success">Publier l'offre</button>
            <a href="{{ route('app_echanger') }}" class="btn btn-success">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </form>
</div>
@endsection
