<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Arabian extends Model
{
    protected $table = 'description_arabian';

    protected $fillable = [

        'description', 'providers_id', 'arabian_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function arabian() {
        return $this->belongsTo('App\Food_Arabian', 'arabian_id');
    }
}
