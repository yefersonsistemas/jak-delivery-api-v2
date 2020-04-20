<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'person_id', 'address_id'
    ];

    public function address()
    {
        return $this->belongsTo('App\Address', 'address_id');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
    
    public function person()
    {
        return $this->belongsTo('App\Person', 'person_id');
    }

    public function order()
    {
        return $this->hasOne('App\Order');
    }
}