<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/x-icon" href="{{asset("frontend/img/ist/ist.png")}}">
        <title>EEP-ISTM &#8211; Site web de l&#039;Environnement d'Evaluation du Personnel de l'Institut Supérieur de Technologie de Mamou</title>

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
       
        <!-- custom css and js -->
        <link rel="stylesheet" href="{{asset('frontend/css/bootstrap/bootstrap.min.css')}}">
        <script src="{{asset('frontend/js/bootstrap/bootstrap.min.js')}}"></script>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .boody { 
                 overflow-x: hidden;
                 overflow-y: hidden;
                 background: linear-gradient(to left, rgb(255, 255, 255, 0.9), rgba(255, 255, 255, 0.8)), url({{asset('frontend/img/ist/Logo-EEP_ISTM.png')}}) center / cover no-repeat;  
                 /*  */
            }
         </style>
    </head>
    <body class="font-sans text-gray-900 antialiased boody">
        <div class=" min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="{{route('home')}}">
                    <img src="{{asset('frontend/img/ist/Logo.png')}}" width="300" height="300" alt="" srcset="">
                </a>
            </div>

            <div class="w-full  mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border  border-2 ">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
