<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Devis </title>

<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"  ></script>
<script src="{{ asset('assets/Treeview/js/jquery.bootstrap.treeselect.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/combotree/style.css') }}">
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

</style>

</head>
<div class="panel_view_details">
  <div class="table_p">
     <form method="post" id="treeview_form">
     <div class="row">
        
      
       
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

</html>