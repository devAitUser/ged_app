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
   .btn_panel {
    text-align: center;
    margin-bottom: 25px;
   }
   .control_block {
    display: flex;
    }

    textarea.form-control {
    height: 131px;
    }
 
</style>










<div class="header_view">
         <div class="sub_view"> <span class="title_profil"> Dossier :{{$titre}}  </span> </div>
      </div>
      <div class="panel_view_details">
         <div class="table_p">
      
            <table class="tbl_profil">
             @for ($i = 0; $i < count($attributs) ; $i++)
               @if($attributs[$i]->type_champs == "textarea") 
                     <tr>
                              <td class="td_1">{{$attributs[$i]->nom_champs}} :</td>
                              <td> 
                             


                                    <textarea name="titre" class="form-control" id="folder_name">{{$attributs[$i]->valeur}}</textarea>

                               
                           
                              </td>


                        </tr>
               @else


                 <tr>
                              <td class="td_1">{{$attributs[$i]->nom_champs}} :</td>
                              <td> 
                              @if($attributs[$i]->type_champs == "select") 
                                    
                                    <input type="text" class="form-control" value="{{$attributs[$i]->valeur}}" disabled>

                                    @elseif($attributs[$i]->type_champs == "Fichier")


                                    <div class="control_block">

                                      

                                       <div class="col-xsm mr-2">
                                          <a href="{{ asset('storage/'.$attributs[$i]->valeur ) }} " target="_blank">
                                             <button class="btn btn-warning" href="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                   <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                                   <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                                </svg>
                                             </button>
                                          </a>
                                         </div>
                                    </div>

                           

                                    @else 

                                    <input type="text" class="form-control" value="{{$attributs[$i]->valeur}}" >

                                    @endif
                           
                              </td>


                        </tr>


                @endif        
             


              @endfor

           
    
            </table>

            @if (Auth::user()->hasPermissionTo('Modifier les dossiers'))

                  <div class="btn_panel">
                  
                     
                        <button type="submit" class="btn btn-primary  mr-3 " >Modifier</button>
                        <button type="button" class="btn btn-danger" >Supprimer</button>
                  </div>


             @endif     

       
     
         </div>
      </div>



 

@endsection