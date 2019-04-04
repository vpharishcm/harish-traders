<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bill;
use \App\Supplier;
use \App\Product;
use \App\Expence;
use \App\BillExpence;
use \App\BillProduct;
use Carbon\Carbon;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bills=Bill::all();
        foreach($bills as $key=>$bill){
            $d_date=Carbon::parse($bill->bill_date)->format("d-m-Y");
            $bills[$key]['d_date']=$d_date;
            $billproducts=BillProduct::all()->where('bill_id','=',$bill->id);
            foreach($billproducts as $key1=>$billproduct){
                $billproduct['product_name']=Product::where('id','=',$billproduct->product_id)->value('name');
            }
            $bill['bill_products']=$billproducts;
            $billexpences=BillExpence::all()->where('bill_id','=',$bill->id);
            foreach($billexpences as $key2=>$billexpence){
                $billexpence['expence_name']=Expence::where('id','=',$billexpence->expence_id)->value('name');
            }
            $bill['bill_expence']=$billexpences;
        }
        return 
        array(
            'status' => 'success',
            'bills'=>$bills,
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
        //
         $status=0;
        if($request->input('status')=="without"){
            $status=0;
        }else{
            $status=1;
        }
        $bill_date=$request->input('bill_date');
        $bill_date=Carbon::createFromFormat('d-m-y',$bill_date)->format('Y-m-d');
        $bill=Bill::create([
            'supplier_id'=>$request->input('supplier_id'),
            'bill_date'=>$bill_date,
            'amount'=>0,
            'bill_status'=>$status
            ]);

        if($bill){
            
            return array(
                 'status' => 'success'
            );
        }else {
            return array('status' => 'Not Succesfull' );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
        $supplier=Supplier::all()->where('id','=',$bill->supplier_id);
        $billexpences=BillExpence::all()->where('bill_id','=',$bill->id);
        $billproducts=BillProduct::all()->where('bill_id','=',$bill->id);
        foreach($billproducts as $key1=>$billproduct){
            $billproduct['product_name']=Product::where('id','=',$billproduct->product_id)->value('name');
        }
        $bill['bill_products']=$billproducts;
        $billexpences=BillExpence::all()->where('bill_id','=',$bill->id);
        foreach($billexpences as $key2=>$billexpence){
            $billexpence['expence_name']=Expence::where('id','=',$billexpence->expence_id)->value('name');
        }
        $bill['bill_expence']=$billexpences;
        $bill['supplier']=$supplier;
        return array('bill'=>$bill);
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
    public function update(Request $request, Bill $bill)
    {
        //
        $status=0;
        if($request->input('status')=="without"){
            $status=0;
        }else{
            $status=1;
        }
        $bill_date=$request->input('bill_date');
        $bill_date=Carbon::createFromFormat('d-m-y',$bill_date)->format('Y-m-d');
        $billUpdate=Bill::find($bill->id);
        if($request->input('supplier_id')!=""){
            $billUpdate->supplier_id=$request->input('supplier_id');
        }
        $billUpdate->bill_date=$bill_date;
        $billUpdate->bill_status=$status;
        $update=$billUpdate->save();
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
    public function destroy(Bill $bill)
    {
        //
        $billProducts=BillProduct::where(["bill_id"=>$bill->id])->delete();
        $billExpences=BillExpence::where(['bill_id'=>$bill->id])->delete();
        $bills=Bill::find($bill->id);
        $bills->delete();
         return array('status' => 'Succesfull' );
    }
}
