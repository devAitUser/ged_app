<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles=Role::all();
        return view('role.index',compact('roles'));
    }
    public function create()
    {
        return view('role.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $role=Role::create($request->all());
        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {
        return view('role.show',compact('role'));
    }

    public function edit(Role $role)
    {
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

    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
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
