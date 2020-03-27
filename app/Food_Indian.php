<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food_Indian extends Model
{
    protected $table = 'food_indian';

    protected $fillable = [

        'name', 'price_bs', 'price_us', 'type', 'providers_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }
}
