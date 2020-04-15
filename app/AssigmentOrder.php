<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssigmentOrder extends Model
{
    protected $table = 'assigment_order';

    protected $fillable = [
        'order_id', 'courier_id'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function courier()
    {
        return $this->belongsTo('App\Courier');
    }
}
