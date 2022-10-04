@extends('layouts.app')
@section('content')
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
   button.btn_profil {
    border: none;
   }
   .panel-heading {
    width: 80% !important;
   }
</style>

  
      <div class="panel-heading">   
         Mon profil
      </div>
      <div class="panel_view_details">
         <div class="table_p">
         <form action="{{route('user_profile_update')}}"  method="post">
            @csrf
            <table class="tbl_profil">
               <tr>
                  <td class="td_1">Identifiant :</td>
                  <td> <input type="text" class="input_prof"  value="{{ $user['identifiant'] }}"  disabled> </td>
               </tr>
               <tr>
                  <td class="td_1">Mot de passe  :</td>
                  <td> <input type="text" class="input_prof"  name="mot_de_pass" > </td>
               </tr>
               <tr>
                  <td class="td_1">Confirmer le mot de passe  :</td>
                  <td> <input type="text" class="input_prof" > </td>
               </tr>
               <tr>
                  <td class="td_1">Nom  :</td>
                  <td> <input type="text" class="input_prof" name="nom" value="{{ $user['nom'] }}" disabled> </td>
               </tr>
               <tr>
                  <td class="td_1">Prénom   :</td>
                  <td> <input type="text" class="input_prof" name="prenom" value="{{ $user['prenom'] }}" disabled> </td>
               </tr>
               <tr>
                  <td class="td_1">Numéro de téléphone : </td>
                  <td> <input type="text" class="input_prof" name="telephone" value="0{{ $user['telephone'] }}"  > </td>
               </tr>
               <tr>
                  <td class="td_1">Adresse mail : </td>
                  <td> <input type="text" class="input_prof" name="email" value="{{ $user['email'] }}"  > </td>
               </tr>
               <tr class="bottom_tr">
                  <td class="td_1">Entités : </td>
                  <td>
                     <select class="profil_entite" name="projet_user" value="{{ $user['entite'] }}" id="" size="5">
                  

                        <?php for($i=0;$i<count($projets);$i++){ ?>
                                  
                                             
                           <?php if($projets[$i]['id'] == $user['projet_select_id'] ) {  ?>
                                 <option value="<?php echo $projets[$i]['id']; ?>" selected><?php echo $projets[$i]['nom']; ?></option>
                                 <?php  } else {  ?>
                                 <option value="<?php echo $projets[$i]['id']; ?>" ><?php echo $projets[$i]['nom']; ?></option>
                                 <?php  } ?>
                  
          
                            <?php  } ?>
                       
                     </select>
                  </td>
               </tr>
               <tr >
                  <td ><button type="submit" class="btn_profil" >Valider</button></td>
                  <td class="left"> <button class="btn_profil" href="{{ route('home') }}">Annuler</button></td>
               </tr>
            </table>
          </form>
         </div>
      </div>

@endsection