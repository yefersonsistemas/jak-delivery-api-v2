<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Extra extends Model
{
    
    protected $table = 'description_extras';

    protected $fillable = [
        'description', 'providers_id', 'extras_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function extra()
    {
        return $this->belongsTo('App\Extra');
    }
}