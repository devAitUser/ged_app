@extends('layouts.app')

@section('content')


<div class="block_menu left">
         <ul>
            <li class="link_menu__left" onclick="window.open('/', '_self');">  
               <span class="icon_menu_left" >
               <img src="{{ asset('img_app/folder-search-icon.png') }}" style="width: 20px;">
               </span>
               <span class="label_menu _left"> Rechercher un dossier </span> 
            </li>
            <li class="link_menu__left">
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
         </ul>
      </div>
      <div class="panel_view_info">
         <ul class="block_archive">
            <div class="sub_archive_block">
               <h4 class="titre_block_archive">
                  <img src="{{ asset('img_app/Box-icon.png') }}" style="vertical-align: bottom;position: relative;top: 1px;right: 3px;" alt="">
                  Suivi de l'archivage
               </h4>
               <li class="li_block_archive">
                  <a href="#">
                  <img src="{{ asset('img_app/62917-open-file-folder-icon.png') }}" style="width: 22px;vertical-align: sub;" alt="">
                  En stade intermédiaire  <b><span ><b>(83738)</b>
                  </span></b></a>
               </li>
               <li class="li_block_archive last_item_bskli">
                  <a href="#">
                  <img src="{{ asset('img_app/62917-open-file-folder-icon.png') }}" style="width: 22px;vertical-align: sub;" alt="">
                  À verser au dépot Archivage  <b><span ><b>(3)</b></span></b></a>
               </li>
               <li class="li_block_archive last_item_bskli">
                  <a href="#">
                  <img src="{{ asset('img_app/62917-open-file-folder-icon.png') }}" style="width: 22px;vertical-align: sub;" alt="">
                  À eliminer   <b><span ><b>(3)</b></span></b></a>
               </li>
            </div>
         </ul>
      </div>
      <div class="block_menu right">
         <ul>
            <li class="link_menu__right">
               <div class="add_btn_folder">
                  <span class="icon_menu_right" >
                  <img src="{{ asset('img_app/folder-add-icon.png') }}" style="width: 20px;">
                  </span>
                  <span class="label_menu_right"> Créer un nouveau dossier  </span> 
               </div>
            </li>
         </ul>
      </div>



@endsection
