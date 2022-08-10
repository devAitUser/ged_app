@extends('layouts.app')

@section('content')

<style>
     li.link_menu__right a {
    text-decoration: none !important;
   }
</style>

<div class="block_menu left">


         <ul>
            <li class="link_menu__left" onclick="window.open('/', '_self');">
               <span class="icon_menu_left" >
               <img src="{{ asset('img_app/folder-search-icon.png') }}" style="width: 20px;">
               </span>
               <span class="label_menu _left"> Rechercher un dossier </span>
            </li>
            {{-- <li class="link_menu__left">
               <span class="icon_menu_left" >
               <img src="{{ asset('img_app/folder-close-icon.png') }}" style="width: 20px;">
               </span>
               <span class="label_menu _left"> Gestion de la déstruction  </span>
            </li>
            <li class="link_menu__left">
               <span class="icon_menu_left" >
               <img src="{{ asset('img_app/folder-error-icon.png') }}" style="width: 20px;">
               </span>
               <span class="label_menu _left"> Gestion des versements   </span>
            </li>



            <li class="link_menu__left">
                <span class="icon_menu_left" >
                <img src="{{ asset('img_app/folder-error-icon.png') }}" style="width: 20px;">
                </span>
             <a href="{{ route('boites.index') }}">   <span class="label_menu _left"> Gestion des boites   </span></a>
             </li> --}}

         </ul>


      </div>
      <div class="panel_view_info">
         <ul class="block_archive">
            <div class="sub_archive_block">
               <h4 class="titre_block_archive">
                  <img src="{{ asset('img_app/Box-icon.png') }}" style="vertical-align: bottom;position: relative;top: 1px;right: 3px;" alt="">
                  Les Chiffres de l'archivage
               </h4>
                @if ($ckeck_select)

                  <li class="li_block_archive">
                     <a href="{{route('all_dossier')}}">
                     <img src="{{ asset('img_app/62917-open-file-folder-icon.png') }}" style="width: 22px;vertical-align: sub;" alt="">
                     Total des Dossiers indexé  <b><span ><b> ({{$Count}})  </b>
                     </span></b></a>
                  </li>
                  <li class="li_block_archive last_item_bskli">
                     <a href="#">
                     <img src="{{ asset('img_app/62917-open-file-folder-icon.png') }}" style="width: 22px;vertical-align: sub;" alt="">
                     Total des Dossiers indexé aujourd'hui  <b><span ><b>(3)</b></span></b></a>
                  </li>
                    
                @else

                <li class="li_block_archive last_item_bskli">
                  <a href="#" style="width: 22px;vertical-align: sub;margin-left: 36px;font-size: 16px;">
                 
                     <b>  Sélectionne Votre projet dans la page Mon profil  </b></a>
                </li>
                    
                @endif
        
           
            </div>
         </ul>
      </div>

      <div class="block_menu right">
         <ul>
            <li class="link_menu__right">
            <a href="{{route('create_dossier')}}">
               <div class="add_btn_folder">
                  <span class="icon_menu_right" >
                  <img src="{{ asset('img_app/folder-add-icon.png') }}" style="width: 20px;">
                  </span>
                  <span class="label_menu_right"> Créer un nouveau dossier  </span>
               </div>
               </a>
            </li>
            <li class="link_menu__right" style="margin-top:5px">
            <a href="{{ route('boites.create') }}">
               <div class="add_btn_folder">
                  <span class="icon_menu_right" >
                  <img src="{{ asset('img_app/folder-add-icon.png') }}" style="width: 20px;">
                  </span>
                  <span class="label_menu_right"> Créer une nouvelle boîte </span>
               </div>
               </a>
            </li>
         </ul>
      </div>




@endsection
