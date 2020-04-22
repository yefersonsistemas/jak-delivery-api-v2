<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Drink extends Model
{
    protected $table = 'description_drinks';

    protected $fillable = [

        'description', 'providers_id', 'drinks_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function drink() {
        return $this->belongsTo('App\Food_Drink');
    }
}
