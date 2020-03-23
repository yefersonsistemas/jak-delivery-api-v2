<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class couriers extends Model
{
    protected $table = 'couriers';

    protected $fillable = [
        'name','lastname', 'email','phone','city','address'
    ];
}
