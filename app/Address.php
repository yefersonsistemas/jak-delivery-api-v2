<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
        'states_id', 'cities_id', 'municipalities_id', 'parishes_id', 'branchoffice_id', 'address'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    public function courier()
    {
        return $this->belongsTo('App\Courier');
    }
    

}