<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Vegan extends Model
{
    protected $table = 'description_vegan';

    protected $fillable = [
        'description', 'providers_id', 'vegan_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function vegan()
    {
        return $this->belongsTo('App\Food_Vegan', 'vegan_id');
    }
}