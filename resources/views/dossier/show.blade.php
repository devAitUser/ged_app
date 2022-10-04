@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script> 

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
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

    .td_1 {

      text-transform: uppercase;
      font-weight: 500;
      font-size: 14px;
      }

      .panel-heading {
         width: 80% !important;
      }

      nav.nav_doc {
         width: 94% !important;
         margin: 0 auto;
         padding-top: 15px;
      }

      .table_info_doc {
         width: 80%;
         margin: 0 auto;
         padding-top: 25px;
      }

      table.table.table-sm {
         /* border: 1px solid; */
         border: 1px solid #dee2e6;
         border-collapse: collapse;
      }

      table.table.table-sm thead {
         background-color: antiquewhite;
      }
      .table thead th , .table tbody td {

         padding-left: 25px !important ;
      }

 
</style>







      <div class="panel-heading">  Dossier : {{$id}} </div>
      <input type="text" id="id_dossier" value={{$id}} hidden>

      <form  method="post" action="{{url('update_dossier',$id)}}"  >
         {{ csrf_field() }}
      <div class="panel_view_details">

         <nav class="nav_doc">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav_info_doc" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Informatios du Dossier</button>
              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Historique</button>
            
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

               <div class="table_p">

           
      
                  <table id="id_table_print" class="tbl_profil">
                    <tr>
                        <td class="td_1">Imprimer le Dossier :</td>
                        <td> 
                                          
      
                           <div class="control_block">

                             

                              <div class="col-xsm mr-2">
                                 <span class="printclass" target="_blank">
                                    <span class="btn btn-warning btn_show_pdf" href="">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                          <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                          <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                        </svg>
                                    </span>
                                 </span>
                                </div>
                           </div>

                  

                                                            
                       </td>


                   </tr>
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
                                                   <span class="btn btn-warning btn_show_pdf" href="">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                         <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                                         <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                                      </svg>
                                                   </span>
                                                </a>
                                               </div>
                                          </div>
      
                                 
      
                                          @else 
                                          <input type="text" name="id[]" value="{{$attributs[$i]->id}}" hidden>
                                          <input type="text" name="valeur[]" class="form-control" value="{{$attributs[$i]->valeur}}" >
      
                                          @endif
                                 
                                    </td>
      
      
                              </tr>
      
      
                      @endif        
                   
      
      
                    @endfor
      
                 
          
                  </table>
      
                  @if (Auth::user()->hasPermissionTo('Modifier les dossiers'))
      
                        <div class="btn_panel">
                        
                        
      
                              <button class="btn btn-primary delete_user mr-3" href="" id="">Modifier</button>
                              <a class="btn btn-danger delete_user" href="{{ route('delete_dossier',$id) }}" id="">Supprimer</a>
      
      
      
                        </div>
      
      
                   @endif     
      
             
           
               </div>
               
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              
               <div class="table_info_doc">
                  <table class="table table-sm">
                     <thead>
                       <tr>
          
                         <th scope="col">Utilisateur</th>
                         <th scope="col">Action </th>
                         <th scope="col">Date</th>
                       </tr>
                     </thead>
                     <tbody>
                        
                    
                        @foreach($all_historiques as $all_historique)
                           <tr>
                         
                               <td>{{ $all_historique['user']   }}</td>
                        
                               <td>{{ $all_historique['action'] }}</td>

                               <td>{{ $all_historique['date'] }}</td>
                          
                            </tr>
                        @endforeach    
              
                     
                     
                     </tbody>
                   </table>
               </div>
               
            </div>

          </div>


     
      </div>

      </form>




 

@endsection