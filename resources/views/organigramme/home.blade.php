@extends('layouts.app')
@section('content')

<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>

	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">




    <link href="{{ asset('assets/css/bootstrap2.min.css') }}" rel="stylesheet" >

<link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
</style>

      <div class="header_view">
         <div class="sub_view"> <span class="title_profil"> Les plans de classement </span> </div>
      </div>
      <div class="panel_view_details">
         <div class="table_p">

            <div class="block_manager_datable">
                <a href="#" class="create_organi" aria-label="Close" data-toggle="modal" data-target="#exampleModal">creer un plan de classement </a>
            </div>

            <table id="organigramme_table" class=" table table-bordered text-center styled-table">
               <thead>
                   <tr>
                       <th scope="col">Num</th>
                       <th scope="col">Nom plan de classement</th>
                       <th scope="col">Action  </th>




                   </tr>
               </thead>
               <tbody>

                   <tr>
                       <th scope="row"></th>



                       <th scope="row"></th>




                       <td>
                           <a href="#" class="text-success mr-2">
                               <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                           </a>
                           <a href="#" class="text-danger mr-2">
                               <i class="nav-icon i-Close-Window font-weight-bold"></i>
                           </a>
                       </td>
                   </tr>


               </tbody>
           </table>

         </div>


      </div>







  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form  method="post" action="{{url('create_organigramme')}}">
            @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Créer un plan de classement</h5>
          <button type="button" class="close" data-dismiss="modal" >

          </button>
        </div>
        <div class="modal-body">
            <div class="panel_pop_up">


                    <div class="form-group">
                      <label for="nom_organigramme">Nom du plan de classement </label>
                      <input type="text" class="form-control" name="nom_organigramme"  id="nom_organigramme"  placeholder="Nom du organigramme" required="">

                    </div>




            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Créer</button>
        </div>
        </form>
      </div>
    </div>
  </div>



















   <script src="{{asset('assets/js/datatables.min.js')}}"></script>
      <script src="{{asset('assets/js/datatable_cv.js')}}"></script>

@endsection
