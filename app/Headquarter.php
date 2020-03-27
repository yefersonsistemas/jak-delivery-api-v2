<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Headquarter extends Model
{
    protected $table = 'headquarters';

    protected $fillable = [
        'name'
    ];
}