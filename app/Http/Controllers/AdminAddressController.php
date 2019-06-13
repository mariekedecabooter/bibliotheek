<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $addresses = Address::all();
        return view('admin.addresses.index', compact('addresses'));
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
            $users = User::where('address_id', '=', NULL)->pluck('name', 'id')->toArray();

        } else {
            $users = User::findOrFail(Auth::user())->where('address_id', '=', NULL)->pluck('name', 'id')->toArray();
        }
        return view('admin.addresses.create', compact('users'));

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

        $user = User::findOrFail($request->name);
        $address = Address::create($request->all());

        $user['address_id'] = $address->id;
        $user->update();
        return redirect('/admin/addresses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address $address
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $address = Address::findOrFail($id);
        return view('admin.addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Address $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $address = Address::findOrFail($id);
        $address->update($request->all());
        return redirect('/admin/addresses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $address = Address::findOrFail($id);

        $user = $address->user;
        $user['address_id'] = NULL;
        $user->update();


        $address->delete();

        return redirect('admin/addresses');
    }
}
