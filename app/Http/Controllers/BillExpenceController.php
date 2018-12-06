<?php

namespace App\Http\Controllers;

use App\BillExpence;
use Illuminate\Http\Request;

class BillExpenceController extends Controller
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
        $billExpence=BillExpence::create([
            'bill_id'=>$request->input('bill_id'),
            'expence_id'=>$request->input('expence_id'),
            'amount'=>$request->input('amount')
        ]);
        if($billExpence){
                return redirect()->action('BillController@show', ['id' => $request->input('bill_id')]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BillExpence  $billExpence
     * @return \Illuminate\Http\Response
     */
    public function show(BillExpence $billExpence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BillExpence  $billExpence
     * @return \Illuminate\Http\Response
     */
    public function edit(BillExpence $billExpence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BillExpence  $billExpence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillExpence $billExpence)
    {
        //
        $billexpence=BillExpence::find($request->input('id'));
        if($request->input('expence_id')!=""){
            $billexpence->expence_id=$request->input('expence_id');
        }
        $billexpence->amount=$request->input("amount");
        $billexpenceUpdate=$billexpence->save();
        return redirect()->action('BillController@show', ['id' => $request->input('bill_id')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BillExpence  $billExpence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,BillExpence $billExpence)
    {
        //
        $billExpenceDelete=BillExpence::find($request->id);
        $billExpenceDelete->delete();
        return redirect()->action('BillController@show', ['id' => $billExpenceDelete->bill_id]);
    }
}
