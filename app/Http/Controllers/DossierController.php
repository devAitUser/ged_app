<?php

namespace App\Http\Controllers;
use App\Models\Dossier_champ;
use App\Models\Attribut_champ;
use App\Models\Organigramme;
use App\Models\Dossier;
use App\Models\User;
use App\Models\Attributs_dossier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Routing\UrlGenerator;
use Smalot\PdfParser\Parser;
use App\Models\File_searche;
use Illuminate\Support\Str;


use App\Models\Request_delete_dossier;

use App\Models\Entite;

use App\Models\Indexe;

use Illuminate\Http\Request;

use App\Models\Historique_dossier;

class DossierController extends Controller
{

    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->middleware('auth');
        $this->url = $url;
    }

    public function test (){
        $posts = File_searche::where('projet_id', '=', 1)->where('content', 'like', "%Je soussigné%")->get();

  $word= "Je soussigné";
        
 
            $arr_explode = [];
            $data =[];
            $text = "";        
     

                foreach($posts as $value) {
                    $content= preg_split('/\.|\?|!/', $value->content); 
                    $arr_explode = array_filter($content, function($element) use($word) {
                        return Str::contains($element, $word ,false);
                    });
                    $content_array = array_values(array_unique($arr_explode));
                    foreach( $content_array as  $content){
                        $w1 = "Je soussigné";
                        $w2 = "<strong>Je soussigné</strong>";
                        $str = str_replace($w1, $w2, $content); 

                        $text .= $str.'<br><br>';
                    }

                   

                    $createdAt = Carbon::parse($value->created_at);

                    $date = $createdAt->format('d/m/Y H:i:s');  

                    $data[] = array( 'date' => $date  , 'filename' => $value->filename , 'content' => $text , 'id_dossier' => $value->dossier_id  );
                }

                
        
        

      

        return Response()
        ->json(  $data  );

    }

    public function create_dossier(){

        $this->authorize('permission_creer_dossier');

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

        $all_index = Indexe::where(['dossier_id' => $request->id_dossier ])->get();

        return Response()
      ->json(['all_index' => $all_index ,'dossier_champs' => $dossier_champs ,'attribut_champ' => $attribut_champ  ,'dossier_champs_label' => $dossier_champs_label->nom_champs ]);

     }


     public function store_dossier(Request $request){

        $user = Auth::user();

        $dossier = new Dossier();
        $dossier->organigramme_id  = $request->id_organigramme;
        $dossier->user_id  = $user->id;
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

   
         if($request->file != null){
            for($i=0;$i<count($request->file);$i++){

                            
                    if($request->file[$i] != null){
                    
                
                        $attributs_dossier1 = new Attributs_dossier();
                        $attributs_dossier1->nom_champs  =  $request->nom_champ_file[$i];
                        $attributs_dossier1->valeur      =  $request->file('file')[$i]->store('files') ;
                        $attributs_dossier1->type_champs =   'Fichier' ;
                        $attributs_dossier1->dossier_id  =   $dossier->id;
                        $attributs_dossier1->save();


                        if($attributs_dossier1->valeur != ''){

                          
                    
                            $file =  new File_searche();
                            $file->filename   =  $attributs_dossier1->nom_champs ;
                            $file->content    =  $request->file_text[$i] ;
                            $file->dossier_id =  $dossier->id;
                            $file->attributs_dossiers_id =  $attributs_dossier1->id;
                            $file->projet_id =  $request->id_organigramme ;
                            $file->save();


                           
                           
                        
                            

                        }
                     
                        
                    }
                                
                
        

            }
        }


         return redirect('/show_dossier/'.$dossier->id); 
      
     }


     public function show_dossier($id){

        $check_demande_supperssion =  true;

    

        if (Request_delete_dossier::where('dossier_id', '=', $id )->count() > 0) {
             $check_demande_supperssion = false ;
         }
        



        $dossier = Dossier::find($id);
        $titre = '';

        $user =  Auth::user();
        $add_historique = new Historique_dossier();
        $add_historique->user = $user->identifiant;
        $add_historique->action = 'Consultation du dossier';
        $add_historique->dossier_id = $id;
        $add_historique->save();

        $attributs = $dossier->attibuts_dossier;
        $user_create_dossier = $dossier->user->identifiant;
        $date_create_dossier =  $dossier->created_at;
        $createdAt = Carbon::parse($date_create_dossier);

        $date_create_dossier = $createdAt->format('d/m/Y H:i:s');        

        $historique = Historique_dossier::where(['dossier_id' => $id  ])->get();

        $all_historiques = array();

        for($i=0;$i<count($historique);$i++){

            $createdAt = Carbon::parse($historique[$i]->created_at);

            $date = $createdAt->format('d/m/Y H:i:s');

            $all_historiques[] = array("user" => $historique[$i]->user , "action" => $historique[$i]->action ,
            "date" => $date );

        }

        

         

        

        $data = array("attributs" =>  $attributs , 'id' => $id , 'all_historiques' => $all_historiques ,
         "date_create_dossier" => $date_create_dossier , "user_create_dossier" => $user_create_dossier , "check_demande_supperssion" => $check_demande_supperssion  );

        return view('dossier.show',  $data);

     }


     public function historique_dossier(Request $request){

  

        $user =  Auth::user();
        $add_historique = new Historique_dossier();
        $add_historique->user = $user->identifiant;
        $add_historique->action = $request->text;
        $add_historique->dossier_id = $request->id_dossier;
        $add_historique->save();





     }


     public function all_dossier(){



   
       



        return view('dossier.all_dossier');
 

     }


     public function recherche_dossier() {

        $user = Auth::user();
        $id ='';

       if($user->projet_select_id != NULL) {

           $projet_select_id = $user->projet_select_id;

           $organigramme = Organigramme::find($projet_select_id);
           $id = $organigramme->id;
      
         

       }


       $user = Auth::user();

       $projet_select_id = $user->projet_select_id;

       $organigramme = Organigramme::find($projet_select_id);
     
        $dossiers = $organigramme->dossiers;


        $titre = '';

        $all_dossier = array();


        for($i=0;$i<count($dossiers);$i++){

                $count_check_item_next = 0 ;
                $check = 1 ;
                $all_dossier = Attributs_dossier::where(['dossier_id' => $dossiers[$i]->id  ])->get();

                $createdAt = Carbon::parse($dossiers[$i]->created_at);

                $date = $createdAt->format('d/m/Y H:i:s');  


                $user = User::find($dossiers[$i]->user_id);
                for($j=0;$j<count($all_dossier);$j++){
                    if( $all_dossier[$j]->type_champs == 'text'){
                            if($check == $count_check_item_next ){
                                $titre .= ' / ' ;
                                $check++;
                            }
                            $titre .= $all_dossier[$j]->valeur;
                            $count_check_item_next++;
                    }
                }

                $all_dossiers[] = array('id' => $dossiers[$i]->id , 'date' => $date , 'titre' =>  $titre , 'user' =>  $user->identifiant );
                $titre = '';
         }  

     
        $data = array( 'id_organigramme' => $id , 'all_dossiers' => $all_dossiers );



        return view('dossier.recherche',$data);

     }


     public function api_search_ocr(Request $request) {

        $posts = File_searche::where('projet_id', '=', $request->id_organigramme)->where('content', 'like', "%".$request->input_text."%")->get();




        function arr_filter($arr,$word_key) {
            $arr_explode = [];
            $data =[];
            $text = ""; 
              
            if($arr){

                foreach($arr as $value) {
                    $content= preg_split('/\.|\?|!/', $value->content); 
                    $arr_explode = array_filter($content, function($element) use($word_key) {
                        return Str::contains($element, $word_key ,true);
                    });

                    foreach ($content as $key) {

                        $word_uc =  ucfirst($word_key);
                        $word_lc =  lcfirst($word_key);

                        if (strpos($key, $word_lc ) !== false  || strpos($key, $word_uc ) !== false || strpos($key, $word_key ) !== false  ) {
                            $array_b[]= $key;

                        }
                      
                    }
                    $content_array = $content;
                    foreach( $array_b as  $content){
                        $w1 = $word_key;
                        $w2 = "<strong>".$word_key."</strong>";
                        $str = str_replace($w1, $w2, $content); 

                        $text .= $str.'<br>';
                    }

                    $print_content = '<div class="text-left">'.$text.'</div>';

                   

                    $createdAt = Carbon::parse($value->created_at);

                    $date = $createdAt->format('d/m/Y H:i:s');  

                    $data[] = array( 'date' => $date  , 'filename' => $value->filename , 'content' => $print_content , 'id_dossier' => $value->dossier_id  );
                }

            }        
            return   $data ;
        }

        $data_search =  arr_filter($posts,$request->input_text) ;

        return Response()
        ->json(  $data_search  );

     }


     public function recherche_ocr() {

        $user = Auth::user();
        $id ='';


        if($user->projet_select_id != NULL) {
 
            $projet_select_id = $user->projet_select_id;
 
            $organigramme = Organigramme::find($projet_select_id);
            $id = $organigramme->id;
       
          
 
        }

       
       


        $data = array( 'id_organigramme' => $id  );



        return view('dossier.recherche_ocr',$data);

     }


     public function api_all_dossier() {


        $user = Auth::user();

           $projet_select_id = $user->projet_select_id;

           $organigramme = Organigramme::find($projet_select_id);
         
        $dossiers = $organigramme->dossiers;


        $titre = '';

        $all_dossier = array();


        for($i=0;$i<count($dossiers);$i++){

            $count_check_item_next = 0 ;
            $check = 1 ;
            $all_dossier = Attributs_dossier::where(['dossier_id' => $dossiers[$i]->id  ])->get();

            $createdAt = Carbon::parse($dossiers[$i]->created_at);

            $date = $createdAt->format('d/m/Y H:i:s');  


            $user = User::find($dossiers[$i]->user_id);
            for($j=0;$j<count($all_dossier);$j++){
                if( $all_dossier[$j]->type_champs == 'text'){
                        if($check == $count_check_item_next ){
                            $titre .= ' / ' ;
                            $check++;
                        }
                        $titre .= $all_dossier[$j]->valeur;
                        $count_check_item_next++;
                }
            }

            $all_dossiers[] = array('id' => $dossiers[$i]->id , 'date' => $date , 'titre' =>  $titre , 'user' =>  $user->identifiant );
            $titre = '';
        }  

     

        return Response()
      ->json(  $all_dossiers  );


     }

     public function update_dossier($id,Request $request){


        $this->authorize('permission_Modifier_dossiers');

        $user =  Auth::user();
        $add_historique = new Historique_dossier();
        $add_historique->user = $user->identifiant;
        $add_historique->action = 'Modifier le dossier';
        $add_historique->dossier_id = $id;
        $add_historique->save();


        for($i=0;$i<count($request->id);$i++){
            $upd = Attributs_dossier::find($request->id[$i]);  
            $upd->valeur = $request->valeur[$i];
            $upd->save();
        }

        return redirect(route('show_dossier',$id)); 

     }


     public function delete_dossier($id){

        $this->authorize('permission_Modifier_dossiers');

        $delete = Dossier::find($id);  
        $delete->delete();

        return redirect('/all_dossier'); 

     }

     public function search_dossier(Request $request){
 

        $user = Auth::user();

        $projet_select_id = $user->projet_select_id;

        $count_dossier=0;

        $nom_champ = '';
        $word ='';

        $check_input = false;

        $all_dossiers = array();

        if(isset($request->nom_champ)){
            for($o=0;$o<count($request->nom_champ);$o++){
                if($request->valeur[$o] != null){
                    $word = $request->valeur[$o];
                    $nom_champ = $request->nom_champ[$o];
                } 
            }
        }

        if($request->titre == ''){
            $check_input = true;
        }


        if($word == ''){
            $word = $request->titre;
        }


       
        $array_search = array();

        function like($str, $searchTerm) {
            $searchTerm = strtolower($searchTerm);
            if($searchTerm != ''){

                $str = strtolower($str);
                $pos = strpos($str, $searchTerm);
                if ($pos === false)
                    return false;
                else
                    return true;

            } else {
                return false;
            }
           
        }


       $dossiers = Dossier::query()->where([ 'organigramme_id' =>  $projet_select_id ])->get() ;
       $titre = '';

            for($i=0;$i<count($dossiers);$i++){

                if($nom_champ != ''){

                $attributs_dossiers = Attributs_dossier::query()->where([ 'dossier_id' =>  $dossiers[$i]->id , 'nom_champs' => $nom_champ ])->get() ;

                 } else {
                    $attributs_dossiers = Attributs_dossier::query()->where([ 'dossier_id' =>  $dossiers[$i]->id  ])->get() ;
                 }

                for($j=0;$j<count($attributs_dossiers);$j++){
                    $found = like($attributs_dossiers[$j]->valeur, $word);
                   if($found){
                    $array_search[] = $attributs_dossiers[$j];

                    $dossiers_s = dossier::find($attributs_dossiers[$j]->dossier_id);

                    

                        $count_check_item_next = 0 ;
                        $check = 1 ;

                            $all_dossier = Attributs_dossier::where(['dossier_id' => $dossiers_s->id   ])->get();
                      

                        $createdAt = Carbon::parse($dossiers_s->created_at);

                        $date = $createdAt->format('d/m/Y H:i:s');  

                        $user = User::find($dossiers_s->user_id);
                        for($e=0;$e<count($all_dossier);$e++){
                         
                            if( $all_dossier[$e]->type_champs == 'text' ){
                                    if($check == $count_check_item_next ){
                                        $titre .= ' / ' ;
                                        $check++;
                                    }
                                    $titre .= $all_dossier[$e]->valeur;
                                    $count_check_item_next++;
                            }
                        }
                        $count_dossier++;
            
                        $all_dossiers[] = array('id' => $dossiers[$i]->id , 'date' => $date , 'titre' =>  $titre , 'user' =>  $user->identifiant );
                        $titre = '';
            
                      
                    

                   } else {
                    
                   }
                }
             
            }
          
            $data = array( 'all_dossiers' => $all_dossiers , 'count' => $count_dossier , 'check_input' => $check_input  );
            
            return view('dossier.search_dossier',$data);


     }



     public function api_search_table(Request $request){


        $user = Auth::user();

        $projet_select_id = $user->projet_select_id;

        $count_dossier=0;

        $nom_champ = '';
        $word ='';

        $check_input = false;

        $all_dossiers = array();

        if(isset($request->nom_champ)){
            for($o=0;$o<count($request->nom_champ);$o++){
                if($word == '' ){
                    $word = $request->valeur[$o];
                    $nom_champ = $request->nom_champ[$o];
                } 
            }
        }

       


       
        $array_search = array();

        function like($str, $searchTerm) {
            $searchTerm = strtolower($searchTerm);
            if($searchTerm != ''){

                $str = strtolower($str);
                $pos = strpos($str, $searchTerm);
                if ($pos === false)
                    return false;
                else
                    return true;

            } else {
                return false;
            }
           
        }


       $dossiers = Dossier::query()->where([ 'organigramme_id' =>  $projet_select_id ])->get() ;
       $titre = '';

            for($i=0;$i<count($dossiers);$i++){

                $attributs_dossiers = Attributs_dossier::query()->where([ 'dossier_id' =>  $dossiers[$i]->id , 'nom_champs' => $nom_champ ])->get() ;

                

                for($j=0;$j<count($attributs_dossiers);$j++){
                    $found = like($attributs_dossiers[$j]->valeur, $word);
                   if($found){
                    $array_search[] = $attributs_dossiers[$j];

                    $dossiers_s = dossier::find($attributs_dossiers[$j]->dossier_id);

                    

                        $count_check_item_next = 0 ;
                        $check = 1 ;

                            $all_dossier = Attributs_dossier::where(['dossier_id' => $dossiers_s->id   ])->get();
                      

                        $createdAt = Carbon::parse($dossiers_s->created_at);

                        $date = $createdAt->format('d/m/Y H:i:s');  

                        $user = User::find($dossiers_s->user_id);
                        for($e=0;$e<count($all_dossier);$e++){
                         
                            if( $all_dossier[$e]->type_champs == 'text' ){
                                    if($check == $count_check_item_next ){
                                        $titre .= ' / ' ;
                                        $check++;
                                    }
                                    $titre .= $all_dossier[$e]->valeur;
                                    $count_check_item_next++;
                            }
                        }
                        $count_dossier++;
            
                        $all_dossiers[] = array('id' => $dossiers[$i]->id , 'date' => $date , 'titre' =>  $titre , 'user' =>  $user->identifiant );
                        $titre = '';
            
                      
                    

                   } else {
                    
                   }
                }
             
            }
          
            $data = array( 'all_dossiers' => $all_dossiers , 'count' => $count_dossier , 'check_input' => $check_input  );

            return Response()
            ->json(  $data  );


     }

     public function creer_entite(Request $request){

         $new = new Entite();

         $new->nom = $request->nom;
         $new->organigramme_id = $request->id_organigramme;

         $new->save();


         $data = array( 'status' => true , 'entite' => $new  );


         return Response()
            ->json(  $data   );

     }

     public function uploud_pdf_temp(Request $request){

 
        $data=  $request->file('data')->store('file_pdf_temp');


        
        return Response()
        ->json(  $data   );


     }


     public function remove_temp_file(Request $request){

        $file= $request->link_file;

        unlink(storage_path('app/public/file_pdf_temp/'.$file));


     }


     public function request_delete_dossier(Request $request){


        return view('dossier.request_delete');


     }


     public function api_request_delete_dossier(Request $request){

         $Request_delete_dossier = Request_delete_dossier::all();

         $all =array();


         for($i=0;$i<count($Request_delete_dossier);$i++){

            $createdAt = Carbon::parse($Request_delete_dossier[$i]->created_at);

            $date = $createdAt->format('d/m/Y H:i:s'); 
          
     
            $all[] = array('id' => $Request_delete_dossier[$i]->id , 'name_user' => $Request_delete_dossier[$i]->name_user ,
             'dossier_id' =>  $Request_delete_dossier[$i]->dossier_id ,   'motif' =>  $Request_delete_dossier[$i]->motif ,
              'date' =>  $date );

         
         }
    


 

        return $all;


     }


     public function request_decision_user(Request $request){

       

       if($request->decision == 'accepter'){

        $dossier = Dossier::find($request->dossier_id);
        $dossier->delete();
        $Request_delete_dossier = Request_delete_dossier::find($request->id_request);
        $Request_delete_dossier->delete();
        }

        if($request->decision == 'rejeter'){

          $Request_delete_dossier = Request_delete_dossier::find($request->id_request);
          $Request_delete_dossier->delete();

        }


       return Response()
        ->json(['etat' => true]);



     }


     public function demande_suppression(Request $request){

        $user = Auth::user();

        $add_historique = new Historique_dossier();
        $add_historique->user = $user->identifiant;
        $add_historique->action = 'Demande de suppression du dossier';
        $add_historique->dossier_id = $request->id_dossier;
        $add_historique->save();
       
        $Request_delete_dossier = new Request_delete_dossier();

        $Request_delete_dossier->name_user  =  $user->identifiant;
        $Request_delete_dossier->motif      =  $request->motif;
        $Request_delete_dossier->dossier_id =  $request->id_dossier;

        $Request_delete_dossier->save();


      
         return redirect('/show_dossier/'.$request->id_dossier); 

 
 
 
      }








}