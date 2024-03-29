@extends('layouts.app')

@section('content')

<style>
     li.link_menu__right a {
    text-decoration: none !important;
   }

   .w_menu_right {
      width: 307px;
   }
   ul.block_archive {
      width: 69%;
   }
   .panel_view_info {
      display: flex;
   }
</style>

<div class="block_menu left">
   
        
      

        


      </div>
      <div class="panel_view_info">
      <ul>
            @if ($ckeck_select)
            @if (Auth::user()->hasPermissionTo('Créer les dossiers'))
            
               <li class="link_menu__left" onclick="window.open('{{route('create_dossier')}}', '_self');">
                  <span class="icon_menu_left" >
                  <img src="{{ asset('img_app/folder-add-icon.png') }}" style="width: 20px;">
                  </span>
                  <span class="label_menu _left"> Créer un nouveau dossier </span>
               </li>
               {{-- <li class="link_menu__right" style="margin-top:5px">
               <a href="{{ route('boites.create') }}">
                  <div class="add_btn_folder">
                     <span class="icon_menu_right" >
                     <img src="{{ asset('img_app/folder-add-icon.png') }}" style="width: 20px;">
                     </span>
                     <span class="label_menu_right"> Créer une nouvelle boîte </span>
                  </div>
                  </a>
               </li> --}}
               @endif
               @endif
            @if ($ckeck_select)
               <li class="link_menu__left" onclick="window.open('{{route('recherche_dossier')}}', '_self');">
                  <span class="icon_menu_left" >
                  <img src="{{ asset('img_app/folder-search-icon.png') }}" style="width: 20px;">
                  </span>
                  <span class="label_menu _left"> Rechercher un dossier </span>
               </li>
               <li class="link_menu__left " onclick="window.open('{{route('recherche_ocr')}}', '_self');">
                  <span class="icon_menu_left search_ocr" >
                  <img src="{{ asset('img_app/img_search_ocr.png') }}" style="width: 20px;">
                  </span>
                  <span class="label_menu _left"> Rechercher plein texte </span>
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

               @endif

         </ul>
         <ul class="block_archive">
            <div class="sub_archive_block">
               <h4 class="titre_block_archive">
                  <img src="{{ asset('img_app/Box-icon.png') }}" style="vertical-align: bottom;position: relative;top: 1px;right: 3px;" alt="">
                  Les Chiffres de l'archivage   @if ($ckeck_select) du Projet {{$nom_projet}}   @endif
               </h4>
                @if ($ckeck_select)

                  <li class="li_block_archive">
                     <a href="{{route('all_dossier')}}">
                     <img src="{{ asset('img_app/62917-open-file-folder-icon.png') }}" style="width: 22px;vertical-align: sub;" alt="">
                     Total des Dossiers indexé  <b><span ><b> ({{$Count}})  </b>
                     </span></b></a>
                  </li>
                  @if (Auth::user()->hasPermissionTo('Créer les dossiers'))
                  <li class="li_block_archive last_item_bskli">
                     <a href="#">
                     <img src="{{ asset('img_app/62917-open-file-folder-icon.png') }}" style="width: 22px;vertical-align: sub;" alt="">
                     Total des Dossiers indexé aujourd'hui  <b><span ><b>({{$dossier_indexe}})</b></span></b></a>
                  </li>
                  @endif
                    
                @else

                <li class="li_block_archive last_item_bskli">
                  <a href="{{route('user_profile')}}"style="width: 22px;vertical-align: sub;margin-left: 36px;font-size: 16px;">
                 
                     <b>  Sélectionner Votre projet dans la page Mon profil  </b></a>
                </li>
                    
                @endif
        
           
            </div>
         </ul>
      </div>

      <div class="block_menu right @if (!Auth::user()->hasPermissionTo('Créer les dossiers')) w_menu_right @endif">
         <ul>
       
         </ul>
      </div>




@endsection
