<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Chinese extends Model
{
    protected $table = 'description_chinese';

    protected $fillable = [

        'description', 'providers_id', 'chinese_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function chinese() {
        return $this->belongsTo('App\Food_Chinese');
    }
}
