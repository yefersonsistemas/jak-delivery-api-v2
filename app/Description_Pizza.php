<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Pizza extends Model
{
    protected $table = 'description_pizza';

    protected $fillable = [

        'description', 'providers_id', 'pizza_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function pizza() {
        return $this->belongsTo('App\Food_Pizza', 'pizza_id');
    }
}
