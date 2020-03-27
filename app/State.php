<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'state';

    protected $fillable = [

        'name', 'branchoffice_id'

    ];

    public function branchoffice() {
        return $this->belongsTo('App\BranchOffice', 'branchoffice_id');
    }
}