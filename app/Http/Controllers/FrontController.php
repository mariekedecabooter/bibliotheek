<?php

namespace App\Http\Controllers;

use App\Author;
use App\Record;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    //

    public function search(Request $request)
    {
        if ($request->search) {

            $search = '%' . $request->search . '%';
            $records = Record::all();

            if ($request->searchOn == "author") {
                $authors = Author::where('name', 'LIKE', $search)->get();

            } else {
                $results = Record::where($request->searchOn, 'LIKE', $search)->get();
            }

        }

        return view('search', compact('records', 'authors', 'results'));
    }

    public function record($id)
    {

        $record = Record::findOrFail($id);

        return view('record', compact('record'));
    }

    public function user()
    {

        if (Auth::user()) {
            $id = Auth::user()->id;
            $user = User::findOrFail($id);
        }
        return view('user', compact('user'));

    }



}
