<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description_Burguer extends Model
{
    protected $table = 'description_burguer';

    protected $fillable = [

        'description', 'providers_id', 'burguer_id'

    ];

    public function provider() {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function burguer() {
        return $this->belongsTo('App\Food_Burguer', 'burguer_id');
    }
}
