<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delicatesse extends Model
{
    protected $table = 'delicatesse';

    protected $fillable = [
        'name', 'price_bs', 'price_us', 'type', 'providers_id'
    ];

    public function provider() //relacion  con la tabla m:m 
    {
        return $this->belongsToMany('App\Provider','providers_delicatesse')
       ->withPivot('providers_id','id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}