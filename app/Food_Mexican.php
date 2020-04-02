<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food_Mexican extends Model
{
    protected $table = 'food_mexican';

    protected $fillable = [

        'name', 'price_bs', 'price_us', 'type', 'providers_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}
