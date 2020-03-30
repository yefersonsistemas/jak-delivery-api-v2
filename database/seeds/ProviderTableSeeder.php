<?php

use Illuminate\Database\Seeder;
use App\Provider;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::truncate();
    }
}