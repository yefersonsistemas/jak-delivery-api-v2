<?php

use Illuminate\Database\Seeder;
use App\Courier;

class CourierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Courier::truncate();
    }
}