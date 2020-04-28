<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    protected $table = 'fruit';

    protected $fillable = [
        'name', 'price_bs', 'price_us', 'type'
    ];

    public function provider()
    {
        return $this->belongsToMany('App\Provider','providers_fruit')
       ->withPivot('provider_id','id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

      public function description() {
        return $this->hasOne('App\Description_Fruit', 'fruit_id');
    }
}