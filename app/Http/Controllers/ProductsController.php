<?php

namespace App\Http\Controllers;

use App\products;
use App\sections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table_data = products::all();
        $section_name = sections::all();
        return view('products.products',compact('table_data','section_name'));
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
        $input = $request->all();
        //return $input;
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            //'section_id' => 'required|not_in:0',
            'description' => 'required'
            ],[
                'product_name.required' => 'اسم القسم الزامي',
                //'section_id.required' => 'تحديد القسم الزامي',
                'description.required' => 'وصف القسم الزامي'
        ]);
        products::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
            //'created_by' => (Auth::user()->name)
        ]);
        session()->flash("successfuly","تمت اضافة المنتج بنجاح");
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = products::find($id);
        $item->description = $request->input('description');
        $item->product_name = $request->input('product_name');
        //$item->section_id = $request->input('section_id');
        $item->update();
        return back()->with('update_msg','تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = products::find($id);
        $item->delete();
        return redirect()->back()->with('delete_msg','تم حذف القسم بنجاح');
    }
}
