@extends('layouts.admin')

@section('content')
<style>
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        height: 100%;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12);
    }
    
    .card-img-container {
        height: 220px;
        overflow: hidden;
        position: relative;
    }
    
    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .card:hover .card-img {
        transform: scale(1.05);
    }
    
    .card-body {
        padding: 1.5rem;
        background-color: #f8f9fa;
    }
    
    .card-text {
        margin-bottom: 0.8rem;
        color: #495057;
        font-size: 0.95rem;
    }
    
    .card-text strong {
        color: #212529;
        font-weight: 600;
    }
    
    .btn-add {
        background-color: #2c3e50;
        border: none;
        border-radius: 8px;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .btn-add:hover {
        background-color: #1a252f;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .btn-action {
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn-edit {
        background-color: #3498db;
        border-color: #3498db;
    }
    
    .btn-edit:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }
    
    .btn-delete {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }
    
    .btn-delete:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
    }
    
    .price-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: rgba(44, 62, 80, 0.9);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        z-index: 1;
    }
    
    .location-icon {
        color: #e74c3c;
        margin-right: 5px;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #dee2e6;
    }
</style>

<div class="container-fluid py-4">
    <!-- Header with Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 font-weight-bold text-dark">Gestion des Biens Immobiliers</h2>
        <a href="{{ route('immobiliers.create') }}" class="btn btn-add text-white">
            <i class="fas fa-plus-circle mr-2"></i> Ajouter un bien
        </a>
    </div>

    @if($immobiliers->isEmpty())
        <div class="empty-state bg-white rounded-lg shadow-sm p-5">
            <i class="fas fa-home"></i>
            <h3 class="h5 text-muted">Aucun bien immobilier enregistré</h3>
            <p class="text-muted">Commencez par ajouter votre premier bien immobilier</p>
            <a href="{{ route('immobiliers.create') }}" class="btn btn-add text-white mt-3">
                <i class="fas fa-plus-circle mr-2"></i> Ajouter un bien
            </a>
        </div>
    @else
        <div class="row">
            @foreach ($immobiliers as $immobilier)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <!-- Image with Price Badge -->
                        <div class="card-img-container">
                            <img src="{{ asset($immobilier->user_image) }}" class="card-img" alt="Bien immobilier">
                            <div class="price-badge">
                                {{ $immobilier->prix }} DA
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <!-- Property Type -->
                            <h5 class="card-title text-capitalize font-weight-bold mb-3">
                                {{ $immobilier->type }}
                            </h5>
                            
                            <!-- Details -->
                            <div class="mb-3">
                                <p class="card-text">
                                    <strong>Surface :</strong> {{ $immobilier->surface }} m²
                                </p>
                                <p class="card-text">
                                    <i class="fas fa-map-marker-alt location-icon"></i> 
                                    {{ Str::limit($immobilier->adresse, 30) }}
                                </p>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                
                                
                                <div class="btn-group">
                                    @role('Admin')
                                    <a href="{{ route('immobiliers.edit', $immobilier->id) }}" class="btn btn-action btn-edit text-white mr-2">
                                        <i class="fas fa-edit mr-1"></i> Modifier
                                    </a>
                                    
                                    <form action="{{ route('immobiliers.destroy', $immobilier->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-delete text-white" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bien ?');">
                                            <i class="fas fa-trash mr-1"></i> Supprimer
                                        </button>
                                    </form>
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($immobiliers->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $immobiliers->links() }}
            </div>
        @endif
    @endif
</div>

<script>
    // Animation for cards
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.querySelector('.card-img').style.transform = 'scale(1.05)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.querySelector('.card-img').style.transform = 'scale(1)';
        });
    });
</script>
@endsection