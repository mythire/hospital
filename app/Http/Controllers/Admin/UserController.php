<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')
                    ->whereHas('roles', function($query) {
                        $query->whereNotIn('name', ['Member']);
                    })
                    ->paginate(10);

        return view('Admin.Users.view-users')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['Member','Doctor'])->pluck('name');

        return view('Admin.Users.create-user')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'role' => 'required|string'
        ],[
            'first_name.required' => 'First name cannot be empty',
            'last_name.required' => 'Last name cannot be empty',
            'email.required' => 'Email cannot be empty',
            'role.required' => 'Role cannot be empty'
        ]);

        $password_string = '!@#$%*&abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ23456789';
        $password = substr(str_shuffle($password_string), 0, 12);

        $user = User::create([            
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole($request->role);

       
        return redirect()->route('dashboard')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('Admin.Users.view-user')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::whereNotIn('name', ['Member'])->pluck('name');

        return view('Admin.Users.edit-user')->with(['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required','email','max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|string',
            'chief_doctor' => 'nullable',
        ],[
            'first_name.required' => 'First name cannot be empty',
            'last_name.required' => 'Last name cannot be empty',
            'email.required' => 'Email cannot be empty',
            'role.required' => 'Role cannot be empty'
        ]);



        //remove existing roles
        $user->removeRole($user->roles->pluck('name')[0]);

        $user->update([            
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,            
        ]);

        //assign requested role
        $user->assignRole($request->role);

        if ($request->filled('chief_doctor')) {

            // assign Chief Doctor Permission directly to user if the chief doctor checkbox is checked
            $user->givePermissionTo('Chief Doctor');
        } else {
            // remove direct permission
            $user->revokePermissionTo('Chief Doctor');
        }        


        
        return redirect()->route('dashboard')->with('success', 'User Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
