<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Mexican extends Model
{
    protected $table = 'description_mexican';

    protected $fillable = [
        'description', 'providers_id', 'mexican_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function mexican()
    {
        return $this->belongsTo('App\Food_Mexican');
    }
}