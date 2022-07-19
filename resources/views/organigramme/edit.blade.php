@extends('layouts.app')
@section('content')

<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script> 

<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" >



	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/flatly/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">



   
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="{{ asset('assets/Treeview/css/jquery.bootstrap.treeselect.css') }}" rel="stylesheet">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/Treeview/js/jquery.bootstrap.treeselect.js') }}"></script>

<link rel="stylesheet" href="{{ asset('assets/combotree/style.css') }}">

<script>

   var id_organigramme = {!! json_encode($id) !!};

</script>

<script src="{{ asset('assets/js/organigramme.js') }}"></script>

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

</style>

      <div class="header_view">
         <div class="sub_view">
            
            <a class="link_organigramme" href="{{route('home_organigramme')}}">
               <span class="material-icons">  home </span>  Les Organigrammes
            </a>
        
            
            <span class="title_profil">     \ 
            
         <span class="ititle_organigramme"> {{$nom}} </span> </span> </div>
      </div>
      <div class="panel_view_details">
         <div class="table_p">

         <div class="row">
            <div class="col-md-6 panel_add">
            <h3 align="center">Ajouter un Nouveau Dossier</h3>
            <br />
            <form method="post" id="treeview_form">
               
                <div class="form-group">
                  <div class="block">
                    <label>Sélectionner le type</label>
                  </div>
           
                  <div class="btn-group btn-toggle"> 
                        <button class="btn btn-primary btn-default active btn_dossier">Dossier</button>
                        <button class="btn btn-default  btn_sous_dossier">Sous Dossier</button>
                   </div>
                </div>

               <div class="form-group">
               <label>Sélectionner le dossier parent</label>
                  <div id="select_block">
                     
                  </div>
               
             
               </div>
         
               <div class="form-group">
               <label>Entrez le nom de dossier</label>
               <input type="text" name="dossier_champs" id="category_name" class="form-control">
               <input class="hidden" type="text" name="id_organigramme" id="id_organigramme" value="{{$id}}" hidden="true"/>
               <input class="hidden" type="text" name="type_dossier" id="type_dossier" value="btn_dossier" hidden="true"/>

               </div>
               <div class="form-group">
                 <button type="button" class="btn btn-success hidden btn_add_champs_click" onclick="">Ajouter les champs</button>
               </div>
               <div class="form-group">
               <input type="submit" name="action" id="action" value="Ajouter" class="btn btn-info" />
               </div>
            </form>
            </div>
            <div class="col-md-6 panel_organigramme">
            <h3 align="center">Organigramme</h3>
            <br />
            
            <button type="button" class="btn btn-info btn_add_oranigramme" onclick="add_oranigramme()"><span class="material-icons">
                  add
                  </span>Ajouter</button>

            <table class="table_champs_add">
                      <tr class="table_h">
                          <th style="width:45%">Nom du champs</th>
                          <th>Type du champs</th>
                          <th>Action</th>
                      </tr>
                      <tr>
                          <td> <input class="form-control" type="text" > </td>
                          <td> <select class="form-control" name="" id="">

                           <option>sélectionner le type</option>
                            <option value="1">Date</option>
                            <option value="1">Text</option>
                            
                            </select>
                           </td>
                          <td> 
                         
                           <div class="block_action_organigramme">
                              <button type="button" class="btn btn-success" onclick="click_edit(event,1 )">Validé</button>
                           </div> 
                        </td>
                      </tr>
           
                  
                  </table>




            </div>
         
            <div class="col-md-12 panel_add">
               <h3 align="center">Les champs de L'organigramme</h3>
              
               <br />
               <div>


                  <div id="treeview"></div>
                 
               
              </div>
             
            </div>
            </div>

         </div>
      </div>









  
      </script>








    






@endsection