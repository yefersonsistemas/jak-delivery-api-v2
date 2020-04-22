<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Fridge extends Model
{
    protected $table = 'description_fridge';

    protected $fillable = [

        'description', 'providers_id', 'fridge_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function fridge() {
        return $this->belongsTo('App\Food_Fridge');
    }
}
