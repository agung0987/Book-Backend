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
        $sortByTitle = request()->input('sortByTitle');
        $minYear = request()->input('minYear');
        $maxPage = request()->input('maxPage');       
        if($sortByTitle){
            $books = BookModel::orderBy('id', $sortByTitle)->with('Category')->get();
        }elseif($minYear){
            $books = BookModel::where('release_year', $minYear)->with('Category')->get();
        }elseif($maxPage){
            $books = BookModel::where('total_page', $maxPage)->with('Category')->get();
        }else{
            $books= BookModel::with('Category')->get();
        }
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
        if($request->total_page <= 100 ){
            $thickness = 'Tipis';
        }
        elseif($request->total_page >= 101  && $request->total_page <=200 ){
            $thickness = 'Sedang';
        }else{
            $thickness = 'tebal';
        }
        $book->thickness = $thickness;
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
        $book = BookModel::where('id', $id)->first();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->image_url = $request->image_url;
        $book->release_year = $request->release_year;
        $book->price = $request->price;
        $book->total_page = $request->total_page;
        if($request->total_page <= 100 ){
            $thickness = 'Tipis';
        }
        elseif($request->total_page >= 101  && $request->total_page <=200 ){
            $thickness = 'Sedang';
        }else{
            $thickness = 'tebal';
        }
        $book->thickness = $thickness;
        $book->category_id = $request->category_id;
        $book->update();
        
        return response()->json([
            'message'   => 'success',
            'data'      => $book
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $del = BookModel::find($id);
        if (!is_null($del)) {
            $del->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'jabatan not found'
        ], 404);
    }
}
