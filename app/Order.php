<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'clients_id', 'couriers_id', 'providers_id', 'status', 'food_arabian_id', 'food_chinese_id', 'food_burguer_id', 'food_pizza_id', 'food_chicken_id',
        'food_korean_id', 'food_indian_id', 'food_italian_id', 'food_salads_id', 'food_vegetarian_id', 'food_vegans_id', 'food_traditional_id', 'food_japanese_id',
        'food_mexican_id', 'extras_id', 'drinks_id', 'bakeries_id', 'liquor_store_id', 'victuals_id', 'delicatesse_id', 'fruit_store_id', 'greengrocer_id',
        'fridge_id', 'lunch_id', 'typepayment_id'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'providers_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Client', 'clients_id');
    }

    public function courier()
    {
        return $this->belongsTo('App\Courier', 'couriers_id');
    }

      public function assigment()
    {
        return $this->belongsTo('App\AssigmentOrder');
    }

      public function burguer()
    {
        return $this->belongsTo('App\Food_Burguer');
    }

      public function arabian()
    {
        return $this->belongsTo('App\Food_Arabian');
    }

      public function chinese()
    {
        return $this->belongsTo('App\Food_Chinese');
    }

      public function japanese()
    {
        return $this->belongsTo('App\Food_Japanese');
    }

      public function mexican()
    {
        return $this->belongsTo('App\Food_Mexican');
    }

      public function drink()
    {
        return $this->belongsTo('App\Drink');
    }

      public function extra()
    {
        return $this->belongsTo('App\Extra');
    }

      public function salad()
    {
        return $this->belongsTo('App\Food_Salad');
    }

      public function vegan()
    {
        return $this->belongsTo('App\Food_Vegan');
    }

      public function vegetarian()
    {
        return $this->belongsTo('App\Food_Vegetarian');
    }

      public function indian()
    {
        return $this->belongsTo('App\Food_Indian');
    }

      public function italian()
    {
        return $this->belongsTo('App\Food_Italian');
    }

      public function korean()
    {
        return $this->belongsTo('App\Food_Korean');
    }

      public function traditional()
    {
        return $this->belongsTo('App\Food_Traditional');
    }

      public function pizza()
    {
        return $this->belongsTo('App\Food_Pizza');
    }

      public function chicken()
    {
        return $this->belongsTo('App\Food_Chicken');
    }

      public function liquor()
    {
        return $this->belongsTo('App\Liquor_Store');
    }

      public function bakery()
    {
        return $this->belongsTo('App\Bakery');
    }

      public function victual()
    {
        return $this->belongsTo('App\Victual');
    }

      public function delicatesse()
    {
        return $this->belongsTo('App\Delicatesse');
    }
    
      public function lunch()
    {
        return $this->belongsTo('App\Lunch');
    }

      public function fridge()
    {
        return $this->belongsTo('App\Fridge');
    }

      public function typepayment()
    {
        return $this->belongsTo('App\Typepayment');
    }

      public function greengrocer()
    {
        return $this->belongsTo('App\Greengrocer');
    }

      public function fruit()
    {
        return $this->belongsTo('App\Fruit_Store');
    }
}