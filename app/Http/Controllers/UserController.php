<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Tables\UsersIndexTable;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Isset_;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        $userTable = (new UsersIndexTable())->create();

        return view('pages.users.index', [
            'userTable' => $userTable
        ]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id')->toArray();

        return view('pages.users.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'role' => ['required'],
            'locale' => ['required'],
            'password' => ['required', 'confirmed'],
            'active' => ['nullable'],
        ]);

        $validated['active'] = isset($validated['active']);

        $user = User::create($validated);

        $user->assignRole(Role::find($validated['role'])->name);

        return redirect()->route('users.index')->with('success', 'The user has been successfully created');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id')->toArray();

        return view('pages.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'role' => ['required'],
            'locale' => ['required'],
            'active' => ['nullable'],
        ]);

        $validated['active'] = isset($validated['active']);

        $user->roles()->sync($validated['role']);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'The user has been successfully updated');
    }

    public function updatePassword(User $user, Request $request)
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $user->update([
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('users.edit', $user)->with('success', 'The user has been successfully updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'The user has been successfully deleted');
    }

    public function ajaxSearch(Request $request)
    {
        return response()->json((new UsersIndexTable)->ajaxSearch($request));
    }
}
