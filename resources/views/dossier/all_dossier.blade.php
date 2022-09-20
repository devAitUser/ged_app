@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script> 

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="{{ asset('assets/css/css_table_show.css') }}">

<script src="{{ asset('assets/js/dossier.js') }}"></script>
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
   padding:5px 15px 5px 37px
   }
   .icon_search {
   position: absolute;
   margin-left: -28px;
   margin-top: -1px;
   }

   table.tbl_profil tr td {
    padding-top: 23px;

   }
   .table td, .table th {
    padding: 0.5rem !important;
    }

    #organigramme_table thead tr th {
    border-bottom: 1px solid #a1a3a4 !important;
    border-top: 1px solid #a1a3a4 !important;
     }

    .styled-table thead tr {
      background-color: #e3e5e8;
      color: #363f44;
      line-height: 2.3;
      border: 1px solid #c0b9b9;
      }

      table#organigramme_table {
      box-shadow: rgb(136 136 136) 0px 1px 3px;
      }

      table#organigramme_table tr {
         border-top: 1px solid #ddd !important;
         border-bottom: 1px solid #ddd !important;
         border-left: 1px solid #ddd !important;
         border-right: 1px solid #ddd !important;
 
      }

      .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {

        vertical-align: unset !important;

      }

      #organigramme_table .odd {
            background-color: #edf0f3cf;
         }

      @media screen and (min-width: 600px){
            table#organigramme_table tbody tr:hover {
               background-color: #e3e6e9f7;
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
            width: 90% !important;
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
<div class="header_view">
   <div class="sub_view">
  
      Résultats : 
 
   </div>
</div>
<div class="panel_view_details">
   <div class="table_p">
             

   <div class="block_data_dossier  tbl_profil" style='width: 94%;'>


     
     



            <div class="table_p">

          

                  <table id="organigramme_table" class=" table table-bordered text-center styled-table">
                     <thead>
                        <tr>
                        <th width="15%">Numero  </th>
                        <th width="25%"> Date de création  </th>
                        <th width="40%"> Titre </th>
                        <th width="30%"> Opérateur 	</th>
                        <th width="30%">Voir</th>




                        </tr>
                     </thead>
                     <tbody>

                        <tr>
                           <th scope="row"></th>



                           <th scope="row"></th>




                           <td>
                                 <a href="#" class="text-success mr-2">
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                 </a>
                                 <a href="#" class="text-danger mr-2">
                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                 </a>
                           </td>
                        </tr>


                     </tbody>
                </table>

              </div>
      

   </div>
</div>


<script src="{{asset('assets/js/datatables.min.js')}}"></script>
      <script src="{{asset('assets/js/dossier_table.js')}}"></script>




 

@endsection