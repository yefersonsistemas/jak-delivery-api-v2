<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name','lastname', 'email','phone','city','address'
    ];
}
