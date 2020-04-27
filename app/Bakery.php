<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bakery extends Model
{
    protected $table = 'bakeries';

    protected $fillable = [

        'name', 'price_bs', 'price_us' 

    ];

    public function provider() //relacion  con la tabla m:m 
    {
        return $this->belongsToMany('App\Provider','providers_bakeries')
       ->withPivot('provider_id','id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function description() {
        return $this->hasOne('App\Description_Bakery', 'bakeries_id');
    }
}
