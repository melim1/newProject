@extends('layouts.app')

@section('title', 'Historique de mes demandes')

@section('content')
<style>
  /* Boutons de sélection */
  .demande-tabs {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;
  }
  .demande-tabs button {
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    font-size: 1rem;
    cursor: pointer;
    background-color: #4e79a7;
    color: white;
    transition: background-color 0.3s ease, transform 0.3s ease;
  }
  .demande-tabs button:hover {
    background-color: #357ab7;
    transform: scale(1.05);
  }
  .demande-tabs button.active {
    background-color: #357ab7;
  }
  
  /* Sections de demandes */
  .demande-section {
    display: none;
  }
  .demande-section.active {
    display: block;
  }

  /* Cartes de demande */
  .demande-card {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .demande-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
  }
  .demande-card h5 {
    color: #4e79a7;
    margin-bottom: 1rem;
    font-size: 1.25rem;
    font-weight: 600;
  }
  .demande-card p {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #555;
  }
  .demande-card p strong {
    color: #333;
  }

  /* Statuts */
  .statut-valide { color: #28a745; }
  .statut-refuse { color: #dc3545; }

  /* Infos du bien associé */
  .maison-card {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1rem;
    margin-top: 1rem;
    display: flex;
    gap: 1rem;
  }
  .maison-card img {
    max-width: 200px;
    border-radius: 10px;
  }
  .maison-details p {
    margin-bottom: 0.5rem;
    font-size: 1rem;
    color: #555;
  }
  .maison-details p strong {
    color: #333;
  }
  
  /* Animation pour mettre en évidence un élément */
  .highlight {
    animation: highlightFade 3s ease-in-out;
    background-color: #fff3cd;
  }
  @keyframes highlightFade {
    from { background-color: #fff3cd; }
    to { background-color: transparent; }
  }



  /* Ajoutez ce style */
.statut-en_attente { 
  color: #ff9800; 
  font-weight: 500;
}
</style>



<div class="container mt-5">
  <!-- Boutons pour sélectionner le type de demande -->
  <div class="demande-tabs">
    <button id="vente-tab" class="active">Demandes de vente</button>
    <button id="location-tab">Demandes de location</button>
  </div>

  <!-- Section des demandes de vente -->
  <div id="vente-section" class="demande-section active">
    @if ($demandesVente->isEmpty())
      <p class="text-muted">Aucune demande de vente.</p>
    @else
      @foreach ($demandesVente as $demande)
        <div class="demande-card" id="rdv-vente-{{ $demande->id }}">
          <h5>Demande pour la maison située à : {{ $demande->immobilier->adresse }}</h5>
          <p><strong>Date de la demande:</strong> {{ $demande->created_at->format('d/m/Y H:i') }}</p>
          @if($demande->statut === 'validé')
            <p class="statut-valide">
              <strong>Statut :</strong> Rendez-vous accepté<br>
              <strong>Date de visite :</strong> {{ \Carbon\Carbon::parse($demande->date_visite)->format('d/m/Y') }}<br>
              <strong>Heure :</strong> {{ $demande->heure_visite }}
            </p>
          @elseif($demande->statut === 'refusé')
            <p class="statut-refuse">
              <strong>Statut :</strong> Rendez-vous refusé
            </p>
          @else
            <p><strong>Statut :</strong> {{ $demande->statut }}</p>
          @endif
          <p><strong>Message :</strong> {{ $demande->message ?? 'Aucun message' }}</p>
          <!-- Infos du bien associé -->
          <div class="maison-card">
            <img src="{{ asset($demande->immobilier->user_image) }}" alt="Photo du bien">
            <div class="maison-details">
              <p><strong>Adresse :</strong> {{ $demande->immobilier->adresse }}</p>
              <p><strong>Prix :</strong> {{ $demande->immobilier->prix }} DA</p>
              <p><strong>Surface :</strong> {{ $demande->immobilier->surface }} m²</p>
              <p><strong>Description :</strong> {{ $demande->immobilier->description }}</p>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>

  <!-- Section des demandes de location -->
  <div id="location-section" class="demande-section">
    @if ($demandesLocation->isEmpty())
      <p class="text-muted">Aucune demande de location.</p>
    @else
      @foreach ($demandesLocation as $demande)
        <div class="demande-card" id="rdv-location-{{ $demande->id }}">
          <h5>Demande pour la maison située à : {{ $demande->immobilier->adresse }}</h5>
          <p><strong>Date de la demande:</strong> {{ $demande->created_at->format('d/m/Y H:i') }}</p>
          @if($demande->statut === 'validé')
            <p class="statut-valide">
              <strong>Statut :</strong> Rendez-vous accepté<br>
              <strong>Date de visite :</strong> {{ \Carbon\Carbon::parse($demande->date_visite)->format('d/m/Y') }}<br>
              <strong>Heure :</strong> {{ $demande->heure_visite }}
            </p>
          @elseif($demande->statut === 'refusé')
            <p class="statut-refuse">
              <strong>Statut :</strong> Rendez-vous refusé
            </p>
          @else
            <p><strong>Statut :</strong> {{ $demande->statut }}</p>
          @endif
          <p><strong>Message :</strong> {{ $demande->message ?? 'Aucun message' }}</p>
          <!-- Infos du bien associé -->
          <div class="maison-card">
            <img src="{{ asset($demande->immobilier->user_image) }}" alt="Photo du bien">
            <div class="maison-details">
              <p><strong>Adresse :</strong> {{ $demande->immobilier->adresse }}</p>
              <p><strong>Prix :</strong> {{ $demande->immobilier->prix }} DA</p>
              <p><strong>Surface :</strong> {{ $demande->immobilier->surface }} m²</p>
              <p><strong>Description :</strong> {{ $demande->immobilier->description }}</p>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
</div>




<footer class="bg-white text-white pt-5">
    <div class="container">
        <div class="row g-4">
            <!-- Colonne À propos -->
            <div class="col-lg-4 col-md-6">
                <div class="pe-lg-4">
                    <h3 class="h4 mb-4 text-primary">Agence immobilière</h3>
                    <p class="text-muted">
                        Votre partenaire de confiance pour trouver le bien idéal. 
                        Nous vous accompagnons dans tous vos projets immobiliers 
                        avec expertise et professionnalisme.
                    </p>
                    <div class="mt-4">
                        <a href="tel:+123456789" class="text-bleu text-decoration-none d-block mb-2">
                            <i class="fas fa-phone-alt me-2"></i> +123 456 789
                        </a>
                        <a href="mailto:contact@agence.com" class="text-blue text-decoration-none d-block">
                            <i class="fas fa-envelope me-2"></i> contact@agence.com
                        </a>
                    </div>
                </div>
            </div>

            <!-- Colonne Liens rapides -->
            <div class="col-lg-4 col-md-6">
                <h5 class="h6 mb-4 text-primary">Navigation</h5>
                <div class="d-flex flex-column">
                    <a class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary 
                        @if(Request::route()->getName() == 'app_accueil') active text-primary @endif" 
                        href="{{ route('app_accueil') }}">
                        <i class="fas fa-home me-2"></i> Accueil
                    </a>
                    <a class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary
                        @if(Request::route()->getName() == 'app_acheter') active text-primary @endif" 
                        href="{{ route('app_acheter') }}">
                        <i class="fas fa-euro-sign me-2"></i> Acheter
                    </a>
                    <a class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary
                        @if(Request::route()->getName() == 'app_louer') active text-primary @endif" 
                        href="{{ route('app_louer') }}">
                        <i class="fas fa-key me-2"></i> Louer
                    </a>
                    <a class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary
                        @if(Request::route()->getName() == 'app_about') active text-primary @endif" 
                        href="{{ route('app_about') }}">
                        <i class="fas fa-info-circle me-2"></i> À propos
                    </a>
                    <a class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary
                        @if(Request::route()->getName() == 'app_connexion') active text-primary @endif" 
                        href="{{ route('app_connexion') }}">
                        <i class="fas fa-sign-in-alt me-2"></i> Connexion
                    </a>
                    <a class="text-blue-50 text-decoration-none py-1 hover-text-primary
                        @if(Request::route()->getName() == 'app_inscription') active text-primary @endif" 
                        href="{{ route('app_inscription') }}">
                        <i class="fas fa-user-plus me-2"></i> Inscription
                    </a>
                </div>
            </div>

            <!-- Colonne Réseaux sociaux -->
            <div class="col-lg-4 col-md-6">
                <h5 class="h6 mb-4 text-primary">Nous suivre</h5>
                <div class="d-flex flex-column mb-4">
                    <a href="#" class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary">
                        <i class="fab fa-twitter me-2"></i> Twitter
                    </a>
                    <a href="#" class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary">
                        <i class="fab fa-facebook-f me-2"></i> Facebook
                    </a>
                    <a href="#" class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary">
                        <i class="fab fa-instagram me-2"></i> Instagram
                    </a>
                    <a href="#" class="text-blue-50 text-decoration-none py-1 hover-text-primary">
                        <i class="fab fa-linkedin-in me-2"></i> LinkedIn
                    </a>
                </div>
                
              
            </div>
        </div>
        
        <hr class="my-4 bg-gray-700">
        
        <div class="text-center py-3">
            <p class="mb-0 text-blue-50 small">
                &copy; {{ date('Y') }} Agence immobilière - Tous droits réservés
                <span class="mx-2">|</span>
                <a href="#" class="text-blue-50 text-decoration-none hover-text-primary">Mentions légales</a>
                <span class="mx-2">|</span>
                <a href="#" class="text-blue-50 text-decoration-none hover-text-primary">Politique de confidentialité</a>
            </p>
        </div>
    </div>
</footer>

<style>
    .hover-text-primary:hover {
        color:rgb(23, 58, 96) !important;
        transform: translateX(5px);
        transition: all 0.3s ease;
    }
    
    .bg-gray-800 {
        background-color:rgb(192, 208, 236);
    }
    
    footer a.active {
        color: #4e79a7 !important;
        font-weight: 600;
    }
    
    footer .text-primary {
        color: #4e79a7 !important;
    }
</style>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Gestion des onglets
    const venteTab = document.getElementById('vente-tab');
    const locationTab = document.getElementById('location-tab');
    const venteSection = document.getElementById('vente-section');
    const locationSection = document.getElementById('location-section');

    venteTab.addEventListener('click', function() {
      venteTab.classList.add('active');
      locationTab.classList.remove('active');
      venteSection.classList.add('active');
      locationSection.classList.remove('active');
    });

    locationTab.addEventListener('click', function() {
      locationTab.classList.add('active');
      venteTab.classList.remove('active');
      locationSection.classList.add('active');
      venteSection.classList.remove('active');
    });

    // Mise à jour du compteur de notifications
    function updateNotificationCount() {
      fetch("{{ route('notifications.count') }}")
        .then(response => response.json())
        .then(data => {
          const notificationCount = document.getElementById('notificationCount');
          if (notificationCount) {
            notificationCount.textContent = data.count;
          }
        })
        .catch(error => console.error('Erreur lors de la récupération des notifications:', error));
    }
    updateNotificationCount();
    setInterval(updateNotificationCount, 60000);

    // Gestion du marquage des notifications comme lues
    const markAllLink = document.getElementById('markAllAsRead');
    if (markAllLink) {
      markAllLink.addEventListener('click', function(e) {
        e.preventDefault();
        fetch("{{ route('notifications.markAsRead') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => {
          if (response.ok) {
            updateNotificationCount();
            location.reload();
          }
        })
        .catch(error => console.error('Erreur lors du marquage des notifications:', error));
      });
    }

    // Si un paramètre "rdv" est présent dans l'URL, défile jusqu'à l'élément correspondant
   // If a parameter "rdv" is present in the URL, switch to the appropriate tab and highlight the element
const params = new URLSearchParams(window.location.search);
const rdvId = params.get('rdv');
const rdvType = params.get('rdv_type'); // "vente" or "location"
if (rdvId && rdvType) {
  // Activate the correct tab based on rdv_type
  if (rdvType === 'location') {
    locationTab.click(); // This programmatically clicks the location tab
  } else {
    venteTab.click(); // Default to vente tab if not specified
  }

  // Wait a brief moment for the tab content to load before scrolling
  setTimeout(() => {
    const element = document.getElementById('rdv-' + rdvType + '-' + rdvId);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth', block: 'start' });
      element.classList.add('highlight');
      setTimeout(() => {
        element.classList.remove('highlight');
      }, 3000);
    }
  }, 100); // Short delay to ensure tab content is visible
}
  });




