<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable=['name','image'];
    public $timestamps=false;
    public function billProduct()
    {
        return $this->hasMany('App\BillProduct');
    }
}
