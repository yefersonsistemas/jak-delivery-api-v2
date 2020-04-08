<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Person;
use App\Address;
use App\Provider;
use App\State;
use App\Municipality;
use App\Parishe;
use App\City;
use App\Typepayment;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Person::truncate();
        Address::truncate();
        Provider::truncate();
        
        $state = factory(State::class)->create([
            'name' => 'Lara',
        ]);

        $city = factory(City::class)->create([
            'name' => 'Barquisimeto',
        ]);

        $municipality = factory(Municipality::class)->create([
            'name' => 'Iribarren',
        ]);

        $parishe = factory(Parishe::class)->create([
            'name' => 'Catedral',
        ]);

        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'Av. Venezuela entre calle 6 y 7',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'J',
            'dni' => '000297860',
            'name' => 'Flash Burguer',
            'lastname' => null,
            'phone' => '02522612523',
            'email' => 'flashburguer@hotmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client');

        $typepayment = factory(Typepayment::class)->create([
            'name' => 'Efectivo',
        ]);

        $provider = factory(Provider::class)->create([
            'person_id' => $person->id,
            'price_delivery' => 50000,
            'typepayment_id' =>  $typepayment->id,
        ]);


    }
}