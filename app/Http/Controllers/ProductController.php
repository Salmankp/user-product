<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $user_id=Auth::id();
        if($user->hasRole('Admin')){
            $data=Product::all();
        }
        elseif ($user->hasRole('Master User')){
            $data=Product::where('user_id',$user_id);
        }
        elseif ($user->hasRole('Child User')){
            $data=Product::where('user_id',$user_id);
        }

        return response()->json($data,200);
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
       $product=new Product;
       $product->title=$request->product['title'];
       $product->fill_time=$request->product['Fill_time'];
       $product->brand_name=$request->product['brand_name'];
       $product->buying_price=$request->product['buying_price'];
       $product->category=$request->product['category'];
       $product->description=$request->product['desc'];
       $product->discount=$request->product['discount'];
       $product->title=$request->product['dom_freight'];
       $product->title=$request->product['int_freight'];
       $product->title=$request->product['internal_sku'];
       $product->keywords=$request->product['keyword'];
       $product->manufacturer_number=$request->product['manufact_number'];
       $product->product_code=$request->product['product_code'];
       $product->product_source=$request->product['product_source'];
       $product->remarks=$request->product['remarks'];
       $product->short_description=$request->product['short_desc'];
       $product->size_height=$request->product['size_height'];
       $product->size_length=$request->product['size_length'];
       $product->size_width=$request->product['size_width'];
       $product->sku=$request->product['sku'];
       $product->source_url=$request->product['source_url'];
       $product->stock=$request->product['stock'];
       $product->trade_name=$request->product['trade_name'];
       $product->extra_field_1=$request->product['extra_field1'];
       $product->extra_field_2=$request->product['extra_field2'];
       $product->extra_field_3=$request->product['extra_field3'];
       $product->extra_field_4=$request->product['extra_field4'];
       $product->extra_field_5=$request->product['extra_field5'];
       $product->approval_status=$request->product['approval_status'];
       $product->product_type=$request->product['product_type'];
       $product->shelf_status=$request->product['shelf_status'];
       $product->user_id=$request->user['id'];
       $product->save();

        return response()->json('success',200);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
