<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruit_Store extends Model
{
    protected $table = 'fruit_store';

    protected $fillable = [
        'name', 'price_bs', 'price_us', 'type', 'providers_id'
    ];

    public function provider()
    {
        return $this->belongsToMany('App\Provider','providers_fruit')
       ->withPivot('providers_id','id');
    }
}