<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Barre de navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #4e79a7 !important;
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .nav-link:hover {
            color: #4e79a7 !important;
            transform: translateY(-2px);
        }

        .nav-link.active {
            color: #4e79a7 !important;
            font-weight: 700;
        }

        /* Menu déroulant */
        .dropdown-menu {
            background: white;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Contenu principal */
        main {
            padding: 2rem;
        }

        .nav-icon {
    position: relative;
    display: inline-flex;
    align-items: center;
}

.notification-badge,
.pending-notification-chat {
    position: absolute;
    top: -8px;
    right: -8px;
    width: 20px;
    height: 20px;
    background-color: #ff4757;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    font-weight: bold;
    justify-content: center;
}

.nav-link {
    display: flex;
    align-items: center;
    position: relative;
}



.logo-navbar {
    height: 40px;         /* Hauteur du logo */
    width: auto;          /* Garde les proportions */
    max-height: 70px;     /* Limite pour éviter qu'il devienne trop grand */
    transition: transform 0.3s ease;
}

.logo-navbar:hover {
    transform: scale(1.05); /* Effet au survol (optionnel) */
}

    </style>
</head>

<body>
    <div id="app">
        <!-- Barre de navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
            <div class="container-fluid">
      <a class="navbar-brand" href="#">
    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-navbar">
</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end pe-5" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item me-4">
                            <a class="nav-link @if(Request::route()->getName() == 'app_accueil') active @endif"
                                aria-current="page" href="{{ route('app_accueil') }}">
                                <i class="fas fa-home"></i> Accueil
                            </a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link @if(Request::route()->getName() == 'app_acheter') active @endif"
                                href="{{ route('app_acheter') }}">
                                <i class="fas fa-shopping-cart"></i> Acheter
                            </a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link @if(Request::route()->getName() == 'app_louer') active @endif"
                                href="{{ route('app_louer') }}">
                                <i class="fas fa-hand-holding-usd"></i> Louer
                            </a>
                        </li>


                        <li class="nav-item me-4">
                            <a class="nav-link @if(Request::route()->getName() == 'app_echanger') active @endif"
                                href="{{ route('app_echanger') }}">
                                <i class="fas fa-hand-holding-usd"></i> Echanger
                            </a>
                        </li>





                        <!-- Lien "Profil" visible uniquement pour les utilisateurs connectés -->
                        @auth
                            <li class="nav-item me-4">
                                <a class="nav-link @if(Request::route()->getName() == 'app_historique') active @endif"
                                    href="{{ route('app_historique') }}">
                                    <i class="fas fa-user"></i> Historique
                                </a>
                            </li>



                            <li class="nav-item dropdown me-4">
    <a class="nav-link" href="#" id="notificationDropdown" role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i> Notification

        @if(Auth::user()->unreadNotifications->count() > 0)
            <span class="notification-badge" id="notificationCount">
                {{ Auth::user()->unreadNotifications->count() }}
            </span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="min-width: 300px;">
        @if(Auth::user()->unreadNotifications->count() > 0)
            @foreach(Auth::user()->unreadNotifications as $notification)
                <li class="dropdown-item">
                    <a href="#" class="notification-link" data-notification-id="{{ $notification->id }}"
                        data-url="{{ $notification->data['url'] ?? '#' }}">
                        {{ $notification->data['message'] ?? 'Vous avez une notification.' }}
                    </a>
                </li>
            @endforeach
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item" href="#" id="markAllAsRead">
                    Marquer toutes comme lues
                </a>
            </li>
        @else
            <li class="dropdown-item text-muted">Aucune notification.</li>
        @endif
    </ul>
</li>



                            <li class="nav-item">
    <a class="nav-link nav-icon" href="{{ route('messagerie') }}">
        <i class="fas fa-envelope"></i> Messagerie

        @if($unseenCounter > 0)
            <span class="notification-badge">{{ $unseenCounter }}</span>
        @endif
    </a>
</li>


                            <li class="nav-item">
                                <a class="nav-link @if(Request::route()->getName() == 'app_profil') active @endif"
                                    href="{{ route('app_profil') }}">
                                    <i class="fas fa-user"></i> Profil
                                </a>
                            </li>
                        @endauth

                        <!-- Lien "Se connecter" visible uniquement pour les utilisateurs non connectés -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i> Se connecter
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>



    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Activer le log Pusher (à désactiver en production)
    Pusher.logToConsole = true;

    // Initialiser Pusher
    var pusher = new Pusher('90772dc20eb20484a33c', {
        cluster: 'mt1'
    });

    // S'abonner au canal
    var channel = pusher.subscribe('my-channel');

    // Réagir à l'événement 'my-event'
    channel.bind('my-event', function(data) {
        $.ajax({
            type: 'GET',
            url: '/updateunseenmessage',
            success: function(data) {
                console.log(data.unseenCounter);

                var html = ``;

                if (data.unseenCounter > 0) {
                    html += <span style="right:68px;" class="pending-notification-chat">${data.unseenCounter}</span>;
                }

                $('.pending-div').html(html);
            },
            error: function(xhr, status, error) {
                console.error("Erreur AJAX :", error);
            }
        });
    });
</script>


<!-- chatttttttbooooooooot----- -->


<style>

    /* Bouton flottant */
    #open-chatbot-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #3d8adc;
        color: white;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 24px;
        cursor: pointer;
        z-index: 1000;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Fenêtre */
    #chatbot-popup {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 350px;
        height: 469px;
        background: rgba(255, 255, 255, 0.2); /* semi-transparent */
        backdrop-filter: blur(10px);          /* effet flou */
        -webkit-backdrop-filter: blur(10px);  /* pour Safari */
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        z-index: 9999;
        transform: translateY(100%);
        opacity: 0;
        pointer-events: none;
        transition: transform 0.4s ease, opacity 0.4s ease;
        border: 1px solid rgba(255, 255, 255, 0.3); /* effet verre */
    }

    #chatbot-popup.open {
        transform: translateY(0);
        opacity: 1;
        pointer-events: auto;
    }

    /* En-tête */
    #chatbot-popup-header {
        background-color: #f1f1f1;
        padding: 8px 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
    }

    .close-btn, .clear-btn {
        background: none;
        border: none;
        font-size: 16px;
        color: #666;
        cursor: pointer;
    }

    .close-btn:hover, .clear-btn:hover {
        color: #000;
    }

    /* Zone de chat */
    #chat-box {
        flex: 1;
        padding: 10px;
        overflow-y: auto;
        background-color: transparent; /* Garder le fond transparent pour voir l'effet flou */
    }

    .message {
        max-width: 80%;
        padding: 8px 12px;
        margin: 6px 0;
        border-radius: 16px;
        line-height: 1.4;
        clear: both;
        word-wrap: break-word;
    }

    .user {
        background-color: #85b6ea;
        color: white;
        margin-left: auto;
        text-align: right;
    }

    .bot {
        background-color: #e4e6eb;
        color: #000;
        margin-right: auto;
        text-align: left;
    }

    /* Saisie */
    #chat-input {
        display: flex;
        padding: 10px;
        border-top: 1px solid #ddd;
    }

    #chat-input input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 8px;
    }

    #chat-input button {
        margin-left: 8px;
        padding: 8px 12px;
        background-color: #7491af;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    #chat-input button:hover {
        background-color: #0056b3;
    }
