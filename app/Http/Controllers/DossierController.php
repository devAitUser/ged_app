<?php

namespace App\Http\Controllers;
use App\Models\Dossier_champ;
use App\Models\Attribut_champ;
use App\Models\Organigramme;
use App\Models\Dossier;
use App\Models\Attributs_dossier;
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


     public function store_dossier(Request $request){


        $dossier = new Dossier();
        
        $dossier->save();


        for($i=0;$i<count($request->input('value_select'));$i++){
            $attributs_dossier = new Attributs_dossier();
            $dossier_ = Dossier_champ::find( $request->value_select[$i] );
            $attributs_dossier->nom_champs  = $request->nom_champs_select[$i] ;
            $attributs_dossier->valeur      = $dossier_->nom_champs;
            $attributs_dossier->type_champs = 'select' ;
            $attributs_dossier->dossier_id  = $dossier->id;
            $attributs_dossier->save();
        }  


         for($i=0;$i<count($request->input('nom_champ'));$i++){
             
                      if($request->valeur[$i] != null ){

                        $attributs_dossier = new Attributs_dossier();
                        $attributs_dossier->nom_champs  = $request->input('nom_champ')[$i]   ;
                        $attributs_dossier->valeur      = $request->valeur[$i];
                        $attributs_dossier->type_champs = $request->type_champ[$i] ;
                        $attributs_dossier->dossier_id  = $dossier->id;
                        $attributs_dossier->save();
                        
                        }

         }  

   

        for($i=0;$i<count($request->file);$i++){

                        
                if($request->file[$i] != null){
                
               
                    $attributs_dossier1 = new Attributs_dossier();
                    $attributs_dossier1->nom_champs  =  $request->nom_champ_file[$i];
                    $attributs_dossier1->valeur      =  $request->file('file')[$i]->store('files') ;
                    $attributs_dossier1->type_champs =   'Fichier' ;
                    $attributs_dossier1->dossier_id  =   $dossier->id;
                    $attributs_dossier1->save();
                    
                }
                            
            
    

        }


        $attributs_dossier1 = new Attributs_dossier();
        $attributs_dossier1->nom_champs  =  'TITRE' ;
        $attributs_dossier1->valeur      =   $request->input('titre');
        $attributs_dossier1->type_champs =   'textarea' ;
        $attributs_dossier1->dossier_id  =   $dossier->id;
        $attributs_dossier1->save();

         return redirect('/show_dossier/'.$dossier->id); 
      
     }


     public function show_dossier($id){

        $dossier = Dossier::find($id);


     $attributs = $dossier->attibuts_dossier;

     $data = array("attributs" =>  $attributs  );

        return view('dossier.show',  $data);

     }





}
