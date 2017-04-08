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
				factory( 'LaccUser\Models\User' )->create(
					[
						'name'           => 'Luis Alberto Concha Curay',
						'email'          => 'luvett11@gmail.com',
						'password'       => bcrypt( '123456' ),
						'remember_token' => str_random( 10 ),
					]
				);
				factory( 'LaccUser\Models\User' )->create(
					[
						'name'           => 'Admin',
						'email'          => 'admin@editora.com',
						'password'       => bcrypt( '123456' ),
						'remember_token' => str_random( 10 ),
					]
				);
				factory( 'LaccUser\Models\User' )->create(
					[
						'name'           => 'User',
						'email'          => 'user@editora.com',
						'password'       => bcrypt( '123456' ),
						'remember_token' => str_random( 10 ),
					]
				);
        /*
         * Cria usuário author baseado no state do model factory
         */
        $author     = factory( \LaccUser\Models\User::class, 1 )->states( 'author' )->create();
        $roleAuthor = \LaccUser\Models\Role::where( 'name', config( 'laccbook.acl.role_author' ) )->first();
        $author->roles()->attach( $roleAuthor->id );
        
				factory( \LaccUser\Models\User::class, 10 )->create();
		}
}