</style>

<body>
<button id="open-chatbot-btn">🤖</button>

<div id="chatbot-popup">
    <div id="chatbot-popup-header">
        <span>💬 Chatbot</span>
        <div>
            <button class="clear-btn" id="clear-chatbot-btn" title="Effacer">🗑️</button>
            <button class="close-btn" id="close-chatbot-btn" title="Fermer">×</button>
        </div>
    </div>
    <div id="chat-box"></div>
    <div id="chat-input">
        <input type="text" id="user-input" placeholder="Écrivez ici...">
        <button onclick="sendMessage()">Envoyer</button>
    </div>
</div>

<script>
const openBtn = document.getElementById("open-chatbot-btn");
const closeBtn = document.getElementById("close-chatbot-btn");
const clearBtn = document.getElementById("clear-chatbot-btn");
const popup = document.getElementById("chatbot-popup");
const chatBox = document.getElementById("chat-box");
const userInput = document.getElementById("user-input");
// Permet d'envoyer le message en appuyant sur la touche "Entrée"
userInput.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        sendMessage();
    }
});

openBtn.addEventListener("click", () => {
    popup.classList.add("open");
});

closeBtn.addEventListener("click", () => {
    popup.classList.remove("open");
});

clearBtn.addEventListener("click", () => {
    localStorage.removeItem("chatHistory");
    chatBox.innerHTML = "";
    appendBotMessage("Bonjour ! Comment puis-je vous aider ? 😊");
});

