



@extends('layouts.app')
@section('title', 'Profil')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Menu latéral -->
        <div class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse" id="sidebarMenu">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                      
        <!-- Boutons de navigation avec icônes -->
        <button class="btn btn-white w-100 mb-3 menu-btn" onclick="showSection('profil-section')">
    @if(Auth::user()->image)
        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Image" class="rounded-circle" width="100" height="100">
    @else
        <i class="fas fa-user-circle" style="font-size: 100px; color: black;"></i>
    @endif
    Profil
</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" onclick="showSection('biens-section')">
                            <i class="fas fa-home me-2"></i> Mes biens
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" onclick="showSection('ajouter-section')">
                            <i class="fas fa-plus-circle me-2"></i> Ajouter un bien
                        </button>
                    </li>



                    <li class="nav-item">
                        <button class="nav-link" onclick="showSection('notification-section')">
                            <i class="fas fas fa-bell me-2"></i> Notification


                            
        @if(Auth::user()->unreadNotifications->count() > 0)
            <span class="notification-badge" id="notificationCount">
                {{ Auth::user()->unreadNotifications->count() }}
            </span>
        @endif
                        </button>
                    </li>


                    <li class="nav-item mt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contenu principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Section Profil (visible par défaut) -->
            <div id="profil-section" class="content-section">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Profil de {{ $user->name }}</h1>
                </div>

            

<!-- Infos personnelles -->
<div class="card shadow-sm mb-4 border-0">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title m-0 text-primary">
                <i class="fas fa-user-circle me-2"></i>Informations personnelles
            </h5>
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#editInfo">
                <i class="fas fa-edit me-1"></i>Modifier
            </button>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="p-3 bg-light rounded">
                    <p class="mb-1 text-muted small">Nom complet</p>
                    <p class="mb-0 fw-bold">{{ $user->name }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 bg-light rounded">
                    <p class="mb-1 text-muted small">Adresse email</p>
                    <p class="mb-0 fw-bold">{{ $user->email }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 bg-light rounded">
                    <p class="mb-1 text-muted small">Téléphone</p>
                    <p class="mb-0 fw-bold">{{ $user->phone ?? 'Non renseigné' }}</p>
                </div>
            </div>
        </div>

        <div class="collapse mt-3" id="editInfo">
            <div class="border-top pt-4">
                <form method="POST" action="{{ route('profil.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label text-muted small">Nom complet</label>
                            <input type="text" name="name" value="{{ $user->name }}" 
                                   class="form-control rounded-pill">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label text-muted small">Adresse email</label>
                            <input type="email" name="email" value="{{ $user->email }}" 
                                   class="form-control rounded-pill">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label text-muted small">Téléphone</label>
                            <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" 
       class="form-control" 
       pattern="(05|06|07)[0-9]{8}"
       title="Numéro algérien valide (ex: 0551234567)"
       placeholder="05 12 34 56 78">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <button type="button" class="btn btn-outline-secondary me-2 rounded-pill" 
                                data-bs-toggle="collapse" data-bs-target="#editInfo">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-save me-1"></i>Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</div>


   










<style>
    /* Style pour les cartes d'information */
.bg-light {
    background-color: #f8f9fa !important;
    transition: all 0.3s ease;
}

.bg-light:hover {
    background-color: #e9ecef !important;
}

/* Style pour les champs de formulaire */
.form-control.rounded-pill {
    padding: 0.5rem 1.2rem;
    border: 1px solid #dee2e6;
}

/* Style pour les boutons */
.btn-outline-primary {
    border-width: 1.5px;
}

/* Animation pour le collapse */
.collapse {
    transition: all 0.3s ease-out;
}
</style>



       <!-- Section Mes biens (cachée par défaut) -->
<div id="biens-section" class="content-section" style="display:none;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mes biens immobiliers</h1>
    </div>

    <!-- Barre de filtrage -->
    <div class="mb-4">
        <label for="filtre-type" class="form-label"><strong>Filtrer par type :</strong></label>
        <select id="filtre-type" class="form-select w-auto d-inline-block">
            <option value="all">Tous</option>
            <option value="achat">Achat</option>
            <option value="location">Location</option>
            <option value="echange">Échange</option>
        </select>
    </div>

    @if($biens->isEmpty())
        <div class="alert alert-info">Aucun bien enregistré pour le moment.</div>
    @else
        <div class="row">
            @foreach($biens as $bien)
                <div class="col-md-4 mb-4 bien-item" data-type="{{ strtolower($bien->type) }}">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset($bien->user_image) }}" class="card-img-top" alt="{{ $bien->adresse }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $bien->type }}</h5>
                            <p class="card-text">
                                <strong>Adresse:</strong> {{ $bien->adresse }}<br>
                                <strong>Prix:</strong> {{ number_format($bien->prix, 0, ',', ' ') }} DA<br>
                                <strong>Surface:</strong> {{ $bien->surface }} m²<br>
                           <strong>Id de bien:</strong> {{ $bien->id }} <br>
                           
                           
        @php
    $type = strtolower($bien->type);
    $url = '';

    if ($type === 'achat') {
        $url = url('/vente/detail/' . $bien->id);
    } elseif ($type === 'location') {
        $url = url('/louer/detail/' . $bien->id);
    } elseif ($type === 'echange') {
        $url = url('/echange/detail/' . $bien->id);
    }
