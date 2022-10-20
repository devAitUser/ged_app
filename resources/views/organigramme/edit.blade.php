@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" >

<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"  >
<link href="{{ asset('assets/Treeview/css/jquery.bootstrap.treeselect.css') }}" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"  ></script>
<script src="{{ asset('assets/Treeview/js/jquery.bootstrap.treeselect.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/combotree/style.css') }}">
<script>
   var id_organigramme = {!! json_encode($id) !!};
   
</script>
<script src="{{ asset('assets/js/organigramme.js') }}"></script>
<style>
   form#form_modal table tr td {
      text-align: -webkit-center;
   }
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
   i.caret {
    display: none;
   }
   select.form-control {
      width: auto;
   }
   span.lable_btn_add {
    margin-top: 5px;
    position: relative;
    top: -8px;
    }

    .tree {
         list-style: none;
         padding-left: 0px;
      }

      ol.breadcrumb {
            border: 1px solid #ddd9d9;
            font-size: 14px;
            margin-top: 30px;
            margin-bottom: 18px;
            background-color: #f5f3f3;
         }
         .panel-heading {
         width: 80% !important;
         }

</style>

<div class="panel-heading">   
   <a class="link_organigramme" href="{{route('home_organigramme')}}">
      <span class="material-icons">  home </span>  Les plans de classement des archives
      </a>
      <span class="title_profil">     \ 
      <span class="ititle_organigramme"> {{$nom}} </span> </span> 

</div>
<div class="panel_view_details">
   <div class="table_p">
      <form method="post" id="treeview_form">
      <div class="row">
         
         <div class="col-md-6 panel_add">
            <h3 align="center">Ajouter un Nouveau Dossier</h3>
            <br />


               <div class="form-group">
                  <div class="block">
                     <label>Sélectionner l'entité</label>
                  </div>
                  <div class="d_flex" style="display: flex;">

                     <select name="select_entite" class="form-control" id="select_entite" required>
                        <option value="">Selectionner</option>
                        @foreach ($entites as $entite)
                        <option value="{{$entite->id}}">{{$entite->nom}}</option>
                        @endforeach
                       </select> 

                       <button class="form-control btn_add_entitre"  data-toggle="modal" data-target="#panel_entite" style="width: auto;margin-left: 37px;background-color: #cddc39;border: #707b0c;color: #333030;">

                        <span class="material-icons">add</span>
                 

                       </button>

                       
                       <button class="form-control btn-danger btn_delete_entite"   style="width: auto;margin-left: 37px;">

                       <span class="icon_empty" style="position: relative;top: -1px;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                 <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"></path>
                              </svg> </span>
        

                       </button>
      
                         

                       

                  </div>


               </div>
          
               <div class="form-group">
                  <div class="block">
                     <label>Sélectionner le type</label>
                  </div>
                  <div class="btn-group "  id='btn_group_oganigramme'> 
                     <button class="btn btn-primary btn-default  btn_dossier">Dossier</button>
            
                     <button class="btn btn-default  btn_sous_dossier">Sous Dossier</button>
                     <button class="btn  btn-default  btn_piece_joint ">Pièce </button>
                 
                  </div>

               </div>
               <div class="form-group">
                  <label>Sélectionner le dossier parent</label>
                  <div id="select_block">
                  </div>
               </div>
               <div class="form-group">
                  <label>Entrez le nom de dossier</label>
                  <input type="text" name="dossier_champs" id="category_name" class="form-control" required>
                  <input class="hidden" type="text" name="id_organigramme" id="id_organigramme" value="{{$id}}" hidden="true"/>
                  <input class="hidden" type="text" name="type_dossier" id="type_dossier" value="btn_dossier" hidden="true"/>
               </div>
               <div class="form-group">
                  <button type="button" class="btn btn-success hidden btn_add_attributs_click" onclick="">Ajouter les champs</button>
               </div>
               <div class="form-group">
                  <input type="submit" name="action" id="action" value="Ajouter" class="btn btn-info" />
               </div>
            
         </div>
         <div class="col-md-6 panel_organigramme   ">
            <h3 align="center">Les attributs</h3>
            <br />
            <div class="block_attributs hidden">
               <button type="button" class="btn btn-info btn_add_oranigramme" ><span class="material-icons">
               add
               </span>Ajouter</button>
               <table id="add_table_champs_add" class="table_champs_add">
                  <tr class="table_h">
                     <th style="width:45%">Nom du champs</th>
                     <th>Type du champs</th>
                     <th>Action</th>
                  </tr>
                  <tbody>

                     <tr id='row_table_champs_add_1' >
                        <td> <input name ='name_champ[]' class="form-control" type="text" > </td>
                        <td>
                           <select name ='type_champ[]' class="form-control" name="" id="" >
                              <option>sélectionner le type</option>
                              <option value="date">Date</option> 
                              <option value="Text">Text</option> 
                              <option value="Fichier">fichier</option>
                           </select>
                        </td>
                        <td>
                           <div class="block_action_organigramme">
                              <a href="" onClick="removeRow_table_champs_add(event,1)" ><i class="fa-solid fa-circle-xmark "></i></a>
                           </div>
                        </td>
                     </tr>

                  </tbody>
                
               </table>
            </div>
         </div>
        
         <div class="col-md-12 panel_add">
            <h3 align="center">Le plan de classement du  <span class="ititle_organigramme"> {{$nom}}  </span> </h3>
     
         
            <div>
               <div ></div>
            </div>
            <ul class="tree"  >

            </ul>
         </div>
      </div>
   </form>
   </div>
