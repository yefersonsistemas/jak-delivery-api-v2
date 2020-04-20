<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $table = 'extras';

    protected $fillable = [
        'name', 'price_bs', 'price_ud', 'type_extra', 'providers_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function description() {
        return $this->belongsTo('App\Description_Extra');
    }

    public function order() {
        return $this->belongsTo('App\Order');
    }

}