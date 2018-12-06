<?php

namespace App\Http\Controllers;

use App\BillProduct;
use Illuminate\Http\Request;

class BillProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("billproducts.createForm");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $billproduct=BillProduct::create([
                'product_id'=>$request->input('product_id'),
                'bill_id'=>$request->input('bill_id'),
                'quantity'=>$request->input('quantity'),
                'price'=>$request->input('price')
                ]);
            $bill=$billproduct->bill();
            
            if($billproduct){
                return redirect()->action('BillController@show', ['id' => $request->input('bill_id')]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BillProduct  $billProduct
     * @return \Illuminate\Http\Response
     */
    public function show(BillProduct $billProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BillProduct  $billProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(BillProduct $billProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BillProduct  $billProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillProduct $billProduct)
    {
        //
        
        $billProduct=BillProduct::find($request->input('id'));
        
        if($request->input('product_id')!=""){
            $billProduct->product_id=$request->input('product_id');
        }
        $billProduct->quantity=$request->input("quantity");
        $billProduct->price=$request->input("price");
        $billProductUpdate=$billProduct->save();
        return redirect()->action('BillController@show', ['id' => $request->input('bill_id')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BillProduct  $billProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,BillProduct $billProduct)
    {
        //
        $billProductDelete=BillProduct::find($request->id);
        $billProductDelete->delete();
        return redirect()->action('BillController@show', ['id' => $billProductDelete->bill_id]);
    }
}
