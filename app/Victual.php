<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Victual extends Model
{
    protected $table = 'liquor_store';

    protected $fillable = [
        'name', 'price_bs', 'price_us', 'type', 'providers_id'
    ];

    public function provider()
    {
        return $this->belongsToMany('App\Provider','providers_victuals')
       ->withPivot('providers_id','id');
    }
    
      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}