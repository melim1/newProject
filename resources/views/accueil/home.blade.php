@extends('welcome')
@section('title', 'Accueil')

@section('content')


@endsection
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>
    <body class="bg-light">

         {{-- Barre de navigation --}}
         @include('navbar/navbar')

         {{-- Nos scripts JS --}}
         @include('script')





            <!-- caroussel-->
        <div class="container-fluid px-lg-4 mt-4">
            <div class="swiper swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('images/img1.jpg') }}" class="w-100 d-block carousel-img" />
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/img2.jpg') }}" class="w-100 d-block carousel-img" />
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/img3.jpg') }}" class="w-100 d-block carousel-img" />
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/img4.jpg') }}" class="w-100 d-block carousel-img" />
                    </div>
                </div>
            </div>
        </div>

        <!-- barre de recherche-->

        <div class="container availability-form">
            <div class="row ">
                <div class="col-lg-12 bg-white shadow p-4 rounded">
                    <form>
                        <div class="row align-items-end">
                             <div class="col-lg-3 mb-3 ">
                                <label class="form-label" style="font-weight : 500 ;">Projet</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Acheter</option>
                                    <option value="2">Louer</option>

                                  </select>
                            </div>


                            <div class="col-lg-3 mb-3">
                                <label class="form-label" style="font-weight : 500 ;">Type de bien</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Maison</option>
                                    <option value="2">Appartement</option>

                                  </select>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <label class="form-label" style="font-weight : 500 ;">Budget max</label>
                                <input type="text" id="search" class="form-control" placeholder="">
                            </div>

                            <div class="col-lg-2 mb-3">
                                <label class="form-label" style="font-weight : 500 ;">Où cherchez vous?</label>
                                <input type="text" id="adresse" class="form-control" placeholder="">
                            </div>

                            <div class="col-lg-1 mb-lg-3 mt-2">
                                <button type="submit" class="btn text-white shadow-none custom-bg">Search</button>

                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Nos biens</h2>
          <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 my-3">
                    <div class="card border-0 shadow" style="max-width: 300px; margin:auto;">
                        <img src="{{ asset('images/img1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Première maison</h5>
                          <h6 class="mb-4">1000000 DA</h6>
                          <div class="caractéristiques mb-4">
                            <h6 class="mb-1">Caractéristiques</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                4 chambres
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                100 mètre carrée
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Rue les oliviers
                            </span>
                          </div>
                          <div class="rating mb-4">
                            <h6 class="mb-1">Avis</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            </span>
                          </div>
                          <div class="d-flex justify-content-evenly mb-2 ">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Consultez maintenant</a>
                          </div>
                        </div>
                      </div>
                </div>

                <div class="col-lg-4 col-md-6 my-3">
                    <div class="card border-0 shadow" style="max-width: 300px; margin:auto;">
                        <img src="{{ asset('images/img1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Première maison</h5>
                          <h6 class="mb-4">1000000 DA</h6>
                          <div class="Description mb-4">
                            <P>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tenetur saepe perspiciatis dolor eveniet omnis recusandae eaque maiores possimus, id excepturi doloribus unde. Officiis, enim voluptatibus animi nemo unde assumenda non!</P>
                          </div>
                          <div class="rating mb-4">
                            <h6 class="mb-1">Avis</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            </span>
                          </div>
                          <div class="d-flex justify-content-evenly mb-2 ">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Consultez maintenant</a>
                          </div>
                        </div>
                      </div>
                </div>

                <div class="col-lg-4 col-md-6 my-3">
                    <div class="card border-0 shadow" style="max-width: 300px; margin:auto;">
                        <img src="{{ asset('images/img1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Première maison</h5>
                          <h6 class="mb-4">1000000 DA</h6>
                          <div class="caractéristiques mb-4">
                            <h6 class="mb-1">Caractéristiques</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                4 chambres
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                100 mètre carrée
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Rue les oliviers
                            </span>
                          </div>
                          <div class="rating mb-4">
                            <h6 class="mb-1">Avis</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            </span>
                          </div>
                          <div class="d-flex justify-content-evenly mb-2 ">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Consultez maintenant</a>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-lg-12 text-center mt-5">
                    <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Plus >>> </a>
                </div>
            </div>
          </div>
          <!-- cards-->

          <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Commentaires</h2>
<div class="container mt-5">
    <div class="swiper swiper-comments">
        <div class="swiper-wrapper mb-5">
            <!-- Commentaire 1 -->
            <div class="swiper-slide bg-white p-4 ">
                <div class="profile d-flex align-items-center mb-3">
                    <h6 class="m-0 ms-2 fw-bold">Utilisateur 1</h6>
                </div>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Eos accusantium inventore earum, amet,
                    mollitia veritatis a in magni impedit eius nemo,
                    distinctio debitis doloremque perferendis numquam.
                    Commodi quisquam quaerat exercitationem.
                </p>
                <div class="rating">
                    <span class="badge rounded-pill bg-light">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-muted"></i> <!-- Ajout d'une étoile vide -->
                    </span>
                </div>
            </div>

            <!-- Ajoute d'autres commentaires ici si nécessaire -->
            <div class="swiper-slide bg-white p-4 shadow-sm rounded">
                <div class="profile d-flex align-items-center mb-3">
                    <h6 class="m-0 ms-2 fw-bold">Utilisateur 2</h6>
                </div>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Eos accusantium inventore earum, amet,
                    mollitia veritatis a in magni impedit eius nemo,
                    distinctio debitis doloremque perferendis numquam.
                    Commodi quisquam quaerat exercitationem.
                </p>
                <div class="rating">
                    <span class="badge rounded-pill bg-light">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-muted"></i> <!-- Ajout d'une étoile vide -->
                    </span>
                </div>
            </div>

            <div class="swiper-slide bg-white p-4 shadow-sm rounded">
                <div class="profile d-flex align-items-center mb-3">
                    <h6 class="m-0 ms-2 fw-bold">Utilisateur 3</h6>
                </div>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Eos accusantium inventore earum, amet,
                    mollitia veritatis a in magni impedit eius nemo,
                    distinctio debitis doloremque perferendis numquam.
                    Commodi quisquam quaerat exercitationem.
                </p>
                <div class="rating">
                    <span class="badge rounded-pill bg-light">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-muted"></i> <!-- Ajout d'une étoile vide -->
                    </span>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
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
                spaceBetween: 30,
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

    </body>
</html>



