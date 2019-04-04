<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplier=Supplier::all();
          return array(
            'status' => 'success',
            'pages' => $supplier->toArray()
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
        $supplier=Supplier::create([
            'name'=>$request->input('name'),'place'=>$request->input('place')            
        ]);
        if($supplier){
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
    public function show( Supplier $supplier)
    {
        //
        return array('Supplier'=>$supplier);
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
    public function update(Request $request, Supplier $supplier)
    {
        //
        $supplier=Supplier::find($request->input('id'));
        $supplier->name=$request->input('name');
        $supplier->place=$request->input('place');
        $update=$supplier->save();
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
    public function destroy(Supplier $supplier)
    {
        //
       $supplierDelete=Supplier::find($supplier->id);
       $supplierDelete->delete();
       return array('status' => 'Succesfull' );
    }
}
