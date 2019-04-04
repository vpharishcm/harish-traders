<?php

namespace App\Http\Controllers\Api;

use App\BillProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                'price'=>$request->input('price'),
                'description'=>$request->input('description')
                ]);
            $bill=$billproduct->bill();
            if($billproduct){
                 return redirect()->route('bill.show',['bill'=>$bill]);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
        $billProduct->description=$request->input("description");
        
        $billProduct->price=$request->input("price");
        $update=$billProduct->save();
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
    public function destroy(Request $request,BillProduct $billProduct)
    {
        //
        $billProductDelete=BillProduct::find($request->id);
        $billProductDelete->delete();
        return array('status' => 'Succesfull' );
    }
}
