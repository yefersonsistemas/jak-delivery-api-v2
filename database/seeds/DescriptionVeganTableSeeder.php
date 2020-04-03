<?php

use Illuminate\Database\Seeder;
use App\Description_Vegan;

class DescriptionVeganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Description_Vegan::truncate();
    }
}