@endphp

<strong>URL:</strong> 
<a href="{{ $url }}" target="_blank">{{ $url }}</a>

                            </p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('profil.biens.edit', $bien->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form method="POST" action="{{ route('profil.biens.destroy', $bien->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bien ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- JavaScript de filtrage -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('filtre-type');
        const items = document.querySelectorAll('.bien-item');

        select.addEventListener('change', function () {
            const selected = this.value;

            items.forEach(item => {
                const type = item.getAttribute('data-type');

                if (selected === 'all' || type === selected) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>


            <style>
    .card {
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e0e0;
        overflow: hidden;
        background-color: #ffffff;
    }
    
    .card-header {
        background-color: #2d3748;
        color: #f7fafc;
        border-radius: 8px 8px 0 0 !important;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .card-header h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
        color: #f7fafc;
    }
    
    .btn-back {
        background-color: #f7fafc;
        color: #2d3748;
        border: 1px solid #2d3748;
        border-radius: 6px;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background-color: #e2e8f0;
        transform: translateY(-2px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        color: #2d3748;
    }
    
    .btn-submit {
        background-color: #4a5568;
        color: white;
        border-radius: 6px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        letter-spacing: 0.5px;
    }
    
    .btn-submit:hover {
        background-color: #2d3748;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    }
    
    .form-group label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    .form-control {
        border-radius: 6px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s;
        background-color: #f8fafc;
    }
    
    .form-control:focus {
        border-color: #cbd5e0;
        box-shadow: 0 0 0 0.2rem rgba(74, 85, 104, 0.15);
        background-color: #ffffff;
    }
    
    .alert-danger {
        border-radius: 6px;
        background-color: rgba(229, 62, 62, 0.1);
        border: 1px solid #e53e3e;
        color: #e53e3e;
    }
    
    .form-section {
        padding: 1.75rem;
        background-color: #f8fafc;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border: 1px solid #edf2f7;
    }
    
    .form-section-title {
        color: #2d3748;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e2e8f0;
        font-size: 1.1rem;
    }
    
    .file-upload-wrapper {
        position: relative;
        margin-bottom: 1rem;
    }
    
    .file-upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2.5rem;
        border: 2px dashed #cbd5e0;
        border-radius: 8px;
        background-color:rgb(255, 255, 255);
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .file-upload-label:hover {
        border-color: #a0aec0;
        background-color: #f7fafc;
    }
    
    .file-upload-icon {
        font-size: 2.5rem;
        color: #718096;
        margin-bottom: 1.25rem;
    }
    
    .file-upload-text {
        color: #4a5568;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .file-upload-info {
        color: #718096;
        font-size: 0.875rem;
        margin-top: 0.75rem;
    }
    
    .card-body {
        background-color: #ffffff;
        padding: 2rem;
    }
    
    textarea.form-control {
        min-height: 120px;
    }


    
</style>
<!-- Section Ajouter un bien (modifiée) -->
<div id="ajouter-section"  class="content-section" style="display:none;">


    <div class="form-wrapper">
        <div class="form-container">
            <h2>Ajouter un nouveau bien</h2>
            <div class="mb-3 text-end">
                <a href="#" onclick="document.getElementById('ajouter-section').style.display='none'" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profil.storeBien') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label><strong>Adresse:</strong></label>
                        <input type="text" name="adresse" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label><strong>Type de bien:</strong></label>
                        <input type="text" name="type" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label><strong>Prix (DA):</strong></label>
                        <input type="number" name="prix" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label><strong>Surface (m²):</strong></label>
                        <input type="number" name="surface" class="form-control" required>
                    </div>

                    <div class="col-12 mb-2">
                        <label><strong>Description:</strong></label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label><strong>Image principale:</strong></label>
                        <input type="file" name="user_image" class="form-control" required>
                        <small class="form-text text-muted">Formats acceptés : JPG, PNG (Max 5MB)</small>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label><strong>Galerie d'images:</strong></label>
                        <input type="file" name="photos[]" class="form-control" multiple accept="image/*">
                        <small class="form-text text-muted">JPG, PNG (Max 5MB/image)</small>
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>Enregistrer le bien
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Arrière-plan de la page avec image */
    body {
        background: url('/images/background.jpg') no-repeat center center fixed;
        background-size: cover;
        
    }

   

    .form-container {
        background: url('/src/fi.jpg') no-repeat center center fixed;

        width: 100%;
        max-width: 850px;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 1rem;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .btn-success {
        padding: 10px 30px;
    }
</style>


    <div id="notification-section" class="content-section" style="display:none;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mes Notifications</h1>
        <div class="btn-group">
            <button class="btn btn-sm btn-outline-secondary" onclick="filterNotifications('all')">Toutes</button>
            <button class="btn btn-sm btn-outline-secondary" onclick="filterNotifications('accepted')">Acceptées</button>
            <button class="btn btn-sm btn-outline-secondary" onclick="filterNotifications('new')">Nouvelles</button>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Notifications récentes</h4>
                <span class="badge bg-primary" id="notification-count">{{ $notifications->where('read_at', null)->count() }}</span>
            </div>
            
            <div class="card-body" id="notifications-container">
                @if($notifications->isEmpty())
                    <div class="alert alert-info">Aucune notification pour le moment.</div>
                @else
                    <div class="list-group">
                        @foreach($notifications as $notif)
                            @php
                                $notificationData = is_array($notif->data) ? $notif->data : json_decode($notif->data, true);
                                $isAccepted = isset($notificationData['rdv_id']);
                                $isNewRequest = isset($notificationData['rendez_vous_id']);
                                $isUnread = is_null($notif->read_at);
                            @endphp
                            
                            <div class="list-group-item list-group-item-action flex-column align-items-start notification-item 
                                {{ $isAccepted ? 'notification-accepted' : 'notification-new' }} 
                                {{ $isUnread ? 'notification-unread' : '' }}"
                                data-notification-type="{{ $isAccepted ? 'accepted' : 'new' }}"
                                data-notification-id="{{ $notif->id }}"
                                onclick="markAsRead(this, '{{ $notif->id }}')">
                                
                                @if($isAccepted)
                                    <!-- Template pour RDV accepté -->
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 text-success">
                                            <i class="fas fa-check-circle me-2"></i>
                                            {{ $notificationData['message'] }}
                                        </h5>
                                        <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ $notificationData['url'] }}" class="btn btn-sm btn-outline-success mt-2" onclick="event.stopPropagation()">
                                            <i class="fas fa-calendar-alt me-1"></i> Voir le rendez-vous
                                        </a>
                                    </div>
                                
                                @elseif($isNewRequest)
                                    <!-- Template pour nouvelle demande -->
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 text-primary">
                                            <i class="fas fa-bell me-2"></i>
                                            {{ $notificationData['message'] }}
                                        </h5>
                                        <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="d-flex mt-3">
                                        @if(isset($notificationData['immobilier_photo']))
                                            <img src="{{ $notificationData['immobilier_photo'] }}" 
                                                 class="img-thumbnail me-3" 
                                                 style="width:80px;height:60px;object-fit:cover;"
                                                 onclick="event.stopPropagation()">
                                        @endif
                                        <div>
                                            <p><strong>Client:</strong> {{ $notificationData['nom_complet'] }}</p>
                                            <p><strong>Type:</strong> {{ ucfirst($notificationData['type']) }}</p>
                                            <a href="{{ $notificationData['link'] }}" class="btn btn-sm btn-outline-primary mt-1" onclick="event.stopPropagation()">
                                                <i class="fas fa-eye me-1"></i> Voir la demande
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .notification-item {
        margin-bottom: 10px;
        border-left-width: 4px;
        border-left-style: solid;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .notification-accepted {
        border-left-color: #28a745;
        background-color: rgba(40, 167, 69, 0.05);
    }
    
    .notification-new {
        border-left-color: #007bff;
        background-color: rgba(0, 123, 255, 0.05);
    }
    
    .notification-unread {
        background-color: rgba(0, 123, 255, 0.1);
        font-weight: 500;
    }
    
    .notification-item:hover {
        transform: translateX(5px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
</style>

<script>
    function filterNotifications(type) {
        const notifications = document.querySelectorAll('.notification-item');
        
        notifications.forEach(notif => {
            const notifType = notif.getAttribute('data-notification-type');
            
            if(type === 'all') {
                notif.style.display = 'block';
            } else {
                notif.style.display = notifType === type ? 'block' : 'none';
            }
        });
    }

    function markAsRead(element, notificationId) {
        // Si déjà marquée comme lue, ne rien faire
        if (!element.classList.contains('notification-unread')) return;
        
        // Envoyer la requête AJAX pour marquer comme lue
        fetch(`/notifications/${notificationId}/mark-as-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mettre à jour l'apparence
                element.classList.remove('notification-unread');
                
                // Mettre à jour le compteur
                const countElement = document.getElementById('notification-count');
                const currentCount = parseInt(countElement.textContent);
                if (currentCount > 0) {
                    countElement.textContent = currentCount - 1;
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
<style>
    .sidebar {
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);



    }
    
    .nav-link {
        color: #adb5bd;
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 5px;
        text-align: left;
        background: none;
        border: none;
        width: 100%;
    }
    
    
    
    .nav-link i {
        width: 20px;
        text-align: center;
    }
    
    .content-section {
        padding: 20px 0;
    }

    /* Styles pour les notifications */
.notification-item {
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.notification-item:hover {
    background-color: #f8f9fa;
    border-left-color: #0d6efd;
}

.notification-unread {
    background-color: #f0f7ff;
}

.notification-time {
    font-size: 0.8rem;
    color: #6c757d;
}

.notification-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
}
</style>

<script>
    function showSection(sectionId) {
        // Masquer toutes les sections
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });
        
        // Afficher la section sélectionnée
        document.getElementById(sectionId).style.display = 'block';
        
        // Mettre à jour l'état actif du menu
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
        event.currentTarget.classList.add('active');
    }
</script>
@endsection