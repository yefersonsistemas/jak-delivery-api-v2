<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    
    protected $table = 'schedule';

    protected $fillable = [
        'turn'
    ];

      public function provider()
    {
        return $this->belongsTo('App\Provider');
    }
}
