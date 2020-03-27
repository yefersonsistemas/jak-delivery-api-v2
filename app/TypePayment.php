<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypePayment extends Model
{
    protected $table = 'typepayment';

    protected $fillable = [
        'name'
    ];
}