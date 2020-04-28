<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquor extends Model
{
    protected $table = 'liquor';

    protected $fillable = [
        'name', 'price_bs', 'price_us'
    ];

   public function provider()
    {
        return $this->belongsToMany('App\Provider','providers_liquor')
       ->withPivot('provider_id','id');
    }

      public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

      public function description() {
        return $this->hasOne('App\Description_Liquor', 'liquor_id');
    }
}