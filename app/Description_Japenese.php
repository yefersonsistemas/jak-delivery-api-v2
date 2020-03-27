<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Japenese extends Model
{
    
    protected $table = 'description_japanese';

    protected $fillable = [
        'description', 'providers_id', 'japanese_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function japanese()
    {
        return $this->belongsTo('App\Food_Japanese', 'japanese_id');
    }
}