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
   .styled-table thead tr {
    background-color: #428bca;
      }


      table#organigramme_table {
      box-shadow: rgb(136 136 136) 0px 1px 3px;
      }

      table#organigramme_table tr {
         border-top: 1px solid #ddd !important;
         border-bottom: 1px solid #ddd !important;
 
      }

      .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {

        vertical-align: unset !important;

      }

      #organigramme_table .odd {
            background-color: #ebf3f9;
         }

      @media screen and (min-width: 600px){
            table#organigramme_table tbody tr:hover {
               background-color: #d6e4ef;
            }

    

       }
</style>
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script> 
<script src="{{ asset('assets/js/recherche.js') }}"></script>
<div class="header_view">
   <div class="sub_view"> <span class="title_profil"> Recherche</span> </div>
</div>
<div class="panel_view_details">
   <div class="table_p">
   

         <table class="tbl_profil">
            <tbody>
               <tr>
               
                     <td class="td_1">Titre :</td>
                     <td>
                        <input type="text" class="input_prof" name="titre" >
                     </td>
                  </tr>
                  <tr>
                  </tr>
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
               



               <table id="organigramme_table" class=" table table-bordered text-center styled-table">
                     <thead>
                        <tr>
                        <th width="20%">Numero  </th>
                        <th width="25%"> Date de création  </th>
                        <th width="40%"> Titre </th>
                        <th width="30%"> Opérateur 	</th>
                        <th width="25%">Voir</th>




                        </tr>
                     </thead>
                     <tbody>
                


                     </tbody>
                </table>



               
            </tbody>
         </table>


   
</div>

<script src="{{asset('assets/js/datatables.min.js')}}"></script>

<script>

var data = {!! json_encode($all_dossiers) !!};

console.log(data);

</script>
      <script src="{{asset('assets/js/dossier_recherche_table.js')}}"></script>


   
@endsection