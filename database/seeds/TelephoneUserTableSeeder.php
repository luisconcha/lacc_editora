<?php

use Illuminate\Database\Seeder;

class TelephoneUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( LACC\Models\TelephoneUser::class, 10 )->create();
    }
}
