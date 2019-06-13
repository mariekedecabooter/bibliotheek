<?php

namespace App\Http\Controllers;

use App\Record;
use App\Rental;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rentalsOrder = Rental::orderby('date_out', 'desc')->where('date_returned', '=', NULL)->get();
        $rentalsOrderHistory = Rental::orderby('date_returned', 'desc')->where('date_returned', '!=', NULL)->paginate(5);
        return view('admin.rentals.index', compact('rentalsOrder', 'rentalsOrderHistory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::pluck('name', 'id')->all();
        $records = Record::pluck('titel', 'id')->all();


        return view('admin.rentals.create', compact('users', 'records'));
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

        isset($request->user_id) ? $userId = $request->user_id : $userId = Auth::user()->id;
        $user = User::findOrFail($userId);

        if (count($user->rentals->where('date_returned','=', NULL)) < 7) {

            $date = isset($request->date_out) ? ($request->date_out) : now();
            Rental::create([
                'record_id' => $request['record_id'],
                'user_id' => $userId,
                'date_out' => now(),
                'date_in' => now()->addDays(14),
                'date_returned' => NULL
            ]);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rental $rental
     * @return \Illuminate\Http\Response
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rental $rental
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $users = User::pluck('name', 'id')->all();
        $records = Record::pluck('titel', 'id')->all();
        $rental = Rental::findOrFail($id);

        return view('admin.rentals.edit', compact('rental', 'users', 'records'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Rental $rental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rental = Rental::findOrFail($id);
        $input = $request->all();

        if ($request->return === 'true') {
            $input['date_returned'] = now();
        } else {
            $input['date_in'] = Carbon::parse($request->date_out)->addDays(14);
        }

        $rental->update($input);
        return back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rental $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $rental = Rental::findOrFail($id);
        $rental->delete();

        return redirect('admin/rentals');
    }

}
