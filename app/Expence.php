<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expence extends Model
{
    //
    protected $fillable=['name'];
    public $timestamps=false;
    public function billExpence()
    {
        return $this->belongsToMany('App\BillExpences');
    }
}
