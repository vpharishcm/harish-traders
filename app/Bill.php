<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $fillable =['supplier_id','bill_date','amount','bill_status'];
    public $timestamps=false;
    
    public function supplier()
    {
        return $this->belongsTo('App\Supplier','supplier_id');
    }
    public function products()
    {
        return $this->hasMany('App\BillProduct');
    }
    public function expences()
    {
        return $this->hasMany('App\BillExpence');
    }
     public function product()
    {
        return $this->hasManyThrough('App\Product','Harish_traders\BillProduct','id','product_id');
    }
}
