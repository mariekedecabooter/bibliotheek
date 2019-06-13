<?php

namespace App\Http\Controllers;

use App\Address;
use App\Rental;
use App\Role;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
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
            $roles = Role::pluck('name', 'id')->all();
            return view('admin.users.create', compact('roles'));
        }
        return back();
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

        $input = $request->all();

        $input['password'] = Hash::make($request['password']);
        User::create($input);
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::findOrFail($id);
        $userRentalsOrder = Rental::where('user_id', '=', $id)->orderBy('date_returned', 'asc')->get();
        $userRentalsOrderHistory = Rental::where('user_id', '=', $id)->where('date_returned', '!=', NULL)->orderBy('date_returned', 'desc')->paginate(5);

        return view('admin.users.show', compact('user', 'userRentalsOrder', 'userRentalsOrderHistory'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        if (Auth::user()->role_id == 1 || Auth::user()->id == $id) {
            $user = User::findOrFail($id);
            $roles = Role::pluck('name', 'id')->all();
            return view('admin.users.edit', compact('user', 'roles'));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::user()->role_id == 1 || Auth::user()->id == $id) {
            $user = User::findOrFail($id);

            if (trim($request->password) == '') {
                $input = $request->except('password');
            } else {
                $input = $request->all();
                $input['password'] = Hash::make($request['password']);
            }

            $user->update($input);
        }
        return redirect('admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (Auth::user()->role_id == 1) {
            $user = User::findOrFail($id);
            $address = $user->address;

            $address->delete();
            $user->delete();
            return redirect('admin/users');

        }
    }

}
