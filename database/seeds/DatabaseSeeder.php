<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Schema::disableForeignKeyConstraints();
            $this->call(RolesAndPermissionsTablesSeeders::class);
            $this->call(CityTableSeeder::class);
            $this->call(MunicipalityTableSeeder::class);
            $this->call(ParisheTableSeeder::class);
            $this->call(StateTableSeeder::class);
            $this->call(PersonTableSeeder::class);
            $this->call(ClientTableSeeder::class);
            $this->call(CourierTableSeeder::class);
            $this->call(ProviderTableSeeder::class);
            $this->call(UserTableSeeder::class);
            $this->call(TypepaymentTableSeeder::class);
            $this->call(ImageTableSeeder::class);
            $this->call(BurguerTableSeeder::class);
            $this->call(DescriptionBurguerTableSeeder::class);
            $this->call(VeganTableSeeder::class);
            $this->call(DescriptionVeganTableSeeder::class);
            $this->call(VegetarianTableSeeder::class);
            $this->call(DescriptionVegetarianTableSeeder::class);
            Schema::enableForeignKeyConstraints();
        }
}