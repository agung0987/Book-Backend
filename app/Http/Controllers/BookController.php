<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books= BookModel::get();
        return response()->json([
            'message'   => 'success',
            'data'      => $books
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = new BookModel();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->image_url = $request->image_url;
        $book->release_year = $request->release_year;
        $book->price = $request->price;
        $book->total_page = $request->total_page;
        $book->thickness = $request->thickness;
        $book->category_id = $request->category_id;
        $book->save();
        return response()->json([
            'message'   => 'success',
            'data'      => $book
        ], 200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
