<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Bill;
use App\BillProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $product=Product::all();
          return array(
            'status' => 'success',
            'pages' => $product->toArray()
        );
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
        $filename=NULL;
        $product=Product::create([
            'name'=> $request->input('name'),
            'image'=> $filename
        ]);
        if($product){
            return array(
                 'status' => 'success'
            );
        }
        else{
            return array('status' => 'Not Succesfull' );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $billProduct=BillProduct::all()->where('product_id','=',$product->id);
        foreach ($billProduct as $key => $temp) {
            $bill=Bill::where('id',$temp->bill_id)->get()->first();
            $billProduct[$key]['bill_date']=$bill->bill_date;
            $billProduct[$key]['supplier']=$bill->supplier;
            $descriptions[$key]=$temp->description;
        }
        $product['bill_products']=$billProduct;
        if($product->image!=""){
            $url =Storage::url($product->image);
            $product['url']=$url;
        }
        return array('product'=>$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //return array('status' => $request );
        $product=Product::find($request->input('id'));
        $product->name=$request->input('name');
        $update=$product->save();
        if($update){
            return array(
                 'status' => 'success'
            );
        }
        else{
            return array('status' => 'Not Succesfull' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $productDelete=Product::find($product->id);
        if($productDelete->image!=""){
            Storage::delete($productDelete->image);
        }
        $productDelete->delete();
        return array('status' => 'Succesfull' );
    }
}
