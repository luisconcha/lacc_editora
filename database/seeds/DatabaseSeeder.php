<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();
        $this->call(StateTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TelephoneUserTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        //Model::reguard();
    }
}
