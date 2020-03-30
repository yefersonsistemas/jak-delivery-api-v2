<?php

use App\State;
use Illuminate\Database\Seeder;
use App\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::truncate();
        
   // factory(State::class)->create([
        //     'name' => 'Amazonas',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Anzoátegui',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Apure',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Aragua',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Barinas',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Bolívar',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Carabobo',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Cojedes',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Delta Amacuro',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Dependencias Federales',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Distrito Capital',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Falcón',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Guárico',
        // ]);

        factory(State::class)->create([
            'name' => 'Lara',
        ]);

        // factory(State::class)->create([
        //     'name' => 'Mérida',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Miranda',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Monagas',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Nueva Esparta',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Portuguesa',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Sucre',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Táchira',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Trujillo',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Vargas',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Yaracuy',
        // ]);

        // factory(State::class)->create([
        //     'name' => 'Zulia',
        // ]);
    }
}