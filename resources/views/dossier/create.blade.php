@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/flatly/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


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
  
      Créer un nouveau dossier   
 
   </div>
</div>



<div class="panel_view_details">
   <div class="table_p">
   <form  method="post" action="{{url('store_dossier_create')}}" enctype="multipart/form-data" >
            @csrf
      <div class="row">
         
         <div class="col-md-4 ">
            <div class="row panel_add">

              <div class="col-md-12">
             
              <input type="text" name="id_organigramme" value="{{$id_organigramme}}" hidden>

              
                        <div class="form-group row">
                           <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">FOND :</label>
                           <input  type="text" name="nom_champs_select[]" value="FOND" hidden="">
                           <div class="col-sm-8">
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
                           <div class="col-sm-8">
                              <select class="form-control" id="sous_select_1" name="value_select[]" onchange="add_row_select(1)">
                                 <option value="">Selectionne le dossier</option>
                        
                                 </select>

                              
                           </div>
                        </div>
                        
       
                   

              </div>

              <div id='attribut_champ'>
              </div>

             
              <div class="" id='attribut_file'>
       

              </div> 


              <div class="" id='objet'>
       

               </div> 
         
        
          
                  
            
         </div>
         </div>
         <div class="col-md-8 panel_organigramme   ">

         <embed type="application/pdf" id="output"  height="100%" width="100%">

        
         </div>
         <div class="col-md-12  ">







    

           <div class="btn_panel">
            
               
                  <button type="submit" class="btn btn-primary  mr-3 " >Validé</button>
                  <button type="button" class="btn btn-danger" >Supprimer</button>
           </div>
        
         </div>
        

      </div>
   </form>
   </div>
</div>



 

@endsection