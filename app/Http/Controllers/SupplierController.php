<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier=Supplier::paginate(10);

        return view('suppliers.index',['suppliers'=>$supplier]);
    }
    public function showAll()
    {
        $supplier=Supplier::all();

        return $supplier;
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
        $previous = url()->previous();
        
        if(Auth::check()){
            $supplier=Supplier::create(['name'=>$request->input('name'),'place'=>$request->input('place')]);
            if($supplier){
                if (strchr($previous,'bill')) {
                    return redirect()->route('bill.create');
                }else{
                    return redirect()->route('supplier.index',['supplier'=>$supplier])->with(['scucess' => 'Sucessfully added']);
                }
                
            }
        }
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //

        return view('suppliers.show',['supplier'=>$supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    
        
        $suppliers=Supplier::find($supplier->id);
        
        return view('suppliers.update',['supplier'=>$supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
        $suppliers=Supplier::find($supplier->id);
        $suppliers->name=$request->input('name');
        $suppliers->place=$request->input('place');
        $update=$suppliers->save();
        if($update){
            return redirect()->route('supplier.show',['supplier'=>$suppliers]);
    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
        $supplierDelete=Supplier::find($supplier->id);
        $supplierDelete->delete();
        return redirect(route('supplier.index'));
    }
}
