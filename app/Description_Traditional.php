<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Traditional extends Model
{
    protected $table = 'description_tradicional';

    protected $fillable = [

        'description', 'providers_id', 'tradicional_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function tradicional() {
        return $this->belongsTo('App\Food_Tradicional');
    }
}
