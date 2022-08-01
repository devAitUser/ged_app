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


    public function showUser($id){
        //$user=User::find($id);
        $roles=Role::all();
        $user = User::find($id);
        $permissions=Permission::all();

       return view('user.showuser',compact('user','roles','permissions'));
    }

    public function test(){
        return view('user.register');
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

    public function verify()
    {
       return view('user.login');
    }
    public function edit()
    {
       return view('user.edit');
    }



    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('err', 'Role exists.');
        }
        else{
            $user->syncRoles($request->role);
        return back()->with('message', 'Role updated.');
        }
        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('err', 'Role not exists.');
    }
    public function givePermission(Request $request, User $user)
    {
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
