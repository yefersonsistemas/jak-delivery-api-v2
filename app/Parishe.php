<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parishe extends Model
{
    protected $table = 'parishe';

    protected $fillable = [

        'name', 'branchoffice_id'

    ];

    public function branchoffice() {
        return $this->belongsTo('App\BranchOffice', 'branchoffice_id');
    }
}