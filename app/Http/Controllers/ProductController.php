<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
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
        $sections = Section::get();
        $products = Product::get();
        return view('products.products', compact("sections","products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_data = $request -> validate([
            'product_name' => 'required|unique:products',
            'description' => 'required'
        ]);
        Product::create([
            "product_name" => $request -> product_name,
            "description" => $request -> description,
            "section_id" => $request -> section_id
        ]);
        return redirect() -> back() -> with('message','تم إضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $section_id = Section::where("section_name",$request -> section_name)->first()->id;
        $product_id = $request -> id;
        $product = Product::FindorFail($product_id);
        
        
        $product -> update([
            "product_name" => $request -> product_name,
            "description" => $request -> description,
            "section_id" => $section_id
        ]);

        return redirect() -> back() -> with('message','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request -> id;
        $product = Product::FindorFail($id);
        $product -> delete();
        return redirect() -> back() -> with('message','تم الحذف بنجاح');
    }
}
