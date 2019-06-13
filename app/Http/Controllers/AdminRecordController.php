<?php

namespace App\Http\Controllers;

use App\Author;
use App\Photo;
use App\Record;
use App\Rental;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $records = Record::paginate(5);
        $userRentals = Auth::user()->rentals->all();
        return view('admin.records.index',compact('records','userRentals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $authors = Author::pluck('name','id')->all();
        return view('admin.records.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();

        if ($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }


        Record::create($input);
        return redirect('/admin/records');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $record = Record::findOrFail($id);
        $rentals = $record->rentals->where('user_id','=',Auth::user()->id)->first();
        return view('admin.records.show',compact('record','rentals'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $authors = Author::pluck('name','id')->all();
        $record =  Record::findOrFail($id);

        return view('admin.records.edit',compact('record','authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $record = Record::findOrFail($id);

        if ($file = $request->file('foto')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);
            $request['foto'] = $name;
            $record->update($request->all());
        }

        $record->update([
            'titel' => $request->titel,
            'auteur_id' => $request->auteur_id,
            'isbn' => $request->isbn,
            'jaartal' => $request->jaartal,
            'uitgave' => $request->uitgave,
            'beschrijving' => $request->beschrijving,
            'aantal' => $request->aantal
        ]);

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $record = Record::findOrFail($id);
        $record->delete();

        return redirect('/admin/records');
    }
}
