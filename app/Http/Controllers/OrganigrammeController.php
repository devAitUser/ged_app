<?php

namespace App\Http\Controllers;

use App\Models\Dossier_champ;

use Illuminate\Http\Request;

class OrganigrammeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {

        
        return view(' organigramme.index');

    }

    public function test_ajax()
    {

        
        return Response()->json( 'ok' );

    }

    public function get_node_data($parent_id){


        $dossier_parent = Dossier_champ::where('parent_id', '=', $parent_id)->get(); 

        $output = array();
        for($i=0;$i<count($dossier_parent);$i++)
        {
            $sub_array = array ();
            $sub_array['id_node'] = $dossier_parent[$i]->parent_id ;
            $sub_array['text'] = $dossier_parent[$i]->nom_champs.'<a href="" class="prevent-default" onClick="removeRow(event,'.$dossier_parent[$i]->id. ' )" ><span    class="material-icons btn_delete"> delete </span></a>'; 
            $sub_array['nodes'] = array_values($this->get_node_data( $dossier_parent[$i]->id   ))  ; 
            $output[] = $sub_array;
        }

        return $output;


    }


    public function array_organigramme()
    {

        $parent_id=0;
        $all_dossier = Dossier_champ::all();
        $data = array();

        foreach ($all_dossier as $row) {
            $data = $this->get_node_data($parent_id);
         }
        
         return Response()->json( array_values($data) );

       
        

    }


    public function array_organigramme_simple()
    {

        $parent_id=0;
        $all_dossier = Dossier_champ::all();

  
        
         return Response()->json( $all_dossier );

       
        

    }


    
 


 


    public function all_data_select()
    {

        $parent_id=0;
        $all_dossier = Dossier_champ::all();

        

        $output  = '<select  id="select_tree"  name="select_tree">';

      

        foreach ($all_dossier as $row) {
            if($row["parent_id"]== 0){
                $output .= '<option value="'.$row["id"].'"  >'.$row["nom_champs"].'</option>';
            }else{
                $output .= '<option value="'.$row["id"].'" data-parent="'.$row["parent_id"].'" >'.$row["nom_champs"].'</option>';
            }
        
         }

         $output  .= '</select>';
  
        echo $output ;
        

    }

    public function store_dossier(Request $request)
    {

        $all_dossier = Dossier_champ::all();

        $new_dossier = new Dossier_champ();

        if (count($all_dossier) == 0) {
            $new_dossier->parent_id = 0;
        }
        else{
            $new_dossier->parent_id = $request->input('select_tree');
        }
      
        $new_dossier->nom_champs = $request->input('dossier_champs');
        $new_dossier->save();



        return Response()
        ->json(['etat' => true]);

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
        

    
    
}
