@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
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
       button.btn_profil.btn_empty {
       font-size: 15px;
       padding: 5px 10px 5px 28px;
       background-color: red;
       }
       .icon_empty {
            position: absolute;
            margin-left: -20px;
            margin-top: -1px;
         }
         .tbl_profil {
            width: 73% !important;
            margin-bottom: 10px !important;
            position: unset !important;
          
         }
         .cadre_form {
            border: 1px solid #cbc3c3;
            border-radius: 22px;
            padding-top: 15px;
            padding-bottom: 15px;
            margin-top: 15px;
         }
         .cadre_form {
            width: 50%;
            margin: 0 auto;
            background-color: #f8f5f5;
         }
         form#search_form {
            margin-bottom: 20px;
            
         }
         span.label_search {
            font-weight: 500;
         
         }
         .tbl_profil tr:not(:first-child) td {
            text-transform: uppercase;
         font-weight: 400;
         }
         .d_none{
            display: none;
         }
         div#organigramme_table_wrapper {
            width: 93%;
         }
         .panel_view_details, .header_view {
            width: 84% !important;
         }
         .row.panel_add select , .row.panel_add label {
            font-size: 13px !important;
         }
         .panel_search {
                  margin: 0 auto;
         }
         .form-control {
            height: 33.5px;
         }
</style>
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script> 
<script src="{{ asset('assets/js/recherche.js') }}"></script>
<div class="header_view">
   <div class="sub_view"> <span class="title_profil"> Recherche</span> </div>
</div>
<div class="panel_view_details">
   <div class="table_p">
  
      <form method="post" id="search_form">
         <div class="cadre_form">
            {{-- <table class="tbl_profil">
               <tbody>
                  <tr>
                     
                     <td class="td_1"><span class="label_search">Rechercher par Champs :</span>  </td>
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
                 
                  <tr id="row_1" >
                     <td class="td_1 td_1 sous_label_1  " >________ :</td>
                     <td>
                           <select class="input_prof" id="sous_select_1" name="value_select[]" onchange="add_row_select(1)">
                                    <option value="">Selectionne le dossier</option>
                           
                                    </select>

                     </td>
                  </tr>
                  
                  <tr id="attribut_champ" >
                  
                  </tr>
                  <tr id="attribut_date" >
                  
                  </tr>
               
                  <tr class="block_search" >
                     <td colspan="2" >
                        <button type="submit" class="btn_profil btn_search"> 
                        <span class="material-icons icon_search"> search </span>
                        Recherche sur le dossier   </button> 
                        
                        
                        <button type="submit" class="btn_profil btn_empty d_none"> 
                           <span class="icon_empty"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                              <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                           </svg> </span>
                           Effacer</button>  
                           
                     </td>
                  </tr>
                  



                  
            </table> --}}

            <div class="row">
             
         
               <div class="col-md-11 panel_search">
                  <div class="row panel_add">

                    <div class="col-md-12 pb-4 pt-3">

                         <div class="td_1"><span class="label_search">Rechercher par Champs :</span>  </div>

                     </div>
      
                    <div class="col-md-12">
                   
                    <input type="text" name="id_organigramme" value="{{$id_organigramme}}" hidden>
      
                    
                              <div class="form-group row">
                                 <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">FOND :</label>
                                 <input  type="text" name="nom_champs_select[]" value="FOND" hidden="">
                                 <div class="col-sm-7">
                                 <select class="form-control" id="parent_select" name="value_select[]">
                                    <option value="">Selectionne le dossier</option>
                           
                                    </select>
      
                                    
                                 </div>
                              </div>
             
                        
      
                    </div>
      
                    
                    <div id="row_1" class="col-md-12 ">
      
           
                              <div class="form-group row">
                                 <label for="colFormLabelSm"  class="col-sm-4 col-form-label col-form-label-sm sous_label_1 text-uppercase">________ :</label>
                                 <input class="nom_champs_select_1" type="text" name="nom_champs_select[]" value="text" hidden="">
                                 <div class="col-sm-7">
                                    <select class="form-control" id="sous_select_1" name="value_select[]" onchange="add_row_select(1)">
                                       <option value="">Selectionne le dossier</option>
                              
                                       </select>
      
                                    
                                 </div>
                              </div>
                              
             
                         
      
                    </div>
      
                    <div id='attribut_champ' style="width: 100%;">
                    </div>
      
                   
      
      
                   
               
              
                
                        
                  
               </div>
               </div>
              
               <div class="col-md-11 panel_search pt-3 pb-2  ">
      

                <div class="row panel_add">

                  <div class="col-md-12 ">

                     <div class="btn_panel" style="text-align: center;">
                        
                           
                        <button type="submit" class="btn_profil btn_search"> 
                           <span class="material-icons icon_search"> search </span>
                           Recherche sur le dossier   </button> 
                           
                           
                           <button type="submit" class="btn_profil btn_empty d_none"> 
                              <span class="icon_empty"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                 <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                              </svg> </span>
                              Effacer</button>  
                              
                     </div>
                  </div>

                 </div>
              
               </div>
              
      
            </div>
         </div>

      </form>
   


         <table id="organigramme_table" class=" table table-bordered text-center styled-table" >
            <thead>
               <tr>
               <th >Numero  </th>
               <th > Date de création  </th>
               <th > Titre </th>
               <th > Opérateur 	</th>
               <th >Voir</th>




               </tr>
            </thead>
            <tbody>
       


            </tbody>
       </table>



      
   </tbody>


   
</div>

<script src="{{asset('assets/js/datatables.min.js')}}"></script>

<script>

var data = {!! json_encode($all_dossiers) !!};

console.log(data);

</script>
<script src="{{asset('assets/js/translate_table.js')}}"></script>
      <script src="{{asset('assets/js/dossier_recherche_table.js')}}"></script>


   
@endsection