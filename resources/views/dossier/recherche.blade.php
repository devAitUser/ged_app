@extends('layouts.app')
@section('content')
<style>
   .panel_view_bottom {
   display: block;
   }
   .panel_view_bottom {
   height: auto !important;
   margin-bottom: 37px;
   }
   .panel_view_details {
   margin-bottom: 15px;
   }
   #organigramme_table_wrapper {
   margin-bottom: 15px;
   }
   button.btn_profil {
   border: none;
   }
   .tbl_profil {
   width: 36%;
   }
   table.tbl_profil tr td {
   text-align: CENTER;
   }
   .tbl_profil .block_search td {
   padding-top: 47px ;
   text-align: center;
   margin-top: 11px;
   }
   button.btn_profil.btn_search {
   font-size: 15px;
   padding: 5px 10px 5px 37px
   }
   .icon_search {
   position: absolute;
   margin-left: -28px;
   margin-top: -1px;
   }

   table.tbl_profil tr td {
    padding-top: 23px;

   }
</style>
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script> 
<script src="{{ asset('assets/js/recherche.js') }}"></script>
<div class="header_view">
   <div class="sub_view"> <span class="title_profil"> Recherche</span> </div>
</div>
<div class="panel_view_details">
   <div class="table_p">
      <form action=""  method="post">
         @csrf
         <table class="tbl_profil">
            <tbody>
               <tr>
               <input type="text" name="id_organigramme" value="{{$id_organigramme}}" hidden>
                  <td class="td_1">Fond :</td>
                  <td>
                     <select class="input_prof" id="parent_select" name="value_select[]">
                        <option value="">Selectionne le dossier</option>
                     </select>
                  </td>
               </tr>
               <tr>
               </tr>
               <tr id="row_1" >
                  <td class="td_1 td_1 sous_label_1  " >________ :</td>
                  <td>
                        <select class="input_prof" id="sous_select_1" name="value_select[]" onchange="add_row_select(1)">
                                 <option value="">Selectionne le dossier</option>
                        
                                 </select>

                  </td>
               </tr>
               <tr>
                  
               </tr>
               <tr id="attribut_champ" >
                
               </tr>
               <tr id="attribut_date" >
                
                </tr>
              
               <tr class="block_search" >
                  <td colspan="2" >
                     <button type="submit" class="btn_profil btn_search"> 
                     <span class="material-icons icon_search"> search </span>
                     Recherche sur le dossier</button>  
                  </td>
               </tr>
               
            </tbody>
         </table>
      </form>
   </div>
</div>
@endsection