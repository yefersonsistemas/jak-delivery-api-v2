<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Chicken extends Model
{
    protected $table = 'description_chicken';

    protected $fillable = [
        'description', 'providers_id', 'chicken_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function chicken()
    {
        return $this->belongsTo('App\Food_Chicken', 'chicken_id');
    }
}