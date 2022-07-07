@extends('layouts.app')
@section('content')
<style>
   .panel_view_bottom {
   display: block;
   }
   .panel_view_bottom {
   height: 564px!important;
   }
</style>

      <div class="header_view">
         <div class="sub_view"> <span class="title_profil"> Mon profil</span> </div>
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
                     <select class="profil_entite" name="entite" value="{{ $user['entite'] }}" id="" size="5">
                        <option> PROJET 1</option>
                     </select>
                  </td>
               </tr>
               <tr >
                  <td ><button type="submit" class="btn_profil" href="http://">Valider</button></td>
                  <td class="left"> <a class="btn_profil" href="{{ route('home') }}">Annuler</a></td>
               </tr>
            </table>
          </form>
         </div>
      </div>

@endsection