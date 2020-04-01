<?php

use Illuminate\Database\Seeder;
use App\Description_Burguer;

class DescriptionBurguerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Description_Burguer::truncate();
    }
}