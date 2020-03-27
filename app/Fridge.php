<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fridge extends Model
{
    protected $table = 'fridge';

    protected $fillable = [

        'name', 'price_bs', 'price_us', 'type', 'providers_id'

    ];

    public function provider() {
        return $this->belongsToMany('App\Provider', 'providers_id');
    }
}
