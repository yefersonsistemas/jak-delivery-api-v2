<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';

    protected $fillable = [
        'type_dni', 'dni', 'name', 'lastname', 'phone', 'email', 'address_id'
    ];

    public function address()
    {
        return $this->belongsTo('App\Address', 'address_id');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function courier()
    {
        return $this->belongsTo('App\Courier');
    }
}