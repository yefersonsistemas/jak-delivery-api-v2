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
use App\TypePayment;
use App\Food_Burguer;
use App\Description_Burguer;
use App\Food_Italian;
use App\Description_Italian;
use App\Food_Chicken;
use App\Description_Chicken;
use App\Food_Chinese;
use App\Description_Chinese;
use App\Food_Japanese;
use App\Description_Japanese;
use App\Food_Arabian;
use App\Description_Arabian;
use App\Food_Mexican;
use App\Description_Mexican;
use App\Food_Pizza;
use App\Description_Pizza;
use App\Drink;
use App\Description_Drink;
use App\Image;
use App\Client;
use App\Courier;
use App\Security;

use App\Bakery;
use App\Description_Bakery;
use App\Victual;
use App\Description_Victual;
use App\Delicatesse;
use App\Description_Delicatesse;
use App\Lunch;
use App\Description_Lunch;
use App\Liquor;
use App\Description_Liquor;
use App\Fruit;
use App\Description_Fruit;
use App\Fridge;
use App\Description_Fridge;
use App\Greengrocer;
use App\Description_Greengrocer;

use App\Traits\ImageFactory;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    use ImageFactory;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Security::truncate();
        Person::truncate();
        Address::truncate();
        Provider::truncate();
        Image::truncate();
        Client::truncate();
        Courier::truncate();
        TypePayment::truncate();
        Food_Burguer::truncate();
        Description_Burguer::truncate();
        Food_Japanese::truncate();
        Description_Japanese::truncate();
        Food_Chinese::truncate();
        Description_Chinese::truncate();
        Food_Chicken::truncate();
        Description_Chicken::truncate();
        Food_Mexican::truncate();
        Description_Mexican::truncate();
        Food_Pizza::truncate();
        Description_Pizza::truncate();
        Food_Italian::truncate();
        Description_Italian::truncate();
        Food_Arabian::truncate();
        Description_Arabian::truncate();
        Drink::truncate();
        Description_Drink::truncate();

        Bakery::truncate();
        Description_Bakery::truncate();
        Victual::truncate();
        Description_Victual::truncate();
        Delicatesse::truncate();
        Description_Delicatesse::truncate();
        Lunch::truncate();
        Description_Lunch::truncate();
        Liquor::truncate();
        Description_Liquor::truncate();
        Fruit::truncate();
        Description_Fruit::truncate();
        Fridge::truncate();
        Description_Fridge::truncate();
        Greengrocer::truncate();
        Description_Greengrocer::truncate();
        
        
        // $this->deleteDirectory(storage_path('/app/public/comida-rapida'));
        
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

        $typepayment = factory(TypePayment::class)->create([
            'name' => 'Efectivo',
        ]);

        factory(TypePayment::class)->create([
            'name' => 'Pago Móvil',
        ]);

        factory(TypePayment::class)->create([
            'name' => 'Transferencia',
        ]);

        //========== 1er proveedor=======================================

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

        $question = factory(Security::class)->create([
            'person_id' => $person->id,
            'question_1' => 'Primer auto',
            'answers_1' => 'Corolla',
            'question_2' => 'Color preferido',
            'answers_2' => 'Azul',
            'question_3' => 'Comida favorita',
            'answers_3' => 'Pizza',
        ]);

        $provider = factory(Provider::class)->create([
            'person_id' => $person->id,
            'price_delivery' => 50000,
            'typepayment_id' =>  $typepayment->id,
        ]);
        
        $burguer =  factory(Food_Burguer::class)->create([
            'name'         => 'Hamburguesa texa',
            'price_bs'     => 450000,
            'price_us'     => 4,
            'type'         => 'hamburguesa',
            'providers_id' => $provider->id,
        ]);
        
        $this->to('comida-rapida', $burguer->id, 'App\Food_Burguer');

        $description = factory(Description_Burguer::class)->create([
            'description' => 'Doble carne y huevo frito',
            'providers_id' => $provider->id,
            'burguer_id' =>  $burguer->id,
        ]);

        $burguer1 =  factory(Food_Burguer::class)->create([
            'name'         => 'Hamburguesa sencilla',
            'price_bs'     => 100000,
            'price_us'     => 1,
            'type'         => 'hamburguesa',
            'providers_id' => $provider->id,
        ]);
        
        $this->to('comida-rapida', $burguer1->id, 'App\Food_Burguer');

        $description = factory(Description_Burguer::class)->create([
            'description' => 'carne y ensalada',
            'providers_id' => $provider->id,
            'burguer_id' =>  $burguer1->id,
        ]);

        $chicken =  factory(Food_Chicken::class)->create([
            'name'         => 'Pollo asado',
            'price_bs'     => 200000,
            'price_us'     => 2,
            'type'         => 'pollo',
            'providers_id' => $provider->id,
        ]);

        
        $this->to('pollo', $chicken->id, 'App\Food_chicken');
        
        $description = factory(Description_Chicken::class)->create([
            'description' => 'pollo asado familiar con ensalada dulce y 4 hallaquitas',
            'providers_id' => $provider->id,
            'chicken_id' =>  $chicken->id,
        ]);

        $drink =  factory(Drink::class)->create([
            'name'         => 'cocacola ',
            'price_bs'     => 60000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider->id,
        ]);

        $this->to('bebidas', $drink->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola negra',
            'providers_id' => $provider->id,
            'drinks_id' =>  $drink->id,
        ]);

        $drink1 =  factory(Drink::class)->create([
            'name'         => 'kolita ',
            'price_bs'     => 60000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider->id,
        ]);

        $this->to('bebidas', $drink1->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'kolita',
            'providers_id' => $provider->id,
            'drinks_id' =>  $drink1->id,
        ]);


        //========== 2do proveedor=======================================

        
        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'calle 30 entre carrera 20 y 21',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'J',
            'dni' => '000297861',
            'name' => 'El Caracas',
            'lastname' => null,
            'phone' => '02522612524',
            'email' => 'caracas@hotmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client');

        $question1 =  factory(Security::class)->create([
            'person_id' => $person->id,
            'question_1' => 'Nombre de mascota',
            'answers_1' => 'escarabajo',
            'question_2' => 'Alias',
            'answers_2' => 'Caracas',
            'question_3' => 'Programa preferido',
            'answers_3' => 'CSI',
        ]);

        $provider2 = factory(Provider::class)->create([
            'person_id' => $person->id,
            'price_delivery' => 100000,
            'typepayment_id' =>  $typepayment->id,
        ]);

        $burguer =  factory(Food_Burguer::class)->create([
            'name'         => 'Hamburguesa sencilla',
            'price_bs'     => 150000,
            'price_us'     => 1,
            'type'         => 'hamburguesa',
            'providers_id' => $provider2->id,
        ]);
        
        $this->to('comida-rapida', $burguer->id, 'App\Food_Burguer');

        $description = factory(Description_Burguer::class)->create([
            'description' => 'Doble carne y huevo frito',
            'providers_id' => $provider2->id,
            'burguer_id' =>  $burguer->id,
        ]);

        $chicken =  factory(Food_Chicken::class)->create([
            'name'         => 'Pollo asado',
            'price_bs'     => 180000,
            'price_us'     => 2,
            'type'         => 'pollo',
            'providers_id' => $provider2->id,
        ]);

        
        $this->to('pollo', $chicken->id, 'App\Food_Chicken');
        
        $description = factory(Description_Chicken::class)->create([
            'description' => 'pollo asado familiar con ensalada dulce y 4 hallaquitas',
            'providers_id' => $provider2->id,
            'chicken_id' =>  $chicken->id,
        ]);

        $pizza =  factory(Food_Pizza::class)->create([
            'name'         => 'Pizza vegetariana',
            'price_bs'     => 230000,
            'price_us'     => 4,
            'type'         => 'pizza',
            'providers_id' => $provider2->id,
        ]);
        
        $this->to('pizza', $pizza->id, 'App\Food_Pizza');

        $description = factory(Description_Pizza::class)->create([
            'description' => 'pimenton, cebolla, aceituna negra y champiñon',
            'providers_id' => $provider2->id,
            'pizza_id' =>  $pizza->id,
        ]);

        $arabian =  factory(Food_Arabian::class)->create([
            'name'         => 'falafe',
            'price_bs'     => 200000,
            'price_us'     => 2,
            'type'         => 'falafe',
            'providers_id' => $provider2->id,
        ]);

        
        $this->to('arabe', $arabian->id, 'App\Food_Arabian');
        
        $description = factory(Description_Arabian::class)->create([
            'description' => 'rollo de carne molida relleno con ensalada',
            'providers_id' => $provider2->id,
            'arabian_id' =>  $arabian->id,
        ]);

        $drink =  factory(Drink::class)->create([
            'name'         => 'cocacola ',
            'price_bs'     => 60000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider2->id,
        ]);

        $this->to('bebidas', $drink1->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola negra',
            'providers_id' => $provider2->id,
            'drinks_id' =>  $drink->id,
        ]);

        $drink1 =  factory(Drink::class)->create([
            'name'         => 'malta ',
            'price_bs'     => 60000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider2->id,
        ]);

        $this->to('bebidas', $drink1->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola negra',
            'providers_id' => $provider2->id,
            'drinks_id' =>  $drink1->id,
        ]);


       //========== 3er proveedor=======================================

        
        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'el tostao calle 10',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'J',
            'dni' => '120297860',
            'name' => 'El gran arabe',
            'lastname' => null,
            'phone' => '02522612550',
            'email' => 'granarabe@hotmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client');

        $question2 =  factory(Security::class)->create([
            'person_id' => $person->id,
            'question_1' => 'Auto que quiero',
            'answers_1' => 'Lamborghini',
            'question_2' => 'Color preferido',
            'answers_2' => 'Rojo',
            'question_3' => 'Mascota',
            'answers_3' => 'perro',
        ]);

        $provider3 = factory(Provider::class)->create([
            'person_id' => $person->id,
            'price_delivery' => 80000,
            'typepayment_id' =>  $typepayment->id,
        ]);

        $pizza =  factory(Food_Pizza::class)->create([
            'name'         => 'Pizza vegetariana',
            'price_bs'     => 200000,
            'price_us'     => 4,
            'type'         => 'pizza',
            'providers_id' => $provider3->id,
        ]);
        
        $this->to('pizza', $pizza->id, 'App\Food_Pizza');

        $description = factory(Description_Pizza::class)->create([
            'description' => 'pimenton, cebolla, aceituna negra y champiñon',
            'providers_id' => $provider3->id,
            'pizza_id' =>  $pizza->id,
        ]);

        
        $pizza1 =  factory(Food_Pizza::class)->create([
            'name'         => 'Pizza con maiz',
            'price_bs'     => 200000,
            'price_us'     => 4,
            'type'         => 'pizza',
            'providers_id' => $provider3->id,
        ]);
        
        $this->to('pizza', $pizza1->id, 'App\Food_Pizza');

        $description = factory(Description_Pizza::class)->create([
            'description' => 'maiz dulce, tocineta y quso',
            'providers_id' => $provider3->id,
            'pizza_id' =>  $pizza1->id,
        ]);


        $drink =  factory(Drink::class)->create([
            'name'         => 'cocacola ',
            'price_bs'     => 60000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider3->id,
        ]);

        $this->to('bebidas', $drink1->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola negra',
            'providers_id' => $provider3->id,
            'drinks_id' =>  $drink->id,
        ]);

        $drink1 =  factory(Drink::class)->create([
            'name'         => 'malta ',
            'price_bs'     => 60000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider3->id,
        ]);

        $this->to('bebidas', $drink1->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola negra',
            'providers_id' => $provider3->id,
            'drinks_id' =>  $drink1->id,
        ]);

       //========== 4to proveedor=======================================

        
        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'calle 42 con carrera 24',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'J',
            'dni' => '944297860',
            'name' => 'el perro de la 42',
            'lastname' => null,
            'phone' => '02522612588',
            'email' => 'elperro@hotmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client');

        $question3 =  factory(Security::class)->create([
           'person_id' => $person->id,
            'question_1' => 'Artista preferido',
            'answers_1' => 'Antonio Banderas',
            'question_2' => 'Color preferido',
            'answers_2' => 'Negro',
            'question_3' => 'Raza de perro',
            'answers_3' => 'Rottweiler',
        ]);


        $provider4 = factory(Provider::class)->create([
            'person_id' => $person->id,
            'price_delivery' => 120000,
            'typepayment_id' =>  $typepayment->id,
        ]);

        $burguer =  factory(Food_Burguer::class)->create([
            'name'         => 'perro sencillo',
            'price_bs'     => 150000,
            'price_us'     => 1,
            'type'         => 'perro',
            'providers_id' => $provider4->id,
        ]);
        
        $this->to('comida-rapida', $burguer->id, 'App\Food_Burguer');

        $description = factory(Description_Burguer::class)->create([
            'description' => 'papita rallada o ensalda',
            'providers_id' => $provider4->id,
            'burguer_id' =>  $burguer->id,
        ]);

        $burguer1 =  factory(Food_Burguer::class)->create([
            'name'         => 'perro especial',
            'price_bs'     => 200000,
            'price_us'     => 2,
            'type'         => 'perro',
            'providers_id' => $provider4->id,
        ]);
        
        $this->to('comida-rapida', $burguer1->id, 'App\Food_Burguer');

        $description = factory(Description_Burguer::class)->create([
            'description' => 'queso, jamon, tocineta y papas naturales',
            'providers_id' => $provider4->id,
            'burguer_id' =>  $burguer1->id,
        ]);

        $burguer2 =  factory(Food_Burguer::class)->create([
            'name'         => 'perro polaco',
            'price_bs'     => 250000,
            'price_us'     => 2,
            'type'         => 'perro',
            'providers_id' => $provider4->id,
        ]);
        
        $this->to('comida-rapida', $burguer2->id, 'App\Food_Burguer');

        $description = factory(Description_Burguer::class)->create([
            'description' => 'salchicha polaca, papas naturales',
            'providers_id' => $provider4->id,
            'burguer_id' =>  $burguer2->id,
        ]);
  

        $drink =  factory(Drink::class)->create([
            'name'         => 'cocacola ',
            'price_bs'     => 50000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider4->id,
        ]);

        $this->to('bebidas', $drink1->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola negra',
            'providers_id' => $provider4->id,
            'drinks_id' =>  $drink->id,
        ]);

        $drink1 =  factory(Drink::class)->create([
            'name'         => 'kolita ',
            'price_bs'     => 50000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider4->id,
        ]);

        $this->to('bebidas', $drink1->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola roja',
            'providers_id' => $provider4->id,
            'drinks_id' =>  $drink1->id,
        ]);

        $drink2 =  factory(Drink::class)->create([
            'name'         => 'naranja ',
            'price_bs'     => 50000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider4->id,
        ]);

        $this->to('bebidas', $drink2->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola naranja',
            'providers_id' => $provider4->id,
            'drinks_id' =>  $drink2->id,
        ]);

        //========== 5to proveedor=======================================

        
        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'Barrio san jose calle 6',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'J',
            'dni' => '000123860',
            'name' => 'china town',
            'lastname' => null,
            'phone' => '02522612510',
            'email' => 'chinatown@hotmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client');

        $question4 =  factory(Security::class)->create([
            'person_id' => $person->id,
            'question_1' => 'Pais para vivir',
            'answers_1' => 'Italia',
            'question_2' => 'Nombre de ave',
            'answers_2' => 'colibri',
            'question_3' => 'Estilo de ropa',
            'answers_3' => 'Clasica',
        ]);

        $provider5 = factory(Provider::class)->create([
            'person_id' => $person->id,
            'price_delivery' => 150000,
            'typepayment_id' =>  $typepayment->id,
        ]);

        $chinese =  factory(Food_chinese::class)->create([
            'name'         => 'arroz frito',
            'price_bs'     => 150000,
            'price_us'     => 1,
            'type'         => 'arroz',
            'providers_id' => $provider5->id,
        ]);
        
        $this->to('china', $chinese->id, 'App\Food_chinese');

        $description = factory(Description_chinese::class)->create([
            'description' => 'arroz con trozos de jamon, huevo frito',
            'providers_id' => $provider5->id,
            'chinese_id' =>  $chinese->id,
        ]);

        
        $chinese1 =  factory(Food_chinese::class)->create([
            'name'         => 'shop suey',
            'price_bs'     => 120000,
            'price_us'     => 1,
            'type'         => 'ensalada',
            'providers_id' => $provider5->id,
        ]);
        
        $this->to('china', $chinese1->id, 'App\Food_chinese');

        $description = factory(Description_chinese::class)->create([
            'description' => 'ensalada de vegetales',
            'providers_id' => $provider5->id,
            'chinese_id' =>  $chinese1->id,
        ]);

        
        $chinese2 =  factory(Food_chinese::class)->create([
            'name'         => 'pollo agridulce',
            'price_bs'     => 150000,
            'price_us'     => 1,
            'type'         => 'pollo',
            'providers_id' => $provider5->id,
        ]);
        
        $this->to('china', $chinese2->id, 'App\Food_chinese');

        $description = factory(Description_chinese::class)->create([
            'description' => 'bolitas de pollo frito con salsa dulce',
            'providers_id' => $provider5->id,
            'chinese_id' =>  $chinese2->id,
        ]);

        
        $chinese3 =  factory(Food_chinese::class)->create([
            'name'         => 'lumpia',
            'price_bs'     => 150000,
            'price_us'     => 1,
            'type'         => 'lumpia',
            'providers_id' => $provider5->id,
        ]);
        
        $this->to('china', $chinese3->id, 'App\Food_chinese');

        $description = factory(Description_chinese::class)->create([
            'description' => 'rollo frito de harina con ensalada',
            'providers_id' => $provider5->id,
            'chinese_id' =>  $chinese3->id,
        ]);
  

        $drink =  factory(Drink::class)->create([
            'name'         => 'cocacola ',
            'price_bs'     => 60000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider5->id,
        ]);

        $this->to('bebidas', $drink1->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola negra',
            'providers_id' => $provider5->id,
            'drinks_id' =>  $drink->id,
        ]);

          $drink1 =  factory(Drink::class)->create([
            'name'         => 'kolita ',
            'price_bs'     => 90000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider5->id,
        ]);

        $this->to('bebidas', $drink1->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola roja',
            'providers_id' => $provider5->id,
            'drinks_id' =>  $drink1->id,
        ]);

        $drink2 =  factory(Drink::class)->create([
            'name'         => 'naranja ',
            'price_bs'     => 70000,
            'price_us'     => 0.5,
            'type_drink'   => 'gaseosa',
            'providers_id' => $provider5->id,
        ]);

        $this->to('bebidas', $drink2->id, 'App\Drink');
        
        $description = factory(Description_drink::class)->create([
            'description' => 'cola naranja',
            'providers_id' => $provider5->id,
            'drinks_id' =>  $drink2->id,
        ]);

        //============creacion de 1er cliente===========================

        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'calle 8 con carrera 20',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'V',
            'dni' => '14184032',
            'name' => 'Maria',
            'lastname' => 'Cordova',
            'phone' => '04142612523',
            'email' => 'mariacordova@hotmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client');
        
        $question5 =  factory(Security::class)->create([
            'person_id' => $person->id,
            'question_1' => 'Pais para vivir',
            'answers_1' => 'España',
            'question_2' => 'Ave que gusta',
            'answers_2' => 'Quetzal',
            'question_3' => 'Coleccion',
            'answers_3' => 'Carteras',
        ]);

        factory(Client::class)->create([
            'person_id' => $person->id,
            // 'address_id' => $address->id,
        ]);

        //============creacion de 2do cliente===========================

        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'calle 33 con venezuela',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'V',
            'dni' => '14184035',
            'name' => 'Juan',
            'lastname' => 'Perez',
            'phone' => '04142612510',
            'email' => 'juanperez@hotmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client');

        $question6 =  factory(Security::class)->create([
            'person_id' => $person->id,
            'question_1' => 'Novela',
            'answers_1' => 'Orgullo y prejuicio',
            'question_2' => 'Actriz gustaria conocer',
            'answers_2' => 'Natalie Portman',
            'question_3' => 'Mania',
            'answers_3' => 'Orden',
        ]);

        factory(Client::class)->create([
            'person_id' => $person->id,
            // 'address_id' => $address->id,
        ]);


        //============creacion de 3er cliente===========================

        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'calle 28 entre carreras 27 y 28',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'V',
            'dni' => '14184040',
            'name' => 'Elena',
            'lastname' => 'Suarez',
            'phone' => '04242612510',
            'email' => 'elenasuarez@hotmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client');

        $question7 =  factory(Security::class)->create([
            'person_id' => $person->id,
            'question_1' => 'Saga',
            'answers_1' => 'Crepusculo',
            'question_2' => 'Actor',
            'answers_2' => 'Robert Pattison',
            'question_3' => 'Clan',
            'answers_3' => 'Cullen',
        ]);

        factory(Client::class)->create([
            'person_id' => $person->id,
            // 'address_id' => $address->id,
        ]);


        //============creacion de 1er repartidor===========================

        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'calle 28 entre carreras 12 y 13',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'V',
            'dni' => '12184040',
            'name' => 'Marcos',
            'lastname' => 'Rojas',
            'phone' => '04245302523',
            'email' => 'marcosrojas@gmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client', 'courier');

        $question8 =  factory(Security::class)->create([
            'person_id' => $person->id,
            'question_1' => 'Comida',
            'answers_1' => 'China',
            'question_2' => 'Mascota',
            'answers_2' => 'Gato',
            'question_3' => 'Transporte',
            'answers_3' => 'Moto',
        ]);

        factory(Courier::class)->create([
            'person_id' => $person->id,
            'type_vehicle' => 'Moto',
            'bussiness_delivery' => $provider->id,
        ]);


        //============creacion de 2do repartidor===========================

        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'calle 27 con venezuela',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'V',
            'dni' => '12184200',
            'name' => 'Pedro',
            'lastname' => 'Puerta',
            'phone' => '04245302124',
            'email' => 'pedropuerta@gmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client', 'courier');

        $question9 =  factory(Security::class)->create([
            'person_id' => $person->id,
            'question_1' => 'Color',
            'answers_1' => 'Azul',
            'question_2' => 'Sueño',
            'answers_2' => 'Viajar a China',
            'question_3' => 'Juegos',
            'answers_3' => 'Estrategias',
        ]);

        factory(Courier::class)->create([
            'person_id' => $person->id,
            'type_vehicle' => 'Moto',
            'bussiness_delivery' => $provider4->id,
        ]);

        //============creacion de 3er repartidor===========================

        $address = factory(Address::class)->create([
            'states_id' => $state->id,
            'cities_id' => $city->id,
            'municipalities_id' => $municipality->id,
            'parishes_id' => $parishe->id,
            'address' => 'avenida 20 con calle 12',
        ]);

        $person = factory(Person::class)->create([
            'type_dni' => 'V',
            'dni' => '12154251',
            'name' => 'Carlos',
            'lastname' => 'Moreno',
            'phone' => '04242552523',
            'email' => 'carlosmoreno@gmail.com',
            'address_id' => $address->id,
        ]);

        $user = factory(User::class)->create([
            'person_id' => $person->id,
            'email' => $person->email,
        ])->assignRole('client', 'courier');

        $question10 =  factory(Security::class)->create([
            'person_id' => $person->id,
            'question_1' => 'Pelicula',
            'answers_1' => 'Rapidos y furiosos',
            'question_2' => 'Hobbie',
            'answers_2' => 'Jugar',
            'question_3' => 'Comida',
            'answers_3' => 'tradicional',
        ]);

        factory(Courier::class)->create([
            'person_id' => $person->id,
            'type_vehicle' => 'Moto',
            'bussiness_delivery' => $provider5->id,
        ]);
    }
}