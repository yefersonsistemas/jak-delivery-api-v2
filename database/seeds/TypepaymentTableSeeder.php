<?php

use Illuminate\Database\Seeder;
use App\Typepayment;

class TypepaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Typepayment::truncate();
        
        // factory(Typepayment::class)->create([
        //     'name' => 'Efectivo',
        // ]);

        // factory(Typepayment::class)->create([
        //     'name' => 'Pago Móvil',
        // ]);

        // factory(Typepayment::class)->create([
        //     'name' => 'Transferencia',
        // ]);
    }
}