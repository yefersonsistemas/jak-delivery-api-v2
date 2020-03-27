<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Delicatesse extends Model
{
    protected $table = 'description_delicatesse';

    protected $fillable = [
        'description', 'providers_id', 'delicatesse_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function delicatesse()
    {
        return $this->belongsTo('App\Delicatesse', 'delicatesse_id');
    }
}