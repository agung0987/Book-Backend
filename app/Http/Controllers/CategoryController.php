<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category= CategoryModel::get();
        return response()->json([
            'message'   => 'success',
            'data'      => $category
        ], 200);

    }

    public function getBook(string $id)
    {
        $book= BookModel::where('category_id',$id)->get();
        return response()->json([
            'message'   => 'success',
            'data'      => $book
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new CategoryModel();
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'message'   => 'success',
            'data'      => $category
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        $category = CategoryModel::where('id', $id)->first();
        $category->name = $request->name;
        $category->update();
        
        return response()->json([
            'message'   => 'success',
            'data'      => $category
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $del = CategoryModel::find($id);
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
