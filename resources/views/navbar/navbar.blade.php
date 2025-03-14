

<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end pe-5" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item me-4">
            <a class="nav-link @if(Request::route()->getName() == 'app_accueil') active @endif" aria-current="page" href="{{ route('app_accueil') }}">Accueil</a>
          </li>
          <li class="nav-item me-4">
            <a class="nav-link  @if(Request::route()->getName() == 'app_acheter') active @endif" href="{{  route('app_acheter') }}">Acheter</a>
          </li>
          <li class="nav-item me-4">
            <a class="nav-link @if(Request::route()->getName() == 'app_louer') active @endif" href="{{  route('app_louer') }}">Louer</a>
          </li>
          <li class="nav-item me-4">
            <a class="nav-link @if(Request::route()->getName() == 'app_about') active @endif" href="{{ route('app_about') }}">À propos</a>
          </li>
          <li class="nav-item me-1">
            <a class="nav-link @if(Request::route()->getName() == 'app_connexion') active @endif" href="{{  route('app_connexion') }}">Connexion</a>
          </li>
          <li class="nav-item me-1">
            <a class="nav-link @if(Request::route()->getName() == 'app_inscription') active @endif" href="{{  route('app_inscription') }}">Inscription</a>
          </li>
          <li class="nav-item me-1">
            <a class="nav-link @if(Request::route()->getName() == 'app_profil') active @endif" href="{{  route('app_profil') }}">Profil</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>


