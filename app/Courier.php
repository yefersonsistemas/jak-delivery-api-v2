<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $table = 'couriers';

    protected $fillable = [

        'person_id', 'type_vehicle', 'bussiness_delivery'

    ];

    public function person() {
        return $this->belongsTo('App\Person');
    }

     public function order()
    {
        return $this->hasOne('App\Order');
    }
}