<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $table = 'couriers';

    protected $fillable = [

        'name', 'lastname', 'prone', 'email',  'address_id', 'branchoffice_id'

    ];

    public function address() {
        return $this->belongsTo('App\Address');
    }

    public function branchoffice() {
        return $this->belongsTo('App\BranchOffice', 'branchoffice_id');
    }
}
