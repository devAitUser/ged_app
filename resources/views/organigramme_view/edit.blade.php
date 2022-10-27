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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>





<script>
   var id_organigramme = {!! json_encode($id) !!};
   
</script>
<script src="{{ asset('assets/js/organigramme_view.js') }}"></script>
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

         .btn_print {
            position: absolute;
            right: 40px;
            top: 25px;
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
         
        
         <div class="col-md-12 panel_add">
            <h3 align="center">Le plan de classement du  <span class="ititle_organigramme"> {{$nom}}  </span>
            

               <span class="btn btn-warning btn_print"  href="">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                     <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                     <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
                   </svg>
               </span>
            </h3>
     
         
            <div>
               <div ></div>
            </div>
            <ul class="tree" >

            </ul>
         </div>
      </div>
   </form>
   </div>
</div>




@endsection