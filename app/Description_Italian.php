<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Italian extends Model
{
    protected $table = 'description_italian';

    protected $fillable = [

        'description', 'providers_id', 'italian_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function italian() {
        return $this->belongsTo('App\Food_Italian', 'italian_id');
    }
}
