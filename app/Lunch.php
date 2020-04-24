<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    protected $table = 'lunch';

    protected $fillable = [

        'name', 'price_bs', 'price_us', 'type'

    ];

    public function provider()
    {
        return $this->belongsToMany('App\Provider','providers_lunch')
       ->withPivot('provider_id','id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

      public function description() {
        return $this->hasOne('App\Description_Lunch', 'lunch_id');
    }
}
