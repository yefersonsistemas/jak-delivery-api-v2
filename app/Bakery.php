<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bakery extends Model
{
    protected $table = 'bakeries';

    protected $fillable = [

        'name', 'price_bs', 'price_us', 'providers_id' 

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }
}
