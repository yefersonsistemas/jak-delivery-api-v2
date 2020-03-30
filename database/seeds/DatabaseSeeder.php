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
            $this->call(HeadquartersTableSeeder::class);
            $this->call(BranchTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}