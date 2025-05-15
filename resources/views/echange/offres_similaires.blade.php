@extends('layouts.app')

@section('content')
<style>
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-img-top img {
        height: 250px;
        object-fit: cover;
        width: 100%;
    }

    .caracteristiques-box {
        background-color: #f0f8ff;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #cce;
        margin: 30px auto;
        width: 70%;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .caracteristiques-box p {
        margin-bottom: 12px;
        font-size: 16px;
    }

    .caracteristiques-box i {
        color: #007bff;
        margin-right: 5px;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #4e79a7;
        text-align: center;
        margin-bottom: 2rem;
    }

    .btn {
        background-color: #4e79a7;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 30px;
        font-size: 0.9rem;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn:hover {
        background-color: #357ab7;
        transform: scale(1.05);
    }

    .btn i {
        margin-right: 5px;
    }

    @media (max-width: 768px) {
        .card {
            margin-bottom: 1.5rem;
        }

        h1 {
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .navbar-nav {
            text-align: center;
        }

        .nav-item {
            margin: 0.5rem 0;
        }

        .price-surface {
            flex-direction: column;
            align-items: flex-start;
        }

        .card-buttons {
            flex-direction: column;
        }

        .card-buttons .btn {
            margin: 5px 0;
        }
    }

</style>

<div class="container">
    <h1 class="my-4">Offres similaires à l'immobilier</h1>

    <div class="row">
        <div class="col-md-12">
            <?php $caracteristiques = json_decode($immobilier->caracteristiques_souhaitees); ?>

            <div class="caracteristiques-box text-center">
                <p><i class="fas fa-map-marker-alt"></i> <strong>Adresse souhaitée :</strong> {{ $caracteristiques->adresse ?? 'Non spécifiée' }}</p>
                <p><i class="fas fa-money-bill-wave"></i> <strong>Prix maximum souhaité :</strong> {{ $caracteristiques->prix_max ?? 'Non spécifié' }} DA</p>
                <p><i class="fas fa-expand"></i> <strong>Surface minimale souhaitée :</strong> {{ $caracteristiques->surface_min ?? 'Non spécifiée' }} m²</p>
            </div>

            <div class="row align-items-stretch">
                @forelse($offresSimilaires as $offre)
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card w-100">
                            <div class="card-img-top">
                                <img src="{{ asset($offre->user_image) }}" class="img-fluid" alt="Image de l'offre">
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-text text-center mt-2">{{ $offre->type }} - {{ $offre->adresse }}</h5>

                                <div class="d-flex justify-content-between mb-2">
    <p class="mb-0"><i class="fas fa-money-bill-wave"></i> <strong>Prix :</strong> {{ $offre->prix }} DA</p>
    <p class="mb-0"><i class="fas fa-expand"></i> <strong>Surface :</strong> {{ $offre->surface }} m²</p>
</div>

<p class="card-text text-center mt-2">
    <i class="fas fa-info-circle"></i> <strong>Description :</strong> {{ $offre->description }}
</p>

                                <div class="d-flex justify-content-between mt-auto gap-2">
                                    <a href="{{ route('echange.detail', ['id' => $immobilier->id]) }}" class="btn btn-primary flex-fill text-nowrap">
                                        <i class="fas fa-eye"></i> Voir détail
                                    </a>
                                    <a href="{{ route('app_echanger') }}" class="btn btn-secondary flex-fill text-nowrap">
                                        <i class="fas fa-arrow-left"></i> Retour
                                    </a>
                                    <a href="{{ route('messagerie') }}" class="btn btn-success flex-fill text-nowrap">
                                        <i class="fas fa-comment-dots"></i> Message
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Aucune offre similaire trouvée.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
