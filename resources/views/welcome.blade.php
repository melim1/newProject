<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/app.css')}}">


    </head>
    <body >
        {{--bare de navigation--}}
        @include('navbar/navbar')
        {{--toute les autre pages heritent de cette page--}}
        @yield('content')



       {{--nos script js --}}
       @include('script');
    </body>
</html>
