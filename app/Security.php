<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
     protected $table = 'security';

    protected $fillable = [
        // 'person_id', 'question', 'answers'
      'person_id', 'question_1', 'answers_1', 'question_2', 'answers_2', 'question_3', 'answers_3'
    ]; 

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