function appendMessage(message, sender) {
    const div = document.createElement("div");
    div.className = `message ${sender}`;
    div.textContent = message;
    chatBox.appendChild(div);
    saveMessage({ sender, message });
    chatBox.scrollTop = chatBox.scrollHeight;
}

function appendUserMessage(msg) {
    appendMessage(msg, "user");
}

function appendBotMessage(msg) {
    appendMessage(msg, "bot");
}

function updateLastBotMessage(newText) {
    const messages = chatBox.querySelectorAll(".message.bot");
    if (messages.length > 0) {
        const lastMessage = messages[messages.length - 1];

        // Transforme les liens au format [texte](url) ou https://...
        const html = newText
            .replace(/\[(.*?)\]\((.*?)\)/g, '<a href="$2" target="_blank" style="color:#007bff;text-decoration:underline;">$1</a>')
            .replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" style="color:#007bff;text-decoration:underline;">$1</a>');

        lastMessage.innerHTML = html;

        // Mise à jour dans le localStorage
        let chatHistory = JSON.parse(localStorage.getItem("chatHistory")) || [];
        chatHistory[chatHistory.length - 1] = { sender: "bot", message: newText };
        localStorage.setItem("chatHistory", JSON.stringify(chatHistory));
    }
}


function saveMessage(entry) {
    let chatHistory = JSON.parse(localStorage.getItem("chatHistory")) || [];
    chatHistory.push(entry);
    localStorage.setItem("chatHistory", JSON.stringify(chatHistory));
}
async function sendMessage() {
    const message = userInput.value.trim();
    if (!message) return;

    appendUserMessage(message);
    appendBotMessage("..."); // loading

    userInput.value = "";

    // Vérification locale rapide pour mots-clés simples
    const lowerMessage = message.toLowerCase();
    // if (lowerMessage.includes("location") || lowerMessage.includes("louer")) {
//     updateLastBotMessage("Souhaitez-vous louer un bien ? Voici nos annonces de location : [accueil/louer?type=location]");
//     return;
// }

// if (lowerMessage.includes("achat") || lowerMessage.includes("acheter")) {
//     updateLastBotMessage("Vous cherchez à acheter ? Voici nos offres : [accueil/acheter?type=achat]");
//     return;
// }

// if (lowerMessage.includes("échange") || lowerMessage.includes("échanger")) {
//     updateLastBotMessage("Vous souhaitez faire un échange ? Voici les annonces disponibles : [Lien vers /annonces?type=echange]");
//     return;
// }


    // Sinon, on essaie d'appeler l'API backend Laravel pour récupérer les biens
    try {
        const apiResponse = await fetch('http://localhost:8000/api/chatbot/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ message }) // on envoie le message utilisateur dans le body
        });

        if (!apiResponse.ok) throw new Error("API backend error");

        const apiData = await apiResponse.json();

        // Si l'API backend retourne une réponse avec des biens recommandés
        if (apiData.response && !apiData.response.includes('❌ Aucun bien')) {
            updateLastBotMessage(apiData.response);
            return;
        }
    } catch (err) {
        console.warn("Erreur API backend immobilier:", err);
    }

    // Sinon, appel à OpenRouter comme avant
    try {
        const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
            method: 'POST',
            headers: {
                Authorization: 'Bearer {{ env("OPENROUTER_API_KEY") }}',
                'HTTP-Referer': 'http://localhost',
                'X-Title': 'WSPChat',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                model: 'deepseek/deepseek-chat',
                messages: [{ role: 'user', content: message }]
            })
        });

        const data = await response.json();
        const botText = data.choices?.[0]?.message?.content || "Je n’ai pas compris.";
        updateLastBotMessage(botText);
    } catch (e) {
        updateLastBotMessage("Erreur de communication avec le serveur.");
    }
}



window.addEventListener("DOMContentLoaded", () => {
    const history = JSON.parse(localStorage.getItem("chatHistory")) || [];
    if (history.length === 0) {
        appendBotMessage("Bonjour ! Comment puis-je vous aider ? 😊");
        popup.classList.add("open"); // Ouvre le chatbot automatiquement
    } else {
        history.forEach(entry => appendMessage(entry.message, entry.sender));
    }
});
</script>
</body>



</body>

</html>