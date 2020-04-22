<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food_Korean extends Model
{
    protected $table = 'food_korean';

    protected $fillable = [
        'name', 'price_bs', 'price_us', 'type', 'providers_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

      public function description() {
        return $this->hasOne('App\Description_Korean', 'korean');
    }
}