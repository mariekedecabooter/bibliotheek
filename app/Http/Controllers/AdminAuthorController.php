<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $authors = Author::all();
        return view('admin.authors.index', compact('authors'));
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
            return view('admin.authors.create');
        } else
            return redirect('admin/authors');
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
            Author::create($request->all());
            return redirect('/admin/authors');
        } else
        return redirect('admin/authors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author $author
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (Auth::user()->role_id == 1) {
            $author = Author::findOrFail($id);
            return view('admin.authors.edit', compact('author'));
        } else
            return redirect('admin/authors');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Author $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::user()->role_id == 1) {
            $author = Author::findOrFail($id);
            $author->update($request->all());
        }
        return redirect('/admin/authors');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (Auth::user()->role_id == 1) {
            $author = Author::findOrFail($id);
            $records = $author->records;

            foreach ($records as $record) {
                /*  $rentals = $record->rentals;
                  foreach ($rentals as $rental) {
                      $rental->delete();
                  }*/
                $record->delete();

            }

            $author->delete();
        }
        return redirect('admin/authors');
    }
}
