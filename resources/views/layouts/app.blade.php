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
        
         <div class="main-content">
            <div class="panel_view_header">
               <div class="header_panel_view">
                  <div class="card-header">
                     <img src="{{ asset('img_app/logo_m.png') }}" class="logo_css">
                  </div>
                  <ul class="hdMnu">
                     <li class="Mnuli lish  {{ request()->is('home')  ? 'active' : '' }} ">
                        <a href="/">
                        <span class="material-icons">
                        home
                        </span>
                        </a>

                     </li>
                     <li class="Mnuli lish  {{ request()->is('user_profile')  ? 'active' : '' }} ">
                        <a href="{{route('user_profile')}}">
                        <span class="material-icons">manage_accounts</span>
                        </a>
                     </li>
                     <li class="Mnuli lish">
                        <span class="material-icons">
                        group_add
                        </span>
                     </li>
                     <li class="Mnuli lish">
                        <span class="material-icons">
                        account_tree
                        </span>
                     </li>
                     <li class="Mnuli lish">
                        <span class="material-icons">
                        rule
                        </span>
                     </li>
               
                     <li class="Mnuli lish">
                        <a href="?display=true&amp;page=logout">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                        <span class="material-icons">  logout </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                        </form>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="panel_view">
               <img src="{{ asset('img_app/LOGO_MENU.png') }}" class="logo_menu">
            </div>
            <div class="panel_view_bottom">

                 @yield('content')
         
            </div>
         </div>
      </div>
      </div>
   </body>
</html>