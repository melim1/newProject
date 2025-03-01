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
                    <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                        <img src="{{ asset('images/img1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Première maison</h5>
                          <h6 class="mb-4">1000000 DA</h6>

                          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Fusce auctor, felis et suscipit consequat, erat orci rhoncus nunc, nec sodales risus ex in sapien. Suspendisse potenti. Mauris ut metus et ligula vehicula euismod. Sed auctor, felis nec pretium interdum, sapien eros tincidunt ligula.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                </div>
                <div class="col-lg-12 text-center mt-5">
                    <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Plus >>> </a>
                </div>
            </div>
          </div>








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
        </script>

    </body>
</html>



