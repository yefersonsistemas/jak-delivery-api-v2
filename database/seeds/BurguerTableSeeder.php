<?php

use Illuminate\Database\Seeder;
use App\Food_Burguer;

class BurguerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Food_Burguer::truncate();
    }
}