<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delicatesse extends Model
{
    protected $table = 'delicatesse';

    protected $fillable = [
        'name', 'price_bs', 'price_us', 'type'
    ];

    public function provider() //relacion  con la tabla m:m 
    {
        return $this->belongsToMany('App\Provider','providers_delicatesse')
       ->withPivot('provider_id','id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

      public function description() {
        return $this->hasOne('App\Description_Delicatesse', 'delicatesse_id');
    }
}