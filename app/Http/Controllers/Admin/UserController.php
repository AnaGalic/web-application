<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
        //$users = User::role('writer')->get();
        $user = User::find(3);
        $role = Role::findByName('renter');
        // $role->givePermissionTo(Permission::all('admin'));
        $role->givePermissionTo('view_apartments');
        //$role->givePermissionTo(Permission::all());
        return $role;
        //return $user->hasRole('admin');
        //$adminRole = Role::create(['name' => 'admin11',  'guard_name' => 'web']);


        /*
        $user->givePermissionTo('create_users');
        //return $adminRole;
        //return $adminRole->givePermissionTo('all');
        if ($user->hasRole('admin')) {
            echo "Ima rolu admin";
        }
        
        if ($user->can('create users')) {
            echo "Moze creairati users";
        } */
        
        //return $user->assignRole('admin');

        return "OK";
        //$users = User::all();


        /*$user = User::find(14);

        return $user->hasRole('admin');*/

        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user' => $user,
            'roles'=> $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        //return $request->all();
        $user->roles()->sync($request->role);
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->roles()->detach();

        return redirect()->route('admin.user.index');
    }

    public function profile ()
    {
        return view('admin.profile');
    }
}
