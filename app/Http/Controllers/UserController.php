<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Organigramme;
use App\Models\Projet;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Hash;
use Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }




    public function test(){
        $roles=Role::all();
        return view('user.register',compact('roles'));
    }

    public function create(Request $request)
    {

        $request->validate([
            'nom'=>'required',
            'telephone'=>'required',
            'password'=>'required',
            'email'=>'required',
            'identifiant'=>'required',
            'prenom' => 'required'
        ]);

        $addNewUser  = new User();

        $addNewUser->nom=$request->nom;
        $addNewUser->prenom=$request->prenom;
        $addNewUser->password=Hash::make($request->password);

        $addNewUser->email=$request->email;
        $addNewUser->identifiant=$request->identifiant;
        $addNewUser->telephone=$request->telephone;
        $addNewUser->assignRole($request->role);
        $addNewUser->save();
        return redirect()->route('user_list');
      /* $request->validate([
        'nom'=>'required',
        'telephone'=>'required',
        'password'=>'required',
        'email'=>'required',
        'identifiant'=>'required',
        'prenom' => 'required'
    ]);
    Hash::make($request->'password');
    $user=User::create($request->all());*/
   // return redirect()->route('user_list');
     //return $request;
    }

    public function test2(Request $request){
        $search=$request->search;
        if($search != ""){
            $users=User::where('nom','=',$search)->get();
        }else{
            $users=User::all();
        }

       return view('user.userlist',compact('users','search'));

    }
    public function edit($id)
    {
        $roles=Role::all();
        $user = User::find($id);
        return view('user.edit',compact('roles'));

    }
    public function index()
    {

        $user = Auth::user();

        $organigramme =array();

        for($i=0;$i<count($user->projet);$i++){
            $organigramme[]=Organigramme::find($user->projet[$i]['organigrammes_id']);

           
          }

        $data = array(
            'user' => $user,
            'projets' => $organigramme
        );
        return view('user.index', $data);

    }

    public function update(Request $request)
    {
        $user_current = Auth::user();
        $user = User::find($user_current->id);

        $user->telephone = $request->telephone;
        if($request->mot_de_pass != '' ){
            $user->password =  $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->projet_select_id = $request->projet_user;
         $user->save();

         return redirect()->route('user_profile');

    }

    public function showUser($id){
         $organigrammes=Organigramme::all();
         $roles=Role::all();
         $user = User::find($id);
         $permissions=Permission::all();
        $project = $user->projet;
        $count_projet = 0;
        $les_projets = array();
        $ajax_option='';
        $les_projets= array();

        for($i=0;$i<count($project);$i++){
            $organigramme=Organigramme::find($project[$i]->organigrammes_id );
            $id_organigramme = $project[$i]->organigrammes_id;
            $nom_organigrammes = $organigramme->nom;
            $dossiers = json_decode($project[$i]->dossiers, true);
        
            $les_projets[] = array('id' => $id_organigramme ,'nom_organigrammes' => $nom_organigrammes,'dossiers_select' => $dossiers , 'dossiers' => $organigramme->dossier_champ );
            $count_projet++;
          }


          

       return view('user.showuser',compact('user','roles','permissions','organigrammes','les_projets' ,'count_projet' ));
    }
    public function updateUser(Request $request)
    {
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
       
        $user = User::where('id', '=', $request->id)->first();
        $user->nom = $request->nom;
        $user->identifiant = $request->identifiant;
        $user->prenom = $request->prenom;
        $user->telephone = $request->telephone;
        $user->projet_select_id = 0;
        if($request->email != '' ){
            $user->email = $request->email;
        }
        if($request->password != '' ){
            $user->password = Hash::make($request->password);

        }
        $user->syncRoles($request->role);
        $user->save();
        $count = 1;

        $delete_projet= Projet::where('user_id', '=', $user->id);  
        $delete_projet->delete();

        if (is_array_empty($request->organigramme_id)) {
    
            for($i=0;$i<count($request->input('organigramme_id'));$i++){
                $projet = new Projet();
                $projet->organigrammes_id  = $request->organigramme_id[$i];
                $projet->user_id  = $user->id;
                $dossiers =json_encode($request->input('dossiers'.$count));
                $projet->dossiers = $dossiers ;
                $projet->save();
                $count++;
            }   
        }

        return redirect()->route('user_list')
         ->with('message','User est modifiée avec success');


    }

    public function verify()
    {
       return view('user.login');
    }




    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('err', 'Role exists.');
        }
        else if ($user->hasRole($request->role) == false){
            $user->syncRoles($request->role);
        return back()->with('message', 'Role updated.');
        } else{
        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');}
    }

    public function removeRole(User $user, Role $role)
    {
        $permission=Permission::all();
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('err', 'Role not exists.');
    }
    public function givePermission(Request $request, User $user)
    {
        $role=Role::all();
        if ($user->hasRole($role) == false) {
            return back()->with('err', 'Impossible d\'ajouter une permission à un role non assigné');
        }
        if ($user->hasPermissionTo($request->permission)) {
            return back()->with('err', 'Permission exists à ce role.');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added à ce role.');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission annuler à ce role.');
        }
        return back()->with('err', 'Permission n exists pas.');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('err', 'you are admin.');
        }
        $user->delete();

        return back()->with('message', 'User deleted.');
    }
}
