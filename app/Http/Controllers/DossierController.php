<?php

namespace App\Http\Controllers;
use App\Models\Dossier_champ;
use App\Models\Attribut_champ;
use App\Models\Organigramme;

use Illuminate\Http\Request;

class DossierController extends Controller
{
    public function create_dossier(){

        $user = Dossier_champ::take(1)->first();


        return view('dossier.create');

    }

    public function fill_parent_dossier(){

        $organigramme = Organigramme::take(1)->first();

        $dossier_champs = Dossier_champ::where([
            'organigramme_id' => $organigramme->id ,
            'parent_id' => 0,
       
        ])->get();


        return Response()
        ->json($dossier_champs);

    }

    public function fill_sous_dossier(Request $request){

          $dossier_champs = Dossier_champ::where(['parent_id' => $request->id_dossier ])->get();

          $dossier_champs_label = Dossier_champ::find($request->id_dossier);

          return Response()
          ->json(['dossier_champs' => $dossier_champs ,'dossier_champs_label' => $dossier_champs_label->nom_champs ]);

    }

    public function fill_sous_dossier1(Request $request){

        $dossier_champs = Dossier_champ::where(['parent_id' => $request->id_dossier ])->get();

        $attribut_champ = Attribut_champ::where(['dossier_champs_id' => $request->id_dossier ])->get();
        $dossier_champs_label = Dossier_champ::find($request->id_dossier);

     

        return Response()
      ->json(['dossier_champs' => $dossier_champs ,'attribut_champ' => $attribut_champ  ,'dossier_champs_label' => $dossier_champs_label->nom_champs ]);

     }



}
