<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Fruit extends Model
{
    
    protected $table = 'description_fruit';

    protected $fillable = [
        'description', 'providers_id', 'fruit_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function fruit()
    {
        return $this->belongsTo('App\Fruit_Store', 'fruit_id');
    }
}