<?php

namespace App\Http\Controllers;

use Faker\Provider\File;
use App\User;
use App\Product;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
            // all products for admin
            $data=Product::with('product_image','user','category')->get();
        }
        elseif ($user->hasRole('Master User')){
            // getting products of child users that are created by master user
            $child_users_id = User::where('created_by' , $user_id)->pluck('id');
            $data=Product::with('product_image','user','category')->
            whereIn('user_id',$child_users_id)->orWhere('user_id' , $user_id)->get();
        }
        elseif ($user->hasRole('Child User')){
            // child user products
            $data=Product::with('product_image','user','category')->where('user_id',$user_id)->get();
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
       $product->fill_time=$request->fill_time;
       $product->brand_name=$request->brand_name;
       $product->buying_price=$request->buying_price;
       $product->category_id=$request->category;
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

       // storing in aws s3
        if($request->hasFile('files'))
        {
            $images = $request->file('files');
            foreach ($images as $img)
            {
               $path =  $img->store('products', 's3');

                $image = Image::create([
                    'user_id' => $product->user_id,
                    'product_id' => $product->id,
                    'file_name' => basename($path),
                    'image_url' => Storage::disk('s3')->url($path)
                ]);

            }
        }

        $user=Auth::user();
        $user_id=Auth::id();
        if($user->hasRole('Admin')){
            $data=Product::with('product_image','user','category')->get();
        }
        elseif ($user->hasRole('Master User')){
            $child_users_id = User::where('created_by' , $user_id)->pluck('id');
            $data=Product::with('product_image','user','category')->
            whereIn('user_id',$child_users_id)->orWhere('user_id' , $user_id)->get();
        }
        elseif ($user->hasRole('Child User')){
            $data=Product::with('product_image','user','category')->where('user_id',$user_id)->get();
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
            $data=Product::with('product_image','user','category')->get();
        }
        elseif ($user->hasRole('Master User')){
            $child_users_id = User::where('created_by' , $user_id)->pluck('id');
            $data=Product::with('product_image','user','category')->
            whereIn('user_id',$child_users_id)->orWhere('user_id' , $user_id)->get();
        }
        elseif ($user->hasRole('Child User')){
            $data=Product::with('product_image','user','category')->where('user_id',$user_id)->get();
        }

        return response()->json($data,200);


    }

    public function search(Request $request)
    {
        // search product filters
       $user_id=$request->user;
       $category_id=$request->category;
       $shelf=$request->shelf;
       $approval=$request->approval;
       $internal_sku=$request->internal_sku;
       $product_type=$request->product_type;
       $where=[];

       if(!empty($user_id)) {
           array_push($where,['user_id',$user_id]);
       }
        if(!empty($category_id)) {
            array_push($where,['category_id',$category_id]);
        }
        if(!empty($shelf)) {
            array_push($where,['shelf_status',$shelf]);
        }
        if(!empty($approval)) {
            array_push($where,['approval_status',$approval]);
        }
        if(!empty($internal_sku)) {
            array_push($where,['internal_sku','Like','%'.$internal_sku.'%']);
        }
        if(!empty($product_type)) {
            array_push($where,['product_type',$product_type]);
        }

        $user=Auth::user();
        $user_id=Auth::id();
        if($user->hasRole('Admin')){
            $data=Product::with('product_image','user','category')->where($where)->get();
        }
        elseif ($user->hasRole('Master User')){
            $child_users_id = User::where('created_by' , $user_id)->pluck('id');
            $data=Product::with('product_image','user','category')->
            whereIn('user_id',$child_users_id)->orWhere('user_id' , $user_id)->where($where)->get();
        }
        elseif ($user->hasRole('Child User')){
            $data=Product::with('product_image','user','category')->
            where($where)->where('user_id',$user_id)->get();
        }

       // $data=Product::with('product_image','user','category')->where($where)->get();

        return response()->json($data,200);
    }
}
