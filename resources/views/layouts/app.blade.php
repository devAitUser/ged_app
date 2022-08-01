<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"
         rel="stylesheet">
         <link rel="preconnect" href="https://fonts.googleapis.com">
         <link rel="preconnect" href="https://fonts.googleapis.com">
         <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
         <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">

         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
         
         
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
                     <li class="Mnuli lish  {{ request()->is('user_list')  ? 'active' : '' }} ">
                        <span class="material-icons">
                        <a href="{{route('user_list') }}">group_add</a>
                        </span>
                     </li>
                     <li class="Mnuli lish {{ request()->is('organigramme')  ? 'active' : '' }}">
                        <a href="{{route('home_organigramme')}}">
                           <span class="material-icons  ">
                           account_tree
                           </span>

                         </a>
                     </li>
                     
              

                     <li class="Mnuli lish">
                     <a href="{{route('roles.index') }}"> 
                        <span class="material-icons">
                        rule
                        </span> </a>
                     </li>


                     <li class="Mnuli lish">

                     <a href="{{route('permissions.index') }}" >

                     <svg xmlns="http://www.w3.org/2000/svg"  width="36" height="26" fill="currentColor" class="bi bi-file-lock-fill" viewBox="0 0 16 16">
                           <path d="M7 6a1 1 0 0 1 2 0v1H7V6zM6 8.3c0-.042.02-.107.105-.175A.637.637 0 0 1 6.5 8h3a.64.64 0 0 1 .395.125c.085.068.105.133.105.175v2.4c0 .042-.02.107-.105.175A.637.637 0 0 1 9.5 11h-3a.637.637 0 0 1-.395-.125C6.02 10.807 6 10.742 6 10.7V8.3z"/>
                           <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-2 6v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V8.3c0-.627.46-1.058 1-1.224V6a2 2 0 1 1 4 0z"/>
                        </svg>
                     </a>
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