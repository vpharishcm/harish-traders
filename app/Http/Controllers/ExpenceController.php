<?php

namespace App\Http\Controllers;

use App\Expence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenceController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        //
        $expences=Expence::paginate(10);
        return view('expences.index',['expences'=>$expences]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('expences.create');
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
            $expence=Expence::create(['name'=>$request->input('name')]);
            $previous=url()->previous();
            if($expence){
                if (strchr($previous,'bill')) {
                        $arr = explode('/', $previous);
                        $count = count($arr);

                        $id=$arr[$count - 1];
                        return redirect('bill\\'.$id);
                    }
                return redirect()->route('expence.index',['expence'=>$expence])->with(['scucess' => 'Sucessfully added']);
            }
        }
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expence  $expence
     * @return \Illuminate\Http\Response
     */
    public function show(Expence $expence)
    {
        //
        return view('expences.show',['expence'=>$expence]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expence  $expence
     * @return \Illuminate\Http\Response
     */
    public function edit(Expence $expence)
    {
        //
        $expences=Expence::find($expence->id);
        
        return view('expences.update',['expence'=>$expence]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expence  $expence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expence $expence)
    {
        //
        $expences=Expence::find($expence->id);
        $expences->name=$request->input('name');
        $update=$expences->save();
        if($update){
            return redirect()->route('expence.show',['expence'=>$expences]);
    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expence  $expence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expence $expence)
    {
        //
        $expenceDelete=Expence::find($expence->id);
        $expenceDelete->delete();
        return redirect(route('expence.index'));
    }
}
