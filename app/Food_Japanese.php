<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food_Japanese extends Model
{
    protected $table = 'food_japanese';

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

      public function description() {
        return $this->hasOne('App\Description_Japanese', 'japanese_id');
    }
}
