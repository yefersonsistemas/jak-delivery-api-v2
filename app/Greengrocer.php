<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Greengrocer extends Model
{
    protected $table = 'greengrocer';

    protected $fillable = [

        'name', 'price_bs', 'price_us', 'type', 'providers_id'

    ];

    public function provider() {
        return $this->belongsToMany('App\Provider', 'providers_id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

      public function description() {
        return $this->hasOne('App\Description_Greengrocer', 'greengrocer_id');
    }
}
