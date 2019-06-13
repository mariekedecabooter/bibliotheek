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
        $this->call(RolesTableSeeder::class);
        $this->call(AddressesTableSeeder::class);

        $this->call(UsersTableSeeder::class);

        $this->call(AuthorsTableSeeder::class);
        $this->call(RecordsTableSeeder::class);
        $this->call(RentalsTableSeeder::class);


    }
}
