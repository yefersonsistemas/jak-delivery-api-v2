<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Salad extends Model
{
    protected $table = 'description_salads';

    protected $fillable = [
        'description', 'providers_id', 'salads_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function salad()
    {
        return $this->belongsTo('App\Food_Salad');
    }
}