@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/flatly/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<link rel="stylesheet" href="{{ asset('assets/css/css_table_show.css') }}">

<script src="{{ asset('assets/js/dossier.js') }}"></script>
<style>
   .panel_view_bottom {
   display: block;
   }
   span.title_profil {
   padding-left: unset !important; 
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
   i.fa-solid.fa-circle-xmark {
   font-size: 18px;
   color: #e91e63;
   margin-top: 10px;
   }
   .form-group.row {
    align-items: center;
   }

   .form-control {
    height: 36px;
    padding: 1px 15px;
   }

   .form-control:focus, input:focus {
    border-color: #d7d1cb !important;
    }

    .attribut_file {
    border: 2px solid #cbc3c3;
    border-radius: 22px;
    padding-top: 15px;
    padding-bottom: 15px;
    margin-top: 15px;
   }

   #attribut_champ {
    width: 100%;   
    PADDING-TOP: 15PX;
   }
   .btn_panel {
    text-align: -webkit-center;
    padding-top: 25px;
    padding-bottom: 20px;
   }

   .btn_panel button {
    padding: 5px 10px;
    }

    .panel_organigramme {
    PADDING-RIGHT: 0px!important;
    PADDING-LEFT: 0px !important;
    }

    .panel_view_details , .header_view {

    width: 94% !important;

    }

    .panel_organigramme {
    PADDING-RIGHT: 25px!important;
    height: 550px !important;
     }

     .form-group label {
    font-size: 14px;
    }
 
</style>
<div class="header_view">
   <div class="sub_view">
  
      Résultats : 
 
   </div>
</div>
<div class="panel_view_details">
   <div class="table_p">
             

   <div class="block_data_dossier  tbl_profil" style='width: 73%;'>


     
       <table class="rwd-table">
               <tbody>
                  <tr>
                  <th width="25%">Date</th>
                  <th width="25%"> Numero</th>
                  <th width="40%"> Titre</th>
                  <th width="10%">Voir</th>
         
                  </tr>
  

                  @for ($i = 0; $i < count($dossiers) ; $i++)
                  
                           <tr>
                                   
                                    <td> 
                                    {{$dossiers[$i]['id']}}

                                    </td>


                                    <td> 
                                 
                                    {{$dossiers[$i]['date']}}
                                    </td>

                                    <td> 
                                    {{$dossiers[$i]['titre']}}

                                    </td>


                                    <td> 
                                    <div class="control_block">

                                      

<div class="col-xsm mr-2">
   <a href="/show_dossier/   {{$dossiers[$i]['id']}} " target="_blank">
      <button class="btn btn-warning" href="">
         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
         </svg>
      </button>
   </a>
  </div>
</div>

                                    </td>


                              </tr>
                   @endfor
                  
                 
               </tbody>
            </table>
      

   </div>
</div>



 

@endsection