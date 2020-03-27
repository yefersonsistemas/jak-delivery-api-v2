<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = 'municipalities';

    protected $fillable = [

        'name', //'branchoffice_id',

    ];

    // public function branchoffice() {
    //     return $this->belongsTo('App\BranchOffice', 'branchoffice_id');
    // }
}
