<?php

use App\Municipality;
use Illuminate\Database\Seeder;

class MunicipalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Municipality::truncate();
        // $this->deleteDirectory(directory);
        
        factory(Municipality::class)->create([
            'name' => 'Andrés Eloy Blanco',
        ]);

        factory(Municipality::class)->create([
            'name' => 'Crespo',
        ]);

        factory(Municipality::class)->create([
            'name' => 'Iribarren',
        ]);

        factory(Municipality::class)->create([
            'name' => 'Jiménez',
        ]);

        factory(Municipality::class)->create([
            'name' => 'Morán',
        ]);

        factory(Municipality::class)->create([
            'name' => 'Palavecino',
        ]);

        factory(Municipality::class)->create([
            'name' => 'Simón Planas',
        ]);

        factory(Municipality::class)->create([
            'name' => 'Torres',
        ]);

        factory(Municipality::class)->create([
            'name' => 'Urdaneta',
        ]);

    }
}
