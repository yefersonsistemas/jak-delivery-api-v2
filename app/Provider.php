<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Passport\HasApiTokens;
// use Spatie\Permission\Traits\HasRoles;

class Provider extends Model
{
    // use HasApiTokens, Notifiable, HasRoles;
    
    protected $table = 'providers';

    protected $fillable = [
        'person_id', 'typepayment_id', 'price_delivery'
    ];

    public function address()
    {
        return $this->belongsTo('App\Address', 'address_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'provider_id');
    }

    public function delicatesse()
    {
        return $this->belongsToMany('App\Delicatesse','providers_delicatesse')
       ->withPivot('delicatesse_id','id');
    }
    public function fridge()
    {
        return $this->belongsToMany('App\Fridge','providers_fridge')
       ->withPivot('fridge_id','id');
    }
    public function fruit()
    {
        return $this->belongsToMany('App\Fruit_Store','providers_fruit')
       ->withPivot('fruit_id','id');
    }
    public function greengrocer()
    {
        return $this->belongsToMany('App\Greengrocer','providers_greengrocer')
       ->withPivot('greengrocer_id','id');
    }
    public function lunch()
    {
        return $this->belongsToMany('App\Lunch','providers_lunch')
       ->withPivot('lunch_id','id');
    }
    public function victual()
    {
        return $this->belongsToMany('App\Victual','providers_victual')
       ->withPivot('victual_id','id');
    }
}