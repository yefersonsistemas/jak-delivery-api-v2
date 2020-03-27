<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Korean extends Model
{
    protected $table = 'description_korean';

    protected $fillable = [

        'description', 'providers_id', 'korean_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function korean() {
        return $this->belongsTo('App\Food_Korean', 'korean_id');
    }
}
