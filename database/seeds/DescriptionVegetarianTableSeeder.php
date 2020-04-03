<?php

use Illuminate\Database\Seeder;
use App\Description_Vegetarian;

class DescriptionVegetarianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Description_Vegetarian::truncate();
    }
}
