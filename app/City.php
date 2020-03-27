<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [

        'name', //'branchoffice_id',

    ];

    // public function branchoffice() {
    //     return $this->belongsTo('App\BranchOffice', 'branchoffice_id');
    // }
}
