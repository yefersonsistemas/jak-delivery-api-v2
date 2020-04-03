<?php

use Illuminate\Database\Seeder;
use App\Food_Vegan;

class VeganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Food_Vegan::truncate();
    }
}
