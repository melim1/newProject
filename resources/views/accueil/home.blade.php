@extends('layouts/app')
@section('title', 'Accueil')

@section('content')

<main ">

    <!-- caroussel-->

            <div class="swiper swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('images/immg4.jpg') }}" class="w-100 d-block carousel-img" />
                         <div class="dark-overlay"></div>
                         <div class="position-absolute top-50 start-50 translate-middle text-white z-2 text-center">
    <h1>Bienvenue</h1>
    <p>Découvrez une sélection exclusive de biens d’exception à vendre ou à louer, adaptés à vos besoins et à votre style de vie</p>
  </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/immg2.jpg') }}" class="w-100 d-block carousel-img" />
                        <div class="dark-overlay"></div>
                        <div class="position-absolute top-50 start-50 translate-middle text-white z-2 text-center">
    <h1>Bienvenue</h1>
    <p>Nous vous accompagnons dans chaque étape de votre projet immobilier, avec expertise, transparence et engagement.</p>
  </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/immg1.jpg') }}" class="w-100 d-block carousel-img" />
                        <div class="dark-overlay"></div>
                        <div class="position-absolute top-50 start-50 translate-middle text-white z-2 text-center">
    <h1>Bienvenue</h1>
    <p>Trouvez la maison ou l’appartement idéal grâce à notre réseau de partenaires et notre parfaite connaissance du marché local</p>
  </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/immg5.jpg') }}" class="w-100 d-block carousel-img" />
                        <div class="dark-overlay"></div>
                        <div class="position-absolute top-50 start-50 translate-middle text-white z-2 text-center">
    <h1>Bienvenue</h1>
    <p>Que vous soyez acheteur, investisseur ou locataire, notre objectif est de concrétiser votre projet dans les meilleures conditions.</p>
  </div>
                    </div>
                </div>
            </div>


        <!-- barre de recherche-->



        <div class="container availability-form">
            <div class="row justify-content-center ">
                <div class="col-lg-10 bg-white shadow p-4 rounded">


                    <form class="searchForm" action="{{ route('app_accueil') }}" method="GET">
                        <div class="row align-items-end justify-content-center ">





                           <!-- Type de bien (location/achat) -->
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Type de bien</label>
                        <select name="type" class="form-select">
                            <option value="">Tous</option>
                            <option value="location">Location</option>
                            <option value="achat">Achat</option>
                        </select>
                    </div>

                            <div class="col-lg-3 mb-3">
                                <label class="form-label" style="font-weight: 500;">Budget max</label>
                                <input type="number" name="budget" class="form-control">
                            </div>

                            <div class="col-lg-3 mb-3">
                                <label class="form-label" style="font-weight: 500;">Où cherchez vous ?</label>
                                <input type="text" name="adresse" class="form-control">
                            </div>

                            <div class="col-lg-3 mb-lg-3 mt-2">
                                <button type="submit" class="btn text-white shadow-none custom-bg  w-100">Rechercher</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>



