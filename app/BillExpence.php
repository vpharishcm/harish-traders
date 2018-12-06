<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillExpence extends Model
{
    //
    protected $fillable=['bill_id','expence_id','amount'];
    public $timestamps=false;
    public function bill()
    {
        return $this->belongsTo('App\Bill');
    }
    public function expence()
    {
        return $this->belongsTo('App\Expence');
    }
}
