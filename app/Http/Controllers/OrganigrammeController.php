<?php

namespace App\Http\Controllers;

use App\Models\Dossier_champ;
use App\Models\Organigramme;
use App\Models\Attribut_champ;

use Illuminate\Http\Request;

class OrganigrammeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    

    public function home_organigramme()
    {

        
        return view('organigramme.home');

    }

    public function get_node_data($parent_id,$organigramme_id){


        $dossier_parent = Dossier_champ::where('parent_id', '=', $parent_id)->get(); 
        $dossier_attributs = Attribut_champ::where('dossier_champs_id', '=', $parent_id)->get(); 
        $output = array();

        if (count( $dossier_parent ) == 0 ) {
            
         } else 
         {
            for($i=0;$i<count($dossier_parent);$i++)
            {
             
    
                
                        if($dossier_parent[$i]->organigramme_id == $organigramme_id){
    
                            $sub_array = array ();
                            $sub_array['id_node'] = $dossier_parent[$i]->parent_id ;
                            $sub_array['text'] = $dossier_parent[$i]->nom_champs.'<a href="" class="prevent-default" onClick="removeRow(event,'.$dossier_parent[$i]->id. ' )" ><span    class="material-icons btn_delete"> delete </span></a>'; 
                            $sub_array['nodes'] = array_values($this->get_node_data( $dossier_parent[$i]->id , $organigramme_id  ))  ; 

                            $output[] = $sub_array;
    
                        }
    
                   
                
                
             
            }
         }


         if (count( $dossier_attributs ) == 0 ) {
            
        } else 
        {
           for($i=0;$i<count($dossier_attributs);$i++)
           {
                               $sub_array = array ();
                               $sub_array['text'] = $dossier_attributs[$i]->id.'<a href="" class="prevent-default" onClick="removeRow(event,1 )" >rzerezrz<span    class="material-icons btn_delete"> border_color </span> Modifier les attributs</a>'; 
                               $sub_array['nodes'] = array() ; 
                               $output[] = $sub_array;
   

           }
        }



       

   
        return $output;


    }


    public function array_organigramme(Request $request)
    {

        $parent_id=0;
        $organigramme_id =1;
        $all_dossier = Dossier_champ::all();
        $organigramme_id = $request->input('organigramme_id');
        $data = array();

        foreach ($all_dossier as $row) {
            $data = $this->get_node_data($parent_id,$organigramme_id);
         }
        
         return Response()->json( array_values($data) );

       
        

    }


    public function array_organigramme_simple()
    {

        $parent_id=0;
        $all_dossier = Dossier_champ::all();

  
        
         return Response()->json( $all_dossier );

       
        

    }


    
 


 


    public function all_data_select(Request $request)
    {

        $parent_id=0;
        $all_dossier = Dossier_champ::all();
        $organigramme_id = $request->input('organigramme_id');
        $type_btn = $request->input('type_btn');
        

        
        $output  = '<select  id="select_tree"  name="select_tree">';

        if( $type_btn == 'btn_sous_dossier' ){


            foreach ($all_dossier as $row) {
    
                if( $row["organigramme_id"] ==  $organigramme_id ){
    
                    if($row["parent_id"]== 0 ){
                        $output .= '<option value="'.$row["id"].'"  >'.$row["nom_champs"].'</option>';
                    }else{
                        $output .= '<option value="'.$row["id"].'" data-parent="'.$row["parent_id"].'" >'.$row["nom_champs"].'</option>';
                     
                    }
    
                 }
            
             }
    
         

        }

        $output  .= '</select>';


  
        echo $output ;
        

    }

    public function store_dossier(Request $request)
    {

        $check =false;
        
        $check_add =false;

        $type_dossier = $request->input('type_dossier');

        $id = $request->input('select_tree');

        $check_have_attribut = Attribut_champ::where('dossier_champs_id', '=', $id )->get(); 

        if (count( $check_have_attribut ) == 0 ) {
            $check = false;
         } else 
         {
            $check = true;
         }



         if(!$check){

            

            $all_dossier = Dossier_champ::all();

                $type_dossier = $request->input('type_dossier');

                $new_dossier = new Dossier_champ();
            

                if( $type_dossier  ==  "btn_dossier" ){
                    $new_dossier->parent_id = 0;
                } 
                if( $type_dossier  ==  "btn_sous_dossier" ){
                    $new_dossier->parent_id = $request->input('select_tree'); 
                }

                $new_dossier->nom_champs = $request->input('dossier_champs');

            
                $new_dossier->organigramme_id = $request->input('id_organigramme');
                $new_dossier->save();

                $check_add = true;

                function is_array_empty($arr){
                    if(is_array($arr)){
                    foreach($arr as $value){
                        if(!empty($value)){
                            return true;
                        }
                    }
                    }
                    return  false;
                }
                

                if (is_array_empty($request->name_champ)) {

                    for($i=0;$i<count($request->input('name_champ'));$i++){
                        $attribut_champ = new Attribut_champ();
                        $attribut_champ->dossier_champs_id = $new_dossier->id;
                        $attribut_champ->nom_champs = $request->name_champ[$i];
                        $attribut_champ->type_champs = $request->type_champ[$i];
                        $attribut_champ->save();
                    }   
                }
                
            }

        return Response()
        ->json(['etat' => $check_add , 'check_sub_dossier' => $check , 'type_dossier' => $type_dossier   ]);

    }



    
    public function delete_dossier(Request $request)
    {

    

        $array_id = $request->input('items_delete');

        for ($i=0; $i < count($array_id)  ; $i++) { 
               
            $delete_dossier= Dossier_champ::find($array_id[$i]);  
           $delete_dossier->delete();

        }

        return  Response()
        ->json(['etat' => true]);

    }


    public function table_organigramme(){

        $table_organigramme= Organigramme::all();  

    
        return  Response()
        ->json($table_organigramme);
        
    }

    public function create_organigramme(Request $request){

        $new_organigramme = new Organigramme();

      
      
        $new_organigramme->nom = $request->input('nom_organigramme');
        $new_organigramme->save();

        return redirect()->route('home_organigramme');
        
    }


    public function delete_organigramme_item(Request $request){

            $delete_organigramme= Organigramme::find($request->input('items_delete'));  
            $delete_organigramme->delete();

            $data_organigramme = Organigramme::all();  
       

            return  Response()
            ->json(['etat' => true , 'data' =>  $data_organigramme  ]);
        
    }
        
    public function edit_organigramme($id){

        $item_organigramme= Organigramme::find($id);   
            
     
        $data = array( "nom" => $item_organigramme['nom'] , "id" => $id , );
        return view(' organigramme.edit' ,$data)  ; 
    
     }



     public function check_have_parent(Request $request){

        $all_dossier = Dossier_champ::all();
        $organigramme_id = $request->input('organigramme_id');
        $check = false;
            foreach ($all_dossier as $row) {
                if( $row["organigramme_id"]==  $organigramme_id ){
               
                        $check = true;
                    
                 }
             }
             return  Response()
             ->json(['etat' => $check  ]);
     }

     
     public function check_have_attributs(Request $request){


        $check =false;

        $id = $request->input('select_tree');

        $check_have_attribut = Attribut_champ::where('dossier_champs_id', '=', $id )->get(); 

        if (count( $check_have_attribut ) == 0 ) {
            $check = false;
         } else 
         {
            $check = true;
         }

        
         return  Response()
         ->json(['etat' => $check  ]);

      
      }
        

    
    
}
