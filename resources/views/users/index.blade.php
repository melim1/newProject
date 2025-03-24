@extends('layouts.admin')

@section('content')
<style>
    .user-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        height: 100%;
        background-color: #ffffff;
    }
    
    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    }
    
    .card-body {
        padding: 1.75rem;
        position: relative;
    }
    
    .user-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #f8f9fa;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        position: absolute;
        top: -40px;
        right: 20px;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #6c757d;
    }
    
    .user-name {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        font-size: 1.25rem;
        padding-right: 90px;
    }
    
    .user-detail {
        margin-bottom: 0.75rem;
        color: #495057;
        font-size: 0.95rem;
    }
    
    .user-detail strong {
        color: #343a40;
        font-weight: 600;
    }
    
    .contact-icon {
        color: #3498db;
        margin-right: 8px;
        width: 18px;
        text-align: center;
    }
    
    .no-contact {
        color: #6c757d;
        font-style: italic;
    }
    
    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }
    
    .btn-delete {
        background-color: #e74c3c;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-delete:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(231, 76, 60, 0.2);
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e9ecef;
    }
    
    .page-title {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.75rem;
        margin: 0;
    }
    
    .btn-add-user {
        background-color: #2c3e50;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-add-user:hover {
        background-color: #1a252f;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
        background-color: #f8f9fa;
        border-radius: 12px;
        margin-top: 2rem;
    }
    
    .empty-icon {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 1.5rem;
    }
    
    .empty-text {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }
    
    .pagination-container {
        margin-top: 3rem;
    }
    
    .page-item.active .page-link {
        background-color: #2c3e50;
        border-color: #2c3e50;
    }
    
    .page-link {
        color: #2c3e50;
    }
</style>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Gestion des Utilisateurs</h1>
      
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($data->isEmpty())
        <div class="empty-state">
            <i class="fas fa-users empty-icon"></i>
            <h3 class="empty-text">Aucun utilisateur trouvé</h3>
            <a href="{{ route('users.create') }}" class="btn btn-add-user text-white">
                <i class="fas fa-user-plus mr-2"></i> Créer un utilisateur
            </a>
        </div>
    @else
        <div class="row">
            @foreach ($data as $user)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="user-card">
                        <div class="card-body">
                            <!-- User Avatar -->
                            <div class="user-avatar">
                                @if($user->profile_photo)
                                    <img src="{{ asset($user->profile_photo) }}" alt="User Avatar">
                                @else
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>
                            
                            <!-- User Name -->
                            <h5 class="user-name">{{ $user->name }}</h5>
                            
                            <!-- Contact Information -->
                            <div class="user-detail">
                                <strong><i class="fas fa-envelope contact-icon"></i> Email:</strong>
                                @if($user->email)
                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                @else
                                    <span class="no-contact">Non renseigné</span>
                                @endif
                            </div>
                            
                            <div class="user-detail">
                                <strong><i class="fas fa-phone contact-icon"></i> Téléphone:</strong>
                                @if($user->phone)
                                    {{ $user->phone }}
                                @else
                                    <span class="no-contact">Non renseigné</span>
                                @endif
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="action-buttons">
                               
                                
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-sm text-white"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                        <i class="fas fa-trash-alt me-1"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            {!! $data->links('pagination::bootstrap-5') !!}
        </div>
    @endif
</div>

<script>
    // Animation for user cards
    document.querySelectorAll('.user-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 12px 24px rgba(0, 0, 0, 0.12)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.08)';
        });
    });
</script>
@endsection