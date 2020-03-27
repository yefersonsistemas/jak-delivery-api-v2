<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Lunch extends Model
{
    protected $table = 'description_lunch';

    protected $fillable = [

        'description', 'providers_id', 'lunch_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function lunch() {
        return $this->belongsTo('App\Food_Lunch', 'lunch_id');
    }
}
