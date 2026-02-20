<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $user = Auth::user();
        $userName = $user ? $user->name : '';
        return view('roles.index', compact('roles','userName'));
    }

    public function create()
    {
        $user = Auth::user();
        $userName = $user ? $user->name : '';
        return view('roles.create', compact('userName'));
    }

    public function edit($roleId)
    {
        $role = Role::with('permissions')->findOrFail($roleId);
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::all()->groupBy('group');
        // dd($permissions);
        $user = Auth::user();
        $userName = $user ? $user->name : '';
        return view('roles.edit', compact('role','rolePermissions','permissions','userName'));
    }

    public function update(Request $request, $roleId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($roleId);
        $role->name = $request->input('name');
        $role->update();

        $role->permissions()->sync($request->input('permissions', []));

        return redirect('/roles')->with('success', 'Role updated successfully.');
    }

    public function assignRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $roleId = $request->input('role_id');
        $role = Role::findOrFail($roleId);
        $user = User::findOrFail($userId);

        $user->roles()->sync([$role->id]);

        return redirect('/property/users/list')->with('success', 'Role assigned successfully.');

    }
}