<!-- Section des résultats de recherche -->
<!-- Section de résultats de recherche -->
@if($searchPerformed)
    <div class="container mt-5">
        <h3 class="text-center fw-bold">Résultats de la recherche</h3>

        @if ($immobiliers->count() > 0)
            <div class="row">
                @foreach($immobiliers as $immobilier)
                    <div class="col-md-4 mb-4">
                       <div class="card equal-height-card">

                            <img src="{{ asset($immobilier->user_image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $immobilier->type }} - {{ $immobilier->adresse }}</h5>
                                <p class="card-text">{{ Str::limit($immobilier->description, 100) }}</p>
                                <p class="text-primary fw-bold">{{ number_format($immobilier->prix, 0, ',', ' ') }} €</p>




                            <!-- Boutons "Voir en détail" et "Prendre RDV" -->
                        <div class="card-buttons">
                            <a href="{{ route('vente.detail', ['id' => $immobilier->id]) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Voir en détail
                            </a>

                        </div>



                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination des résultats -->
            <div class="col-lg-12 text-center mt-4">
                {{ $immobiliers->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="alert alert-warning mt-4 text-center">
                Aucun résultat trouvé pour votre recherche.
            </div>
        @endif

        <!-- Suggestions similaires -->
        @if($suggestions->isNotEmpty())
            <h3 class="mt-5 text-center fw-bold">Vous pourriez aussi aimer :</h3>
            <div class="row">
                @foreach($suggestions as $immobilier)
                    <div class="col-md-3 mb-4">
                        <div class="card equal-height-card">

                            <img src="{{ asset($immobilier->user_image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $immobilier->type }} - {{ $immobilier->adresse }}</h5>
                                <p class="text-primary fw-bold">{{ number_format($immobilier->prix, 0, ',', ' ') }} €</p>
                                <div class="card-buttons">
                            <a href="{{ route('vente.detail', ['id' => $immobilier->id]) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Voir en détail
                            </a>

                        </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@else
    <!-- Section des biens recommandés (uniquement si aucune recherche) -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Nos biens recommandés</h2>

    <div class="container">
        <div class="row">
            @foreach($immobiliers as $immobilier)
                <div class="col-lg-4 col-md-6 my-3">
                   <div class="card border-0 shadow equal-height-card" style="max-width: 350px; margin:auto;">

                        <img src="{{ asset($immobilier->user_image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="mb-3">
                                <i class="bi bi-geo-alt-fill"></i>
                                Adresse : {{ $immobilier->adresse }}
                            </h6>
                            <h6 class="mb-3">
                                <i class="bi bi-cash"></i>
                                Prix : {{ number_format($immobilier->prix, 0, ',', ' ') }} DA
                            </h6>
                            <h6 class=" mb-3">
                                <i class="bi bi-house-door-fill"></i>
                                Surface : {{ $immobilier->surface }} m²
                            </h6>

                            <div class="d-flex justify-content-evenly mb-2">
                                <a href="{{ route('vente.detail', ['id' => $immobilier->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Voir en détail
                                </a>


                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination des recommandations -->
            <div class="col-lg-12 text-center mt-5">
                {{ $immobiliers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endif


<!-- ABOUT US -->
<div class="container about-section">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4">
            <img src="{{ asset('images/immg4.jpg') }}" alt="À propos">
        </div>
        <div class="col-md-6">
            <h3>À propos de nous</h3>
            <p class="mt-3">
                Nous sommes une agence dédiée à l’immobilier, au service de votre confort et vos projets.
            </p>
            <h5 class="mt-4">Notre mission</h5>
            <p>
                Offrir une solution personnalisée pour chaque besoin immobilier avec fiabilité et engagement.
            </p>
        </div>
    </div>
</div>

<!-- SERVICES / OUR PROJECT -->
<div class="container services-section">
    <h3>Nos Services</h3>
    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('app_acheter') }}" class="text-decoration-none">
                <div class="service-card h-100">
                    <i class="bi bi-house-door-fill"></i>
                    <h5 class="fw-bold mt-2">Acheter</h5>
                    <p class="mb-0">Explorez nos offres de biens immobiliers à vendre selon vos critères.</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('app_louer') }}" class="text-decoration-none">
                <div class="service-card h-100">
                    <i class="bi bi-key-fill"></i>
                    <h5 class="fw-bold mt-2">Louer</h5>
                    <p class="mb-0">Un large choix de locations pour courts ou longs séjours, adaptées à vos besoins.</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('app_echanger') }}" class="text-decoration-none">
                <div class="service-card h-100">
                    <i class="bi bi-arrow-left-right"></i>
                    <h5 class="fw-bold mt-2">Échanger</h5>
                    <p class="mb-0">Profitez de notre service d’échange de biens immobiliers en toute simplicité.</p>
                </div>
            </a>
        </div>
    </div>
</div>



