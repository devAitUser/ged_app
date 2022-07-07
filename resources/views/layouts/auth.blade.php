<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"
         rel="stylesheet">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
   </head>
   <body>
      @guest
      @else
      <!-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
         <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             {{ __('Logout') }}
         </a>
         
         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>
         </div> -->
      @endguest 
         <div class="wrapper">
         
            @yield('content')
         
         </div>
    
   </body>
</html>