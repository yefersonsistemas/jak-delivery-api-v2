<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $table = 'drink';

    protected $fillable = [

        'name', 'providers_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

}
