<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    protected $table = 'branchoffice';

    protected $fillable = [
        'name', 'headquarters_id'
    ];

    public function headquarter()
    {
        return $this->belongsTo('App\Headquarter');
    }
}