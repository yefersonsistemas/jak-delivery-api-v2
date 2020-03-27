<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food_Vegan extends Model
{
    protected $table = 'food_vegan';

    protected $fillable = [

        'name', 'price_bs', 'price_us', 'type', 'providers_id'

    ];

    public function provider() {
        return $this->belongsTo('AppProvider', 'providers_id');
    }
}
