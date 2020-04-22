<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $table = 'drinks';

    protected $fillable = [

        'name', 'price_bs', 'price_ud', 'type_drink', 'providers_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function description() {
        return $this->hasOne('App\Description_Drink', 'drinks_id');
    }
}
