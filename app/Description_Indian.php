<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Indian extends Model
{
    
    protected $table = 'description_indian';

    protected $fillable = [
        'description', 'providers_id', 'indian_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function indian()
    {
        return $this->belongsTo('App\Food_Indian');
    }
}