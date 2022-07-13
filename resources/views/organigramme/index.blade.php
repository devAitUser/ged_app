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

<script src="{{ asset('assets/js/organigramme.js') }}"></script>

<style>
   .panel_view_bottom {
   display: block;
   }
   .panel_view_bottom {
   height: 564px!important;
   }
</style>

      <div class="header_view">
         <div class="sub_view"> <span class="title_profil"> Organigramme </span> </div>
      </div>
      <div class="panel_view_details">
         <div class="table_p">

         <div class="row">
            <div class="col-md-6 panel_add">
            <h3 align="center">Ajouter un Nouveau Dossier</h3>
            <br />
            <form method="post" id="treeview_form">
               <div class="form-group">
               <label>Sélectionner le dossier parent</label>
                  <div id="select_block">
                     
                  </div>
               
             
               </div>
               <div class="form-group">
               <label>Entrez le nom de dossier</label>
               <input type="text" name="dossier_champs" id="category_name" class="form-control">
               </div>
             
               <div class="form-group">
               <input type="submit" name="action" id="action" value="Ajouter" class="btn btn-info" />
               </div>
            </form>
            </div>
            <div class="col-md-6 panel_organigramme">
            <h3 align="center">Organigramme</h3>
            <br />
            <div id="treeview"></div>
            </div>
            </div>

         </div>
      </div>









  
      </script>








    






@endsection