<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food_Vegan extends Model
{
    protected $table = 'food_vegans';

    protected $fillable = [

        'name', 'price_bs', 'price_us', 'type', 'providers_id'

    ];

    public function provider() {
        return $this->belongsTo('AppProvider', 'providers_id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

      public function description() {
        return $this->hasOne('App\Description_Vegan', 'vegans_id');
    }
}
