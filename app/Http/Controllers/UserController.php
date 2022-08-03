<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

    public function test2(){
        $users=User::latest()->paginate(5);
       return view('user.userlist',compact('users'));

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
        $data = array(
            'user' => $user
        );
        return view('user.index', $data);

    }

    public function update(Request $request)
    {
        $user_current = Auth::user();
        $user = User::find($user_current->id);

        $user->telephone = $request->telephone;
        if($request->mot_de_pass != '' ){
            $user->password = $request->mot_de_pass;
        }
        $user->email = $request->email;

         $user->save();

         return redirect()->route('user_profile');

    }

    public function showUser($id){

        $roles=Role::all();
        $user = User::find($id);
        $permissions=Permission::all();

       return view('user.showuser',compact('user','roles','permissions'));
    }
    public function updateUser(Request $request)
    {
       // $user = User::find($id);
        $user = User::where('id', '=', $request->id)->first();
        $user->nom = $request->nom;
        $user->identifiant = $request->identifiant;
        $user->prenom = $request->prenom;
        $user->telephone = $request->telephone;
        if($request->email != '' ){
            $user->email = $request->email;
        }
        if($request->password != '' ){
            $user->password = Hash::make($request->password);

        }
        $user->syncRoles($request->role);
        $user->save();
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
