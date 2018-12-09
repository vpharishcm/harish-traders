<?php

namespace App\Http\Controllers;

use App\Product;
use App\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Charts\price;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product=Product::paginate(10);

        return view('products.index',['products'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $filename=NULL;
            if($request->hasFile('img')){
                
                $filename=Storage::put('public/products', $request->file('img'));
            }
            $product=Product::create([
                'name'=> $request->input('name'),
                'image'=> $filename
            ]);
            $previous=url()->previous();
            if($product){
                   if (strchr($previous,'bill')) {
                        $arr = explode('/', $previous);
                        $count = count($arr);

                        $id=$arr[$count - 1];
                        return redirect('bill\\'.$id);
                    }
                return redirect()->route('product.index',['product'=>$product])->with(['scucess' => 'Sucessfully added']);
            }
        }
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $billProduct=$product->billProduct;
        $dates=array();
        $price=array();
        $chart=new price();
        foreach ($billProduct as $key => $temp) {
            $bill=Bill::where('id',$temp->bill_id)->get()->first();
            $billProduct[$key]['bill_date']=$bill->bill_date;
            $billProduct[$key]['supplier']=$bill->supplier;
            $dates[$key]=$bill->bill_date;
            $price[$key]=$temp->price;
        }
        if($product->image!=""){
            $url =Storage::url($product->image);
            $product['url']=$url;
        }
        $chart->labels($dates)
              ->dataset("Price", "line", $price);
        return view('products.show',['product'=>$product,'bill'=>$billProduct,'chart'=>$chart]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $products=Product::find($product->id);
        if($product->image!=""){
            $url =Storage::url($product->image);
            $products['url']=$url;
        }
        return view('products.update', ['product' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        
        $product=Product::find($request->input('id'));
        $filename=$product->image;
        if($request->hasFile('img')){
            Storage::delete($filename);
            $filename=Storage::put('public/products', $request->file('img'));
        }
        $product->name=$request->input('name');
        $product->image=$filename;
        $update=$product->save();
        if($update){
            return redirect()->route('product.show',['product'=>$product])->with(['scucess' => 'Sucessfully updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
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
        return redirect(route('product.index'));
    }
}
