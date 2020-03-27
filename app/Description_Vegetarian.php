<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Vegetarian extends Model
{
    protected $table = 'description_vegetarian';

    protected $fillable = [

        'description', 'providers_id', 'vegetarian_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function vegetarian() {
        return $this->belongsTo('App\Food_Vegetarian', 'vegetarian_id');
    }
}
