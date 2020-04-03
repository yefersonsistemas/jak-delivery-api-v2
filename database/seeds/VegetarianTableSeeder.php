<?php

use Illuminate\Database\Seeder;
use App\Food_Vegetarian;

class VegetarianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Food_Vegetarian::truncate();
    }
}
