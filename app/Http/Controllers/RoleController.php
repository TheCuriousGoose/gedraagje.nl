<?php

namespace App\Http\Controllers;

use App\Tables\RolesIndexTable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $rolesTable = (new RolesIndexTable)->create();

        return view('pages.roles.index', [
            'rolesTable' => $rolesTable,
        ]);
    }

    public function create()
    {
        $guards = array_keys(config('auth.guards'));
        $guards = array_combine($guards, $guards);

        $permissions = Permission::orderBy('name')->get()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('pages.roles.create', [
            'guards' => $guards,
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string',
            'permissions' => 'nullable|array',
        ]);

        $role = Role::create($validated);

        $role->syncPermissions($validated['permissions']);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        $guards = array_keys(config('auth.guards'));
        $guards = array_combine($guards, $guards);

        $permissions = Permission::orderBy('name')->get()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        $hasAllGroupPermissions = [];

        foreach($permissions as $group => $groupPermissions){
            $hasAllGroupPermissions[$group] = $role->hasAllPermissions($groupPermissions->pluck('name')->toArray());
        }

        return view('pages.roles.edit', [
            'role' => $role,
            'guards' => $guards,
            'permissions' => $permissions,
            'hasAllGroupPermissions' => $hasAllGroupPermissions,
        ]);
    }

    public function update(Request $request, Role $role){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
        ]);

        $role->syncPermissions($validated['permissions']);

        $role->update($validated);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role){
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }

    public function ajaxSearch(Request $request)
    {
        return response()->json((new RolesIndexTable)->ajaxSearch($request));
    }
}