</div>



 
 <!-- Modal panel_attributs -->
 <div class="modal fade" id="panel_attributs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content panel_organigramme  ">
       <div class="modal-header">
         <h4 class="modal-title" >Dossier : <strong><span class="title_dossier"></span></strong>
            </h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>

       <h3 class="text-center" >Les attributs du Dossier</h3>
       <form method="post" id="form_modal">
       <div class="modal-body   ">
         <button type="button" class="btn btn-info modal_btn_add_oranigramme"><span class="material-icons">
            add
            </span>Ajouter</button>
        
            <input type="text" class="hidden id_dossier" name="id_champs" >
            
         <table id="Modal_table_champs_add" class="table_champs_add ">
            <tbody><tr class="table_h">
               <th style="width:45%">Nom du champs</th>
               <th>Type du champs</th>
               <th>Action</th>
            </tr>
            </tbody><tbody>

       

            </tbody>
          
         </table>

         <h3 class="text-center" >Les paramètres de l'indexation Automatique</h3>

         <button type="button" class="btn btn-info modal_btn_add_index"><span class="material-icons">
            add
            </span>Ajouter</button>

         <table id="Modal_table_link_index" class="table_champs_add">
            <tbody><tr class="table_h">
               <th style="width:45%">Index dans le fichier PDF</th>
               <th>Le champs</th>
               <th>Fichier PDF</th>
               <th>Action</th>
            </tr>
            </tbody><tbody>

       

            </tbody>
          
         </table>
      
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary btn_fermer_attributs" data-dismiss="modal">Fermer</button>
         <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
       </div>
      </form>
     </div>
   </div>
 </div>


 <!-- Modal entite -->
 <div class="modal fade" id="panel_entite" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title" id="Modal_attributs">Ajouter : <strong><span class="title_dossier"></span></strong>
            </h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <form method="post" id="form_modal">
       <div class="modal-body">
 
            
            <div class="panel_pop_up">
                     <div class="form-group">
                     <label for="nom_organigramme">Nom du L'entité </label>
                     <input type="text" class="form-control" name="nom_entite" id="nom_entite" placeholder="Nom du L'entité " required="">
                     </div>
            </div>
      
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary btn_fermer_attributs" data-dismiss="modal">Fermer</button>
         <button type="button" class="btn btn-primary btn_creer_entite">Créer</button>
       </div>
      </form>
     </div>
   </div>
 </div>
@endsection