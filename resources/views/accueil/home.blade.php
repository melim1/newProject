@extends('layouts/app')
@section('title', 'Accueil')

@section('content')

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

<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('assets/app.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



<!--bage-->


@endsection

