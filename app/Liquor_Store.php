<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquor_Store extends Model
{
    protected $table = 'liquor_store';

    protected $fillable = [
        'name', 'price_bs', 'price_us', 'providers_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }
}