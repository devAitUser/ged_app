<?php

namespace App\Http\Controllers;
use App\Models\Dossier_champ;
use App\Models\Attribut_champ;
use App\Models\Organigramme;
use App\Models\Dossier;
use App\Models\Attributs_dossier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DossierController extends Controller
{
    public function create_dossier(){

        $user = Auth::user();
         $id ='';

        if($user->projet_select_id != NULL) {

            $projet_select_id = $user->projet_select_id;

            $organigramme = Organigramme::find($projet_select_id);
            $id = $organigramme->id;
       
          

        }

      
        $data = array( 'id_organigramme' => $id );

        return view('dossier.create',$data);

    }

    public function fill_parent_dossier(){

        $user = Auth::user();
        $id ='';
        $dossier_champs = array();
        $les_dossiers  = '';

       if($user->projet_select_id != NULL) {

           $projet_select_id = $user->projet_select_id;
           $dossiers_voir = $user->projet;

            $organigramme = Organigramme::find($projet_select_id);
            $id = $organigramme->id;

           

           for($j=0;$j<count($dossiers_voir);$j++){ 

               if($dossiers_voir[$j]['organigrammes_id']== $id ){
                   $les_dossiers  =  $dossiers_voir[$j]['dossiers'];
               }

           }


           if( $les_dossiers!= '' ){
                  $id_dossier=  json_decode($les_dossiers, true);
                $dossier_champs = DB::table('dossier_champs')->whereIn('id', $id_dossier)->get();

           }else {

                $dossier_champs = Dossier_champ::where([
                'organigramme_id' =>  $id ,
                'parent_id' => 0,
           
                ])->get();


           }

        



           
      
         

       }



     


        


        return Response()
        ->json($dossier_champs );

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
        $dossier->organigramme_id  = $request->id_organigramme;
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
        $titre = '';

        $attributs = $dossier->attibuts_dossier;

        for($i=0;$i<count($attributs);$i++){
                if($attributs[$i]->type_champs == "textarea"){
                $titre =  $attributs[$i]->valeur ;
                }
        }


        $data = array("attributs" =>  $attributs , 'titre' => $titre );

        return view('dossier.show',  $data);

     }


     public function all_dossier(){

            
        $organigramme = Organigramme::take(1)->first();
        $dossiers = $organigramme->dossiers;

        $all_dossier = array();


        for($i=0;$i<count($dossiers);$i++){

            $all_dossier = Attributs_dossier::where(['dossier_id' => $dossiers[$i]->id  ])->get();

            for($j=0;$j<count($all_dossier);$j++){
                if( $all_dossier[$j]->type_champs == 'textarea'){
                        $titre = $all_dossier[$j]->valeur ;
                }
            }

            $all_dossiers[] = array('id' => $dossiers[$i]->id , 'date' => $dossiers[$i]->created_at , 'titre' =>  $titre);

        }  

   
        $data = array( 'dossiers' => $all_dossiers );



        return view('dossier.all_dossier',$data);
 

     }


     public function recherche_dossier() {

        $user = Auth::user();
        $id ='';

       if($user->projet_select_id != NULL) {

           $projet_select_id = $user->projet_select_id;

           $organigramme = Organigramme::find($projet_select_id);
           $id = $organigramme->id;
      
         

       }

     
       $data = array( 'id_organigramme' => $id );



        return view('dossier.recherche',$data);

     }





}
