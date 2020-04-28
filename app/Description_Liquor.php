<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Liquor extends Model
{
    
    protected $table = 'description_liquor';

    protected $fillable = [
        'description', 'liquor_id', 'providers_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    public function liquor()
    {
        return $this->belongsTo('App\Liquor');
    }
}