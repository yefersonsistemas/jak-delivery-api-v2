<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Bakery extends Model
{
    protected $table = 'description_bakeries';

    protected $fillable = [
        'description', 'providers_id', 'bakeries_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function bakery()
    {
        return $this->belongsTo('App\Bakery');
    }
}