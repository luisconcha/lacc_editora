<?php
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
				factory( 'LACC\User' )->create(
					[
						'name'           => 'Luis Alberto Concha Curay',
						'email'          => 'luvett11@gmail.com',
						'password'       => bcrypt( '123456' ),
						'remember_token' => str_random( 10 ),
					]
				);
				factory( 'LACC\User' )->create(
					[
						'name'           => 'Admin',
						'email'          => 'admin@editora.com',
						'password'       => bcrypt( '123456' ),
						'remember_token' => str_random( 10 ),
					]
				);
				factory( 'LACC\User' )->create(
					[
						'name'           => 'User',
						'email'          => 'user@editora.com',
						'password'       => bcrypt( '123456' ),
						'remember_token' => str_random( 10 ),
					]
				);
				factory( LACC\User::class, 5 )->create();
		}
}
