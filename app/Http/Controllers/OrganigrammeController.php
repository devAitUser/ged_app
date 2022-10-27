<?php
namespace App\Http\Controllers;

use App\Models\Dossier_champ;
use App\Models\Organigramme;
use App\Models\Attribut_champ;
use App\Models\Entite;
use Illuminate\Http\Request;
use App\Models\Indexe;
use Illuminate\Support\Facades\Auth;
use PDF;


class OrganigrammeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home_organigramme()
    {
        $this->authorize('permission_plan_classements');

        return view('organigramme.home');

    }

    public function home_organigramme_view()
    {

        $this->authorize('Voir_plan_classement');

        return view('organigramme_view.home');

    }

    

    public function get_node_data($parent_id, $organigramme_id, $entite_organigramme)
    {

        $dossier_parent = Dossier_champ::query()->where(['parent_id' => $parent_id, 'entite_id' => $entite_organigramme])->get();

        $dossier_attributs = Attribut_champ::where('dossier_champs_id', '=', $parent_id)->get();
        $output = array();

        if (count($dossier_parent) == 0)
        {

        }
        else
        {
            for ($i = 0;$i < count($dossier_parent);$i++)
            {

                if ($dossier_parent[$i]->organigramme_id == $organigramme_id)
                {
                    $check_attributs = Attribut_champ::where('dossier_champs_id', '=', $dossier_parent[$i]->id)
                        ->get();
                    $sub_array = array();
                    $sub_array['id_node'] = $dossier_parent[$i]->parent_id;
                    if (count($check_attributs) == 0)
                    {
                        $sub_array['text'] = $dossier_parent[$i]->nom_champs . '<a href="" class="prevent-default" onClick="removeRow(event,' . $dossier_parent[$i]->id . ' )" ><span    class="material-icons btn_delete"> delete </span></a>';
                    }
                    else
                    {
                        $sub_array['text'] = $dossier_parent[$i]->nom_champs . '<a href="" class="prevent-default" onClick="removeRow(event,' . $dossier_parent[$i]->id . ' )" ><span    class="material-icons btn_delete"> delete </span></a><a href="" class="prevent-default" data-toggle="modal" data-target="#panel_attributs" onClick="editRow_organi(event,' . $dossier_parent[$i]->id . ' )" ><span    class="material-icons btn_edit"> border_color </span></a>';
                    }

                    $sub_array['nodes'] = array_values($this->get_node_data($dossier_parent[$i]->id, $organigramme_id, $entite_organigramme));

                    $output[] = $sub_array;

                }

            }
        }

        if (count($dossier_attributs) == 0)
        {

        }
        else
        {
            $attributs_f = '';
            for ($i = 0;$i < count($dossier_attributs);$i++)
            {
                if ($dossier_attributs[$i]->type_champs == 'Fichier')
                {
                    $attributs_f .= '<span class="material-icons icon_file_organi">description</span>' . $dossier_attributs[$i]->nom_champs . ',';
                }
            }
            if ($attributs_f != '')
            {
                $sub_array = array();
                $sub_array['text'] = $attributs_f . '<a href="" class="prevent-default" onClick="removeRow(event,1 )" > </a>';
                $output[] = $sub_array;
            }
        }

        return $output;

    }


    public function get_node_data_view($parent_id, $organigramme_id, $entite_organigramme)
    {

        $dossier_parent = Dossier_champ::query()->where(['parent_id' => $parent_id, 'entite_id' => $entite_organigramme])->get();

        $dossier_attributs = Attribut_champ::where('dossier_champs_id', '=', $parent_id)->get();
        $output = array();

        if (count($dossier_parent) == 0)
        {

        }
        else
        {
            for ($i = 0;$i < count($dossier_parent);$i++)
            {

                if ($dossier_parent[$i]->organigramme_id == $organigramme_id)
                {
                    $check_attributs = Attribut_champ::where('dossier_champs_id', '=', $dossier_parent[$i]->id)
                        ->get();
                    $sub_array = array();
                    $sub_array['id_node'] = $dossier_parent[$i]->parent_id;
                    if (count($check_attributs) == 0)
                    {
                        $sub_array['text'] = $dossier_parent[$i]->nom_champs ;
                    }
                    else
                    {
                        $sub_array['text'] = $dossier_parent[$i]->nom_champs ;
                    }

                    $sub_array['nodes'] = array_values($this->get_node_data_view($dossier_parent[$i]->id, $organigramme_id, $entite_organigramme));

                    $output[] = $sub_array;

                }

            }
        }

        if (count($dossier_attributs) == 0)
        {

        }
        else
        {
            $attributs_f = '';
            for ($i = 0;$i < count($dossier_attributs);$i++)
            {
                if ($dossier_attributs[$i]->type_champs == 'Fichier')
                {
                    $attributs_f .= '<span class="material-icons icon_file_organi">description</span>' . $dossier_attributs[$i]->nom_champs . ',';
                }
            }
            if ($attributs_f != '')
            {
                $sub_array = array();
                $sub_array['text'] = $attributs_f . '<a href="" class="prevent-default" onClick="removeRow(event,1 )" > </a>';
                $output[] = $sub_array;
            }
        }

        return $output;

    }

    public function array_organigramme(Request $request)
    {

        $parent_id = 0;
        $organigramme_id = 1;
        $all_dossier = Dossier_champ::all();

        $organigramme_id = $request->input('organigramme_id');
        $all_entite = Entite::where('organigramme_id', '=', $organigramme_id)->get();
        $data = array();

        foreach ($all_entite as $entite)
        {

            if (Dossier_champ::where('entite_id', '=', $entite->id)
                ->count() > 0)
            {

                foreach ($all_dossier as $row)
                {

                    $data = $this->get_node_data($parent_id, $organigramme_id, $entite->id);

                }
                $output[] = array(
                    'name_entite' => $entite->nom,
                    'dossiers' => $data
                );
            }

        }

        return Response()->json($output);

    }

    public function array_organigramme_view(Request $request)
    {

        $parent_id = 0;
        $organigramme_id = 1;
        $all_dossier = Dossier_champ::all();

        $organigramme_id = $request->input('organigramme_id');
        $all_entite = Entite::where('organigramme_id', '=', $organigramme_id)->get();
        $data = array();

        foreach ($all_entite as $entite)
        {

            if (Dossier_champ::where('entite_id', '=', $entite->id)
                ->count() > 0)
            {

                foreach ($all_dossier as $row)
                {

                    $data = $this->get_node_data_view($parent_id, $organigramme_id, $entite->id);

                }
                $output[] = array(
                    'name_entite' => $entite->nom,
                    'dossiers' => $data
                );
            }

        }

        return Response()->json($output);

    }

    public function array_organigramme_simple()
    {

        $parent_id = 0;
        $all_dossier = Dossier_champ::all();

        return Response()->json($all_dossier);

    }

    public function fill_drop_down_parent()
    {

        $parent_id = 0;
        $all_dossier = Dossier_champ::all();
        $organigramme_id = $request->input('organigramme_id');
        $type_btn = $request->input('type_btn');

        if ($type_btn == 'btn_sous_dossier' || $type_btn == 'btn_piece_joint')
        {

            foreach ($all_dossier as $row)
            {

                if ($row["organigramme_id"] == $organigramme_id)
                {

                    if ($row["parent_id"] == 0)
                    {
                        $output .= '<option value="' . $row["id"] . '"  >' . $row["nom_champs"] . '</option>';
                    }
                    else
                    {
                        $output .= '<option value="' . $row["id"] . '" data-parent="' . $row["parent_id"] . '" >' . $row["nom_champs"] . '</option>';

                    }

                }

            }

        }

        echo $output;

    }

    public function fill_drop_down_dossier(Request $request)
    {

        $all_dossier = Dossier_champ::all();
        $organigramme_id = $request->input('organigramme_id');

        $data = array();

        $ajax_option = '';

        foreach ($all_dossier as $row)
        {

            if ($row["organigramme_id"] == $organigramme_id)
            {

                if ($row["parent_id"] == 0)
                {

                    $ajax_option .= '<option value="' . $row["id"] . '">' . $row["nom_champs"] . '</option>';
                }

            }

        }

        return Response()->json($ajax_option);

    }

    public function all_data_select(Request $request)
    {

        $parent_id = 0;
        $all_dossier = Dossier_champ::all();
        $organigramme_id = $request->input('organigramme_id');
        $type_btn = $request->input('type_btn');
        $entite = $request->input('entite');

        $output = '<select  id="select_tree"  name="select_tree">';

        if ($type_btn == 'btn_sous_dossier' || $type_btn == 'btn_piece_joint')
        {

            foreach ($all_dossier as $row)
            {

                if ($row["organigramme_id"] == $organigramme_id)
                {
                    if ($row["entite_id"] == $entite )
                    {

                        if ($row["parent_id"] == 0)
                        {
                            $output .= '<option value="' . $row["id"] . '"  >' . $row["nom_champs"] . '</option>';
                        }
                        else
                        {
                            $output .= '<option value="' . $row["id"] . '" data-parent="' . $row["parent_id"] . '" >' . $row["nom_champs"] . '</option>';

                        }

                    }

                }

            }

        }

        $output .= '</select>';

        echo $output;

    }

    public function store_dossier(Request $request)
    {

        $check = false;

        $check_add = false;

        $piece_joint = true;

        $check_have_att = false;

        $type_dossier = $request->input('type_dossier');

        $id = $request->input('select_tree');

        $check_have_attribut = Attribut_champ::where('dossier_champs_id', '=', $id)->get();

        if (count($check_have_attribut) == 0)
        {
            $check = false;
        }
        else
        {
            $check = true;
        }

        if (!$check)
        {

            $count_file = 0;

            $piece_joint = true;

            function is_array_empty($arr)
            {
                if (is_array($arr))
                {
                    foreach ($arr as $value)
                    {
                        if (!empty($value))
                        {
                            return true;
                        }
                    }
                }
                return false;
            }

            if($request->input('name_champ') != null){


                    for ($i = 0;$i < count($request->input('name_champ'));$i++)
                    {

                        if ($request->type_champ[$i] == 'Fichier')
                        {
                            $count_file++;
                        }
                    }

            }

            

            if ($count_file == 1)
            {
                $piece_joint = false;
            }

            if ($type_dossier == "btn_piece_joint")
            {

                $check_have_att =   $this->check_piece($request->input('select_tree'));

                

                if(!$check_have_att){

                    if (!$piece_joint)
                    {

                        $all_dossier = Dossier_champ::all();

                        $type_dossier = $request->input('type_dossier');

                        $new_dossier = new Dossier_champ();

                        $new_dossier->parent_id = $request->input('select_tree');

                        $new_dossier->nom_champs = $request->input('dossier_champs');

                        $new_dossier->organigramme_id = $request->input('id_organigramme');
                        $new_dossier->entite_id = $request->input('select_entite');
                        $new_dossier->save();

                        $check_add = true;

                        if (is_array_empty($request->name_champ))
                        {

                            for ($i = 0;$i < count($request->input('name_champ'));$i++)
                            {
                                $attribut_champ = new Attribut_champ();
                                $attribut_champ->dossier_champs_id = $new_dossier->id;
                                $attribut_champ->nom_champs = $request->name_champ[$i];
                                $attribut_champ->type_champs = $request->type_champ[$i];
                                $attribut_champ->save();
                            }
                        }

                    }

                }

            }
            else
            {

                $all_dossier = Dossier_champ::all();

                $type_dossier = $request->input('type_dossier');

                $new_dossier = new Dossier_champ();

                if ($type_dossier == "btn_dossier")
                {
                    $new_dossier->parent_id = 0;
                }
                if ($type_dossier == "btn_sous_dossier")
                {
                    $new_dossier->parent_id = $request->input('select_tree');
                }

                $new_dossier->nom_champs = $request->input('dossier_champs');

                $new_dossier->entite_id = $request->input('select_entite');
                $new_dossier->organigramme_id = $request->input('id_organigramme');
                $new_dossier->save();

                $check_add = true;

                if (is_array_empty($request->name_champ))
                {

                    for ($i = 0;$i < count($request->input('name_champ'));$i++)
                    {
                        $attribut_champ = new Attribut_champ();
                        $attribut_champ->dossier_champs_id = $new_dossier->id;
                        $attribut_champ->nom_champs = $request->name_champ[$i];
                        $attribut_champ->type_champs = $request->type_champ[$i];
                        $attribut_champ->save();
                    }
                }

            }

        }

        return Response()
            ->json(['etat' => $check_add, 'check_sub_dossier' => $check, 'type_dossier' => $type_dossier, 'piece_joint' => $piece_joint, 'piece_have_att' => $check_have_att]);

    }

    public function delete_dossier(Request $request)
    {

        $array_id = $request->input('items_delete');

        for ($i = 0;$i < count($array_id);$i++)
        {

            $delete_dossier = Dossier_champ::find($array_id[$i]);
            $delete_dossier->delete();

        }

        return Response()
            ->json(['etat' => true]);

    }

    public function table_organigramme()
    {

        $table_organigramme = Organigramme::all();



        return Response()->json($table_organigramme);

    }


    public function table_organigramme_view()
    {

        $user = Auth::user();

        $organigramme =array();
    
        for($i=0;$i<count($user->projet);$i++){
            $organigramme[]=Organigramme::find($user->projet[$i]['organigrammes_id']);
    
           
        }

        return Response()->json($organigramme);

    }

  


    public function create_organigramme(Request $request)
    {

        $new_organigramme = new Organigramme();

        $new_organigramme->nom = $request->input('nom_organigramme');
        $new_organigramme->save();

        return redirect()
            ->route('home_organigramme');

    }

    public function delete_organigramme_item(Request $request)
    {

        $delete_organigramme = Organigramme::find($request->input('items_delete'));
        $delete_organigramme->delete();

        $data_organigramme = Organigramme::all();

        return Response()->json(['etat' => true, 'data' => $data_organigramme]);

    }

    public function edit_organigramme($id)
    {
        $this->authorize('permission_plan_classements');

        $item_organigramme = Organigramme::find($id);

        $entite = Entite::where(['organigramme_id' => $id])->get();

        $data = array(
            "nom" => $item_organigramme['nom'],
            "id" => $id,
            "entites" => $entite
        );
        return view(' organigramme.edit', $data);

    }

    public function edit_organigramme_view($id)
    {
        
        $this->authorize('Voir_plan_classement');

        $item_organigramme = Organigramme::find($id);

        $entite = Entite::where(['organigramme_id' => $id])->get();

        $data = array(
            "nom" => $item_organigramme['nom'],
            "id" => $id,
            "entites" => $entite
        );
        return view(' organigramme_view.edit', $data);
        

    }

    public function check_have_parent(Request $request)
    {

        $all_dossier = Dossier_champ::all();
        $organigramme_id = $request->input('organigramme_id');
        $check = false;
        foreach ($all_dossier as $row)
        {
            if ($row["organigramme_id"] == $organigramme_id)
            {

                $check = true;

            }
        }
        return Response()->json(['etat' => $check]);
    }

    public function check_have_attributs(Request $request)
    {

        $check = false;

        $id = $request->input('select_tree');

        $check_have_attribut = Attribut_champ::where('dossier_champs_id', '=', $id)->get();

        if (count($check_have_attribut) == 0)
        {
            $check = false;
        }
        else
        {
            $check = true;
        }

        return Response()->json(['etat' => $check]);

    }

    public function fill_table_edit_attributs(Request $request)
    {
        $dossier = Dossier_champ::find($request->champs_id);
        $attributs = Attribut_champ::where('dossier_champs_id', '=', $request->champs_id)
            ->get();
        $all_index = Indexe::where(['dossier_id' => $request->champs_id ])->get();

        return Response()
            ->json(['attributs' => $attributs, 'nom_dossier' => $dossier->nom_champs, 'id_dossier' => $dossier->id,'all_index' => $all_index]);

    }

    public function update_attributs(Request $request)
    {

        if (!empty($request->old_id_champ))
        {
            for ($i = 0;$i < count($request->old_id_champ);$i++)
            {
                $update_attribut = Attribut_champ::find($request->old_id_champ[$i]);
                $update_attribut->nom_champs = $request->old_name_champ[$i];
                $update_attribut->type_champs = $request->old_type_champ[$i];
                $update_attribut->save();
            }
        }

        if (!empty($request->new_name_champ))
        {
            for ($i = 0;$i < count($request->new_name_champ);$i++)
            {
                $new_attribut = new Attribut_champ();
                $new_attribut->nom_champs = $request->new_name_champ[$i];
                $new_attribut->type_champs = $request->new_type_champ[$i];
                $new_attribut->dossier_champs_id = $request->id_champs;
                $new_attribut->save();
            }
        }

        if (!empty($request->old_id_index))
        {
            for ($i = 0;$i < count($request->old_id_index);$i++)
            {
                $update_Indexe = Indexe::find($request->old_id_index[$i]);
                $update_Indexe->name_index = $request->old_name_index[$i];
                $update_Indexe->attribut_id = $request->old_type_champ_index[$i];
                $update_Indexe->file_id = $request->old_type_fichier[$i];
                $update_Indexe->save();
            }
        }

        if (!empty($request->new_name_index))
        {
            for ($i = 0;$i < count($request->new_name_index);$i++)
            {
                $add_Indexe = new Indexe();
                $add_Indexe->name_index = $request->new_name_index[$i];
                $add_Indexe->attribut_id = $request->new_type_champ[$i];
                $add_Indexe->file_id = $request->new_file_champ[$i];
                $add_Indexe->dossier_id = $request->id_champs;
                $add_Indexe->save();
            }
        }

        return Response()
            ->json(['etat' => true]);

    }

    public function remove_champs_attributs(Request $request)
    {

        $delete = Attribut_champ::find($request->id_champs_attributs);
        $delete->delete();

    }

    public function remove_row_indexe(Request $request)
    {

        $delete = Indexe::find($request->id_indexe);
        $delete->delete();

    }



    public function remove_entite(Request $request)
    {

        $delete = Entite::find($request->id_entite);
        $delete->delete();

        return Response()
        ->json(['etat' => true]);

    }

    public function api_champs_index(Request $request){

        $les_champs = Attribut_champ::where('dossier_champs_id', '=', $request->id)->get();
        return $les_champs;

    }


    

    public function check_piece($id)
    {

        $check = false;
        $count_fichier=0;

        $check_add_piece = Dossier_champ::where('parent_id', '=', $id)->get();

        for ($i = 0;$i < count($check_add_piece);$i++)
        {

            $att = Attribut_champ::where('dossier_champs_id', '=', $check_add_piece[$i]->id)
                ->get();

            if ($check == false)
            {

                if (count($att) == 0)
                {
                    $check = false;
                }
                else
                {
                    for ($j = 0;$j < count($att);$j++)
                    {
                        if($att[$j]->type_champs == 'Fichier'){
                            $count_fichier++;
                        }
                    }
                  

                        if($count_fichier > 1 ){
                            $check = true;
                        }
                        
                        $count_fichier=0;
                   
                }

            }

        }

        return $check;

     

    }

    public function pdf($id)
    {

        $item_organigramme = Organigramme::find($id);

        $entite = Entite::where(['organigramme_id' => $id])->get();

        $data = array(
            "nom" => $item_organigramme['nom'],
            "id" => $id,
            "entites" => $entite
        );

        $pdf = PDF::loadView('organigramme_view.pdf', $data);
        return $pdf->stream();

    }

   

}

