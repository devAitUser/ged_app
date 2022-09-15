<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('permission_Modifier_roles');

        $roles=Role::all();$permissions=Permission::all();
        return view('role.index',compact('roles','permissions'));
    }
    public function create()
    { 
        $this->authorize('permission_Modifier_roles');
        $role=Role::all();
        $permissions=Permission::all();
        return view('role.create',compact('role','permissions'));
    }


    public function store(Request $request)
    {
        $role=Role::all();
        $permission=Permission::all();
        $request->validate([
            'name'=>'required',

            'permission' => 'required'
        ]);

           // dd($request->all());
         /*
          $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');*/
            $a_role = Role::where('name', '=', $request->name)->first();
            if($a_role) {
                return back()->with('err', 'Role déja exist');
            }else{
               // $a_role = Role::create($request->all());

                // $a_role->syncPermissions($request->input('permission'));
                $a_role = Role::create(['name' => $request->input('name')]);
               $a_role->givePermissionTo($request->input('permission'));
                return redirect()->route('roles.index');}


    }

    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function show(Role $role)
    {
        return view('role.show',compact('role'));
    }

    public function edit(Role $role)
    {
        $this->authorize('permission_Modifier_roles');
        $permissions=Permission::all();
        return view('role.edit',compact('role','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $role->update($request->all());
        return redirect()->route('roles.index');
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')
         ->with('success','role deleted successfully');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission does not exists.');
    }
}
