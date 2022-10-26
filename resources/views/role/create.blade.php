@extends('layouts.app')
@section('content')
<style>
    .table thead th{
    color: black;
    font-size: 15px;
    }
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
 
    .styled-table thead tr {
     background-color: #343a40;
 
     }
     .panel-heading {
     width: 80% !important;
      }
      .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
             border: 1px solid #ddd;
             vertical-align: unset !important;
         }
 
         table.table.table-striped {
          width: 75%;
          margin: 0 auto;
          margin-bottom: 15px;
       }
       .table_p {
     display: grid;
     }
 </style>




<div class="panel-heading">   
   <a class="link_organigramme" href="{{route('home')}}">
   <span class="material-icons">  home </span>  Home
   </a>
   <a class="title_profil" href="{{route('roles.index')}}">     \
   <span class=""> Roles </span> </a>
   <span class="title_profil">     \
   <span class=""> Ajouter nouveau role </span> </span>
</div>
<div class="panel_view_details">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <form method="POST" action="/roles">
                    <input type="hidden" name="_token" value="M8uugXUVfKFh9QGheREkfE7o19VTThVORSC0AI74">                    <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control " name="name" value="" required="" autocomplete="name" autofocus="">
                                            </div>
                    </div>
                    <div class="row mb-3">
                    <div class="col-md-6">

                            <div class="row mb-3">
                            <label for="permission" class="col-md-4 col-form-label text-md-end">Les Permissions</label>
                                <div class="col-md-6">

                                    

                                    <input type="checkbox" name="permission[]" value="1">gestion des boites
                                    <br>
                                    

                                    <input type="checkbox" name="permission[]" value="2">Créer les dossiers
                                    <br>
                                    

                                    <input type="checkbox" name="permission[]" value="3">Modifier le plan de classement
                                    <br>
                                    

                                    <input type="checkbox" name="permission[]" value="4">gestion des utilisateurs
                                    <br>
                                    

                                    <input type="checkbox" name="permission[]" value="5">Modifier les dossiers
                                    <br>
                                    

                                    <input type="checkbox" name="permission[]" value="6">Modifier les roles
                                    <br>
                                    

                                    <input type="checkbox" name="permission[]" value="7">Voir le plan de classement
                                    <br>
                                                                    </div>
                            </div>

                    </div>
                </div>
                <div class="container" style="margin-left:205px">
                <div class="row">
                    <button type="submit" class="btn btn-primary ml-4">
                    créé
                    </button>
                    &nbsp;
                    <button type="reset" class="btn btn-primary">
                    Annuler
                    </button>
                </div>
                </div>
                </form>
            </div>
        </div>
        </div>
</div>
@endsection