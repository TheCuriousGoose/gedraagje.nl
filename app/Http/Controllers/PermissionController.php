<?php

namespace App\Http\Controllers;

use App\Tables\PermissionsIndexTable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissionsTable = (new PermissionsIndexTable)->create();

        return view('pages.permissions.index', [
            'permissionsTable' => $permissionsTable,
        ]);
    }

    public function create(){
        $guards = array_keys(config('auth.guards'));
        $guards = array_combine($guards, $guards);

        return view('pages.permissions.create', [
            'guards' => $guards
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
        ]);

        Permission::create($validated);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        $guards = array_keys(config('auth.guards'));
        $guards = array_combine($guards, $guards);

        return view('pages.permissions.edit', [
            'permission' => $permission,
            'guards' => $guards,
        ]);
    }

    public function update(Permission $permission, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
        ]);

        $permission->update($validated);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }

    public function ajaxSearch(Request $request)
    {
        return (new PermissionsIndexTable)->ajaxSearch($request);
    }
}
