<?php

use Illuminate\Database\Seeder;
use App\TypePayment;

class TypePaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypePayment::truncate();

        factory(TypePayment::class)->create([
            'name' => 'Efectivo(Dolar)',
        ]);

        factory(TypePayment::class)->create([
            'name' => 'Pago Movil',
        ]);

        factory(TypePayment::class)->create([
            'name' => 'Transferencia',
        ]);

    }
}