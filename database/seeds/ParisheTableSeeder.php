<?php

use App\Parishe;
use Illuminate\Database\Seeder;

class ParisheTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parishe::truncate();

        factory(Parishe::class)->create([
            'name' => 'Aguedo Alvarado',
        ]);

        factory(Parishe::class)->create([
            'name' => 'Ana Soto(Juan de Villegas)',
        ]);

        factory(Parishe::class)->create([
            'name' => 'Buena Vista',
        ]);

        factory(Parishe::class)->create([
            'name' => 'Catedral',
        ]);

        factory(Parishe::class)->create([
            'name' => 'El Cuji',
        ]);

        factory(Parishe::class)->create([
            'name' => 'Juárez',
        ]);

        factory(Parishe::class)->create([
            'name' => 'La Concepción',
        ]);

        factory(Parishe::class)->create([
            'name' => 'Santa Rosa',
        ]);

        factory(Parishe::class)->create([
            'name' => 'Tamaca',
        ]);

        factory(Parishe::class)->create([
            'name' => 'Unión',
        ]);
    }
}
