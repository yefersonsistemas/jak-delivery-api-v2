<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $table = 'couriers';

    protected $fillable = [

        'person_id',  'address_id', 'type_vehicle', 'bussiness_delivery'

    ];

    public function address() {
        return $this->belongsTo('App\Address');
    }

    public function person() {
        return $this->belongsTo('App\Person');
    }
}