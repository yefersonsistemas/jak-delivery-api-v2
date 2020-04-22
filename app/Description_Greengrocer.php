<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Greengrocer extends Model
{
    protected $table = 'description_greengrocer';

    protected $fillable = [

        'description', 'providers_id', 'greengrocer_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function greengrocer() {
        return $this->belongsTo('App\Food_Greengrocer');
    }
}
