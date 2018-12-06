<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable=['name','place'];
    public $timestamps=false;
    public function bill()
    {
        return $this->hasMany('App\Bill');
    }
}
