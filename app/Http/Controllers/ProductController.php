<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::with( 'Category')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(ProductRequest $request )
    {
        Product::create($request->getValidatedData());
        return response()->json([
            'succes' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Product = Product::with( 'Category')->find($id);
        if($Product == null){
            return response()->json([
                'product not exist',
            ],404);
        }
        return response()->json($Product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $Product = Product::find($id);
        if($Product == null){
            return response()->json([
                'product not exist',
            ],404);
        }
        $Product->update($request->getValidatedData());
        return response()->json([
            'succes' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product = Product::find($id);
        if($Product == null){
            return response()->json([
                'product not exist',
            ],404);
        }
        $Product->delete();
        return response()->json([
            'succes' => true,
        ]);
    }
}
