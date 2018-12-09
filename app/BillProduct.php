<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillProduct extends Model
{
    //
    protected $fillable=['bill_id','product_id','quantity','price','description'];
    public $timestamps=false;
    public function bill()
    {
        return $this->belongsTo('App\Bill','bill_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
}
