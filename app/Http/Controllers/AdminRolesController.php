<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->role_id == 1) {
            return view('admin.roles.create');
        } else
            return redirect('/admin/roles');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        if (Auth::user()->role_id == 1) {
            $role = Role::where('name', '=', $request->name)->first();
            if ($role === NULL) {
                $input = $request->all();
                Role::create($input);
            }
        }
        return redirect('/admin/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (Auth::user()->role_id == 1) {
            $role = Role::findOrFail($id);

            return view('admin.roles.edit', compact('role'));
        } else
            return redirect('admin/roles');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::user()->role_id == 1) {
            $role = Role::where('name', '=', $request->name)->first();
            if ($role === NULL) {
                $role = Role::findOrFail($id);
                $role->update($request->all());
            }

        }
        return redirect('/admin/roles');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (Auth::user()->role_id == 1) {
            $role = Role::findOrFail($id);
            $users = $role->users;

            foreach ($users as $user) {
                $user['role_id'] = NULL;
                $user->update();
            }

            $role->delete();
        }
        return back();
    }
}