// Gestion du marquage individuel
document.querySelectorAll('.notification-link').forEach(link => {
  link.addEventListener('click', async function(e) {
    e.preventDefault();
    const notificationId = this.dataset.notificationId;
    const url = this.dataset.url;

    // Marquer comme lu
    await fetch(`/notifications/${notificationId}/markAsRead`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Content-Type': 'application/json'
      }
    });

    // Supprimer visuellement la notification
    this.closest('li').remove();
    updateNotificationCount();

    // Redirection après un court délai
    setTimeout(() => {
      window.location.href = url;
    }, 300);
  });
});

// Marquage global
document.getElementById('markAllAsRead').addEventListener('click', async function(e) {
  e.preventDefault();
  
  await fetch("{{ route('notifications.markAsRead') }}", {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Content-Type': 'application/json'
    }
  });

  // Supprimer toutes les notifications visuellement
  document.querySelectorAll('.notification-link').forEach(link => {
    link.closest('li').remove();
  });
  
  updateNotificationCount();
});

// Fonction de mise à jour du compteur
function updateNotificationCount() {
  const countElement = document.getElementById('notificationCount');
  const currentCount = parseInt(countElement.textContent) || 0;
  const newCount = Math.max(currentCount - 1, 0);
  
  if (newCount > 0) {
    countElement.textContent = newCount;
  } else {
    countElement.remove();
    document.querySelector('.dropdown-menu').innerHTML = '<li class="dropdown-item text-muted">Aucune notification.</li>';
  }
}

</script>
@endsection
