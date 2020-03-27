<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'client_id', 'courier_id', 'status', 'providers_id', 'food_arabian_id', 'food_chinese_id', 'food_burguer_id', 'food_pizza_id', 'food_chicken_id',
        'food_korean_id', 'food_indian_id', 'food_italian_id', 'food_salads_id', 'food_vegetarian_id', 'food_vegan_id', 'food_traditional_id', 'food_japanese_id',
        'food_mexican_id', 'extras_id', 'drinks_id', 'bakeries_id', 'liquor_store_id', 'victuals_id', 'delicatesse_id', 'fruit_store_id', 'greengrocer_id',
        'fridge_id', 'lunch_id', 'typepayment_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function courier()
    {
        return $this->belongsTo('App\Courier', 'courier_id');
    }
}