<?php

namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;
use \App\Supplier;
use \App\Product;
use \App\Expence;
use \App\BillExpence;
use \App\BillProduct;
use Illuminate\Support\Facades\Auth;
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
        $bills=Bill::orderBy('bill_date', 'desc')->paginate(10);
        foreach($bills as $key=>$bill){
            $d_date=Carbon::parse($bill->bill_date)->format("d-m-Y");
            $bills[$key]['d_date']=$d_date;
        }
        return view('bills.index',['bills'=>$bills]);
    }

 
      

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        $suppliers=Supplier::all();
        $products=Product::all();
        $expences=Expence::all();
        $bill=['suppliers'=>$suppliers,'products'=>$products,'expences'=>$expences];

        return view('bills.create',['bill'=>$bill]);
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
        if(Auth::check()){
            $status=0;
            if($request->input('status')=="without"){
                $status=0;
            }else{
                $status=1;
            }
            $bill_date=$request->input('bill_date');
            $bill_date=Carbon::createFromFormat('dd-mm-yy',$bill_date)->format('Y-m-d');
            $bill=Bill::create([
                'supplier_id'=>$request->input('supplier_id'),
                'bill_date'=>$bill_date,
                'amount'=>0,
                'bill_status'=>$status
                ]);

            if($bill){
                
                return redirect()->route('bill.show',['bill'=>$bill]);
            }
        }
        return route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
        $suppliers=Supplier::all();
        $products=Product::all();
        $expences=Expence::all();
        $d_date=Carbon::parse($bill->bill_date)->format("d-m-Y");
        $bill['d_date']=$d_date;
        $bills=['bill'=>$bill,'suppliers'=>$suppliers,'products'=>$products,'expences'=>$expences];
        return view('bills.show',['bills'=>$bills]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
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
         return redirect()->action('BillController@show', ['id' => $bill->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        $billProducts=BillProduct::where(["bill_id"=>$bill->id])->delete();
        $billExpences=BillExpence::where(['bill_id'=>$bill->id])->delete();
        $bills=Bill::find($bill->id);
        $bills->delete();
        return redirect(route('bill.index'));

    }
}
