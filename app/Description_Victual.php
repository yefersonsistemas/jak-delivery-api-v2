<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Victual extends Model
{
    protected $table = 'description_victual';

    protected $fillable = [
        'description', 'providers_id', 'victual_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function victual()
    {
        return $this->belongsTo('App\Victual');
    }
}