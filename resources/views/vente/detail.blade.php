<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <!-- CSRF Token pour AJAX -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Liens externes -->
  <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/emoji-picker-element@1.12.0/dist/emoji-picker-element.min.css">
  <style>
    /* Styles généraux */
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
      color: #333;
      margin: 0;
      padding: 0;
    }
    .container {
      display: flex;
  gap: 2rem;
  padding: 2rem;
  align-items: flex-start; /* Aligner en haut */

    }
    /* Carte immobilière */
    .card {
      border: none;
      border-radius: 5px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background-color:white;
      backdrop-filter: blur(10px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      width: 60%;
      margin: 0;
      flex-shrink: 0;
      
    }
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
    }
    .card-body { padding: 0.5rem; }
    .card-img-container { text-align: center; }
    .card img {
      width: 90%;
      height: 490px;
      object-fit: cover;
      border-radius: 10px;
      transition: transform 0.3s ease;
    }
    .card img:hover { transform: scale(1.05); }
    .card-info { margin-top: 0.7rem; }
    .caracteristiques-title {
      font-size: 1rem;
      font-weight: 600;
      color: #4e79a7;
      text-align: center;
      margin-bottom: 1rem;
      border-bottom: 2px solid #4e79a7;
      padding-bottom: 0.3rem;
    }
    .price-surface {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }
    .description { text-align: center; margin-top: 0.3rem; }
    .card-text { font-size: 0.8rem; color: #555; margin-bottom: 1rem; }
    .card-text strong { color: #333; }
    /* Boutons */
    .card-buttons {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 1rem;
      margin-top: 2rem;
    }
    .btn-primary {
      background-color: #4e79a7;
      border: none;
      border-radius: 20px;
      padding: 4px 5px;
      font-size: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #357ab7;
      transform: scale(1.05);
    }
    /* Mode plein écran */
    .fullscreen-mode {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      z-index: 1000;
      background: rgba(0, 0, 0, 0.9);
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .fullscreen-mode img {
      width: 90%; height: 90%;
      object-fit: contain;
      border-radius: 15px;
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
    }
    .fullscreen-mode .btn-3d { display: none; }
    .fullscreen-mode .btn-cancel {
      display: block;
      position: absolute;
      top: 20px;
      right: 20px;
    }
    .btn-cancel {
      display: none;
      background-color: #ff4757;
      border: none;
      border-radius: 30px;
      padding: 10px 20px;
      font-size: 1rem;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .btn-cancel:hover {
      background-color: #ff6b81;
      transform: scale(1.05);
    }
    /* Modal pour RDV */
    #overlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 70%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1000;
    }
    .modal {
      display: none;
      position: fixed;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      z-index: 1001;
      width: 400px;
      max-width: 60%;
      /* Supprimez height si non nécessaire pour un centrage optimal */
    }
    .modal input, .modal textarea {
      width: 100%;
  padding: 12px 15px;
  margin-bottom: 1.2rem;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  font-size: 0.95rem;
  transition: all 0.3s ease;
  background-color: #f8fafc;
    }


    .modal input:focus, .modal textarea :focus{
      outline: none;
  border-color: #4e79a7;
  box-shadow: 0 0 0 3px rgba(78, 121, 167, 0.1);
  background-color: white;
}




    .form-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
      gap:1rem;
    }
    #rdv-form .form-buttons button {
      flex: 1;
  padding: 12px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;

      
    }
    #rdv-form .form-buttons button[type="submit"] { background-color: #4e79a7; color: white;border: none; }
    #rdv-form .form-buttons button[type="button"] { background-color: #ff4757; color: white;border: none; }
    
    #rdv-form .form-buttons button[type="submit"]:hover{
      background-color: #3c6a9a;
  transform: translateY(-1px);
    }
    
    #rdv-form .form-buttons button[type="button"]:hover{
      background-color: white;
      background-color:rgb(146, 68, 75);
      border-color: #ff4757;
    }
    
    /* Section des commentaires */
    .comments-section {
      width: 40%;
      position: sticky;
  top: 20px; /* Rester visible au scroll */
  height: 86vh ; /* Hauteur de l'écran moins le padding */
  overflow-y: auto;
  padding: 1rem;
  background: white;
  border-radius: 12px;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);

}
    .comments-section h2 {
      font-size: 1.25rem;
      font-weight: 700;
      color: #4e79a7;
      margin-bottom: 1.5rem;
      text-align: center;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
  
    .comment-form {
      margin-bottom: 1rem;
      text-align: center;
    }
    .comment-form textarea {
  width: 100%;
  padding: 8px 12px; /* Réduit le padding */
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  margin-bottom: 1rem;
  font-size: 0.85rem; /* Taille de police légèrement réduite */
  background-color: #f8fafc;
  transition: all 0.3s ease;
  min-height: 80px; /* Hauteur minimale réduite */
  max-height: 120px; /* Hauteur maximale si nécessaire */
  line-height: 1.4; /* Interligne ajusté */
  transform: scale(0.98);
  transition: all 0.2s ease;
}
    .comment-form textarea:focus { outline: none; border-color: #4e79a7; box-shadow: 0 0 0 3px rgba(78, 121, 167, 0.1);
      background-color: white;
      transform: scale(1);
      padding: 8px 12px; }

   
    .comment-form button[type="submit"] {
   background-color: #4e79a7;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease; }
    .comment-form button[type="submit"]:hover { background-color: #357ab7;  transform: translateY(-1px);}
    .comment-list { display: grid; gap: 1rem; }
    .comment {
  background: #f8fafc;
  border-radius: 10px;
  padding: 1.25rem;
  margin-bottom: 1rem;
  border: 1px solid #e2e8f0;
  transition: all 0.3s ease;
}

.comment:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}
.comment-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.75rem;
}

.comment-author {
  font-weight: 600;
  color:rgb(32, 72, 140);
  font-size: 0.95rem;
}

.comment-date {
  font-size: 0.85rem;
  color: #718096;
}

.comment-content {
  color: #4a5568;
  line-height: 1.5;
  font-size: 0.95rem;
}
    /* Dropdown menu pour actions sur commentaire */
    .comment-menu-container {
      position: relative;
      display: inline-block;
    }
    .comment-menu-button {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1rem;
      color: #4e79a7;
    }
    .comment-menu-options {
  display: none;
  position: absolute;
  right: 0;
  top: 100%;
  background: white;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  z-index: 10;
  min-width: 120px;
  overflow: hidden;
}

.comment-menu-options button {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  width: 100%;
  border: none;
  background: none;
  padding: 0.75rem 1rem;
  text-align: left;
  cursor: pointer;
  transition: all 0.2s ease;
  font-size: 0.9rem;
  color: #4a5568;
}

.comment-menu-options button i {
  width: 16px;
  text-align: center;
}

.comment-menu-options button:hover { 
  background: #f8fafc;
  color: #4e79a7;
}

.comment-menu-options button.delete-comment:hover {
  color: #ff4757;
}

/* Formulaire de modification amélioré */
.edit-comment-form {
  display: none;
  margin-top: 1rem;
  padding: 1rem;
  background: #f8fafc;
  border-radius: 8px;
  border: 1px solid #e2e8f0;
  animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.edit-comment-form textarea {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  font-family: 'Nunito', sans-serif;
  font-size: 0.95rem;
  resize: vertical;
  min-height: 100px;
  background: white;
  transition: all 0.3s ease;
  box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
}

.edit-comment-form textarea:focus { 
  outline: none; 
  border-color: #4e79a7;
  box-shadow: 0 0 0 3px rgba(78, 121, 167, 0.1);
}

.edit-comment-form .form-actions {
  display: flex;
  gap: 0.5rem;
  margin-top: 0.75rem;
}

.edit-comment-form button[type="submit"] {
  background-color: #4e79a7;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 0.5rem 1rem;
  font-size: 0.9rem;
  cursor: pointer;
  transition: all 0.3s ease;
  flex: 1;
}

.edit-comment-form button[type="submit"]:hover { 
  background-color: #3c6a9a;
  transform: translateY(-1px);
}

.edit-comment-form .cancel-edit {
  background-color: white;
  color: #4e79a7;
  border: 1px solid #e2e8f0;
  padding: 0.5rem 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
  border-radius: 6px;
  flex: 1;
}

.edit-comment-form .cancel-edit:hover { 
  background-color: #f1f5f9;
  border-color: #cbd5e1;
}
    .message {
      margin: 1rem 0;
      padding: 0.75rem;
      border-radius: 8px;
      font-size: 0.9rem;
      text-align: center;
    }
    .message.success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    .message.error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Carte immobilière -->
    <div class="card" id="card">
      <div class="card-body">
        <div class="card-img-container">
          <img src="{{ asset($immobilier->user_image) }}" class="img-fluid" alt="Image du bien">
        </div>
        <div class="card-info">
          <div class="caracteristiques-title">Caractéristiques</div>
          <div class="price-surface">
            <p class="card-text"><i class="fas fa-tag"></i> <strong>Prix :</strong> {{ $immobilier->prix }} DA</p>
            <p class="card-text"><i class="fas fa-ruler-combined"></i> <strong>Surface :</strong> {{ $immobilier->surface }} m²</p>
          </div>
          <div class="description">
            <p class="card-text"><i class="fas fa-info-circle"></i> <strong>Description :</strong> {{ $immobilier->description }}</p>
          </div>
        </div>
      </div>
      <div class="card-buttons">
     
      <a href="{{ route('3Dshow', ['id' => $immobilier->id]) }}" class="btn btn-primary">
    <i class="fas fa-vr-cardboard"></i> Visite 3D
</a>

    
      <a href="{{ route('app_acheter') }}" class="btn btn-primary">Retour à la liste</a>
        <button id="btn-rdv" class="btn btn-primary">Demander un rendez-vous</button>
      </div>
      <div id="overlay"></div>
      <!-- Formulaire de rendez-vous -->
      <div id="rdv-form" class="modal">
        <form id="rdv-form-submit" action="{{ route('rendez-vous.store') }}" method="POST">
          @csrf
          <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">
          <input type="hidden" name="type" value="vente">
          <div>
            <label for="nom_complet">Nom complet:</label>
            <input type="text" name="nom_complet" required>
          </div>
          <div>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
          </div>
          <div>
            <label for="telephone">Téléphone:</label>
            <input type="text" name="telephone" required>
          </div>
          <div>
            <label for="message">Message (optionnel):</label>
            <textarea name="message"></textarea>
          </div>
          <!-- Zone pour afficher les messages -->
          <div id="rdv-message" class="message"></div>
          <div class="form-buttons">
            <button type="submit">Envoyer</button>
            <button type="button" id="btn-cancel-rdv">Annuler</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Section des commentaires -->
    <div class="comments-section">
      <h2>Commentaires</h2>
      <div class="comment-form">
        <form action="{{ route('comment.store') }}" method="POST">
          @csrf
          <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">
          <textarea name="content" rows="4" placeholder="Ajouter un commentaire..." required></textarea>
          <emoji-picker class="emoji-picker"></emoji-picker>
          <button type="submit">Publier</button>
        </form>
      </div>
      <div class="comment-list">
        @foreach ($immobilier->comments as $comment)
          <div class="comment" id="comment-{{ $comment->id }}">
            <div class="comment-header">
              <span class="comment-author">{{ $comment->user->name }}</span>
              <span class="comment-date">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
              @if (auth()->check() && auth()->user()->id === $comment->user_id)
                <div class="comment-menu-container">
                  <button class="comment-menu-button" onclick="toggleCommentMenu({{ $comment->id }})">
                    <i class="fas fa-ellipsis-v"></i>
                  </button>
                  <div class="comment-menu-options" id="menu-options-{{ $comment->id }}">
                    <button class="edit-comment" data-comment-id="{{ $comment->id }}">Modifier</button>
                    <button class="delete-comment" data-comment-id="{{ $comment->id }}">Supprimer</button>
                  </div>
                </div>
              @endif
            </div>
            <div class="comment-content">
              {{ $comment->content }}
            </div>
            @if (auth()->check() && auth()->user()->id === $comment->user_id)
              <div class="edit-comment-form" id="edit-form-{{ $comment->id }}">
                <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <textarea name="content" rows="4" required>{{ $comment->content }}</textarea>
                  <button type="submit">Enregistrer</button>
                  <button type="button" class="cancel-edit">Annuler</button>
                </form>
              </div>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Fonction pour basculer le menu des actions sur un commentaire
      function toggleCommentMenu(id) {
        const menu = document.getElementById('menu-options-' + id);
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
      }
      window.toggleCommentMenu = toggleCommentMenu; // Accessible via onclick

      // Fermer le menu si clic en dehors
      document.addEventListener('click', function(e) {
        const menus = document.querySelectorAll('.comment-menu-options');
        menus.forEach(menu => {
          if (!menu.contains(e.target) && !e.target.closest('.comment-menu-button')) {
            menu.style.display = 'none';
          }
        });
      });

     

      // Gestion de la modification des commentaires
      document.querySelectorAll('.edit-comment').forEach(button => {
        button.addEventListener('click', () => {
          const commentId = button.getAttribute('data-comment-id');
          const editForm = document.getElementById(`edit-form-${commentId}`);
          editForm.style.display = 'block';
        });
      });
      // Annuler la modification
      document.querySelectorAll('.cancel-edit').forEach(button => {
        button.addEventListener('click', () => {
          const commentId = button.closest('.edit-comment-form').id.replace('edit-form-', '');
          const editForm = document.getElementById(`edit-form-${commentId}`);
          editForm.style.display = 'none';
        });
      });
      // Gestion de la suppression des commentaires (AJAX)
      document.querySelectorAll('.delete-comment').forEach(button => {
        button.addEventListener('click', () => {
          const commentId = button.getAttribute('data-comment-id');
          if (confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')) {
            fetch(`/comment/${commentId}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
              },
            })
            .then(response => {
              if (!response.ok) throw new Error('Erreur réseau');
              return response.json();
            })
            .then(data => {
              if (data.success) {
                document.getElementById(`comment-${commentId}`).remove();
              } else {
                alert("Une erreur s'est produite lors de la suppression.");
              }
            })
            .catch(error => console.error('Erreur:', error));
          }
        });
      });

      

      const rdvForm = document.getElementById('rdv-form-submit');
const rdvMessage = document.getElementById('rdv-message');

rdvForm.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(rdvForm);

  fetch(rdvForm.action, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: formData,
  })
  .then(response => response.ok ? response.json() : Promise.reject('Erreur réseau'))
  .then(data => {
    if (data.success) {
      rdvMessage.textContent = data.message || "Votre demande a été envoyée avec succès.";
      rdvMessage.className = "message success";

       // Vider le formulaire et masquer le modal après 2 secondes
       setTimeout(() => {
        rdvForm.reset(); // Vider le formulaire
        rdvMessage.textContent = "";
        rdvMessage.className = "message";
        document.getElementById('overlay').style.display = 'none';
        document.getElementById('rdv-form').style.display = 'none';
      }, 2000);
    } else {
      rdvMessage.textContent = data.message || "Une erreur s'est produite lors de l'envoi.";
      rdvMessage.className = "message error";
    }
  })
  .catch(error => {
    console.error('Erreur:', error);
    rdvMessage.textContent = "Une erreur réseau s'est produite. Veuillez réessayer.";
    rdvMessage.className = "message error";
  });
});







      // Afficher le modal de rendez-vous
      const btnRdv = document.getElementById('btn-rdv');
      const overlay = document.getElementById('overlay');
      const rdvModal = document.getElementById('rdv-form');
      btnRdv.addEventListener('click', () => {
        overlay.style.display = 'block';
        rdvModal.style.display = 'block';
      });
      // Masquer le modal de rendez-vous et l'overlay
      document.getElementById('btn-cancel-rdv').addEventListener('click', () => {
        overlay.style.display = 'none';
        rdvModal.style.display = 'none';
      });
      overlay.addEventListener('click', () => {
        overlay.style.display = 'none';
        rdvModal.style.display = 'none';
      });
    });
  </script>
</body>
</html>
