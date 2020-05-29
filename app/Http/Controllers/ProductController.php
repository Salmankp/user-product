<?php

namespace App\Http\Controllers;

use Faker\Provider\File;
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
        //return  $request;
        if (!empty($request->id)) {
            $product = Product::find($request->id);
        } else {
            $product=new Product;
        }
     //  $product=new Product;
       $product->title=$request->title;
       $product->fill_time=$request->Fill_time;
       $product->brand_name=$request->brand_name;
       $product->buying_price=$request->buying_price;
       $product->category=$request->category;
       $product->description=$request->desc;
       $product->discount=$request->discount;
       $product->domestic_freight=$request->dom_freight;
       $product->international_freight=$request->int_freight;
       $product->internal_sku=$request->internal_sku;
       $product->keywords=$request->keyword;
       $product->manufacturer_number=$request->manufact_number;
       $product->product_code=$request->product_code;
       $product->product_source=$request->product_source;
       $product->remarks=$request->remarks;
       $product->short_description=$request->short_desc;
       $product->size_height=$request->size_height;
       $product->weight=$request->weight;
       $product->size_length=$request->size_length;
       $product->size_width=$request->size_width;
       $product->sku=$request->sku;
       $product->source_url=$request->source_url;
       $product->stock=$request->stock;
       $product->trade_name=$request->trade_name;
       $product->extra_field_1=$request->extra_field1;
       $product->extra_field_2=$request->extra_field2;
       $product->extra_field_3=$request->extra_field3;
       $product->extra_field_4=$request->extra_field4;
       $product->extra_field_5=$request->extra_field5;
       $product->approval_status=$request->approval_status;
       $product->product_type=$request->product_type;
       $product->shelf_status=$request->shelf_status;
       $product->user_id=$request->user_id;
       $product->save();

        if($request->hasFile('files'))
        {
            $images = $request->file('files');
            foreach ($images as $img)
            {
                $filename='/images/'.$img->getClientOriginalName();
                $img->move(public_path('images'),$filename);
            }
        }

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
    public function edit($id)
    {
        $data=Product::where('id',$id)->first();
        return response()->json($data,200);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Product::where('id',$id)->delete();

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
}
