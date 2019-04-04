<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\BillExpence;

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
    public function update(Request $request,BillExpence $billExpence)
    {
        //
        $billexpence=BillExpence::find($request->input('id'));
        if($request->input('expence_id')!=""){
            $billexpence->expence_id=$request->input('expence_id');
        }
        $billexpence->amount=$request->input("amount");
        $update=$billexpence->save();
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
    public function destroy(Request $request,BillExpence $billExpence)
    {
        //
        $billExpenceDelete=BillExpence::find($request->id);
        $billExpenceDelete->delete();
        return array('status' => 'Succesfull' );
    }
}