<!-- Contactez-nous + Carte -->
<div class="container carte my-5">
  <h4 class="text-center fw-bold mb-4">Contactez-nous</h4>
  <div class="row">
    <!-- Google Map -->
    <div class="col-lg-8 col-md-7 mb-4">
      <iframe class="w-100 rounded" height="320px"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d204545.62527058827!2d4.8421697206233665!3d36.769958239902806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12f2cca1a82082c5%3A0x7807b41e13330b6e!2zQsOpamHDr2E!5e0!3m2!1sfr!2sdz!4v1740740440302!5m2!1sfr!2sdz"
        loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
    </div>

    <!-- Coordonnées et réseaux sociaux -->
    <div class="col-lg-4 col-md-5">
      <div class="bg-white p-4 rounded mb-4 shadow-sm">
        <h5>Appelez-nous</h5>
        <a href="tel:0567283210" class="d-block mb-2 text-dark text-decoration-none">
          <i class="bi bi-telephone-fill me-2"></i> 0567283210
        </a>
      </div>

      <div class="bg-white p-4 rounded shadow-sm">
        <h5>Suivez-nous</h5>
        <a href="#" class="d-inline-block mb-2">
          <span class="badge  text-dark fs-6 p-2">
            <i class="bi bi-twitter me-1"></i> Twitter
          </span>
        </a><br>
        <a href="#" class="d-inline-block mb-2">
          <span class="badge text-dark fs-6 p-2">
            <i class="bi bi-facebook me-1"></i> Facebook
          </span>
        </a><br>
        <a href="#" class="d-inline-block mb-2">
          <span class="badge text-dark fs-6 p-2">
            <i class="bi bi-instagram me-1"></i> Instagram
          </span>
        </a>
      </div>
    </div>
  </div>
</div>





 <!-- contacte nous-->
  <!-- contacte nous-->

   <div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="mb-2">Agence immobilière</h3>
            <p>Lorem ipsum dolor sit amet consectetur,
                adipisicing elit. Quaerat necessitatibus corporis minus,
                asperiores mollitia officia ex ratione,
                commodi quo aspernatur sed. Corporis voluptatibus omnis mollitia dicta officiis,
                 sed voluptas consectetur!
            </p>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Liens</h5>

                <a class="nav-link @if(Request::route()->getName() == 'app_accueil') active @endif" aria-current="page" href="{{ route('app_accueil') }}">Accueil</a><br>
                <a class="nav-link  @if(Request::route()->getName() == 'app_acheter') active @endif" href="{{  route('app_acheter') }}">Acheter</a><br>
                <a class="nav-link @if(Request::route()->getName() == 'app_louer') active @endif" href="{{  route('app_louer') }}">Louer</a><br>
                <a class="nav-link @if(Request::route()->getName() == 'app_about') active @endif" href="{{ route('app_about') }}">À propos</a><br>
                <a class="nav-link @if(Request::route()->getName() == 'app_connexion') active @endif" href="{{  route('app_connexion') }}">Connexion</a><br>
                <a class="nav-link @if(Request::route()->getName() == 'app_inscription') active @endif" href="{{  route('app_inscription') }}">Inscription</a><br>

        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Suivez nous</h5>
            <a href="#" class="d-line-block text-dark text-decoration-none mb-2">
                <i class="bi bi-twitter-x me-1"></i> Twitter

            </a><br>
            <a href="#" class="d-line-block text-dark text-decoration-none mb-2">
                <i class="bi bi-facebook me-1"></i> Facebook

            </a><br>
            <a href="#" class="d-line-block text-dark text-decoration-none mb-2">
                <i class="bi bi-instagram me-1"></i> Instagram

            </a><br>

        </div>
    </div>
   </div>
   <h6 class="text-center bg-dark text-white p-3 m-0">Agence immobilière</h6>


        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Initialisation de Swiper -->
        <script>
            var swiper = new Swiper(".swiper-container", {
                spaceBetween: 0,
                effect: "fade",
                loop:true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },

            });


            var swiper = new Swiper(".swiper-comments", {

                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: "auto",
                slidesPerView: "3",
                loop:true,
                coverflowEffect: {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                },
                breakpoints:{
                    320:{
                    slidesPerView:1,
                    },
                    640:{
                    slidesPerView:1,
                    },
                    768:{
                    slidesPerView:2,
                    },
                    1024:{
                    slidesPerView:3,
                    },
                }
                });


        </script>

<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('assets/app.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



<!--bage-->
</main>








<style>
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-img-top {
        object-fit: cover;
        height: 200px;
    }

    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-buttons {
        margin-top: auto;
    }
</style>


@endsection