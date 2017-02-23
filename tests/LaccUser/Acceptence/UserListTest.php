<?php
/**
 * File: UserListTest.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 16/02/17
 * Time: 21:00
 * Project: lacc_editora
 * Copyright: 2017
 */
namespace LACC\LaccUser\Acceptence;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use LaccUser\Models\User;

class UserListTest extends \TestCase
{
		use DatabaseTransactions;

		public function test_can_visit_admin_user_page()
		{
				$this->actingAs( $this->getUser() )
					->visit( '/admin/users' )->see( 'List of users' );
		}

		public function test_users_listing()
		{
				$this->actingAs( $this->getUser() )
					->visit( '/admin/users' )
					->see( 'Luis Alberto' )
					->see( 'Edit' )
					->see( 'Delete' )
					->see( 'Detail' );
		}

    public function test_click_button_new_user()
    {
		    $this->actingAs( $this->getUser() )
	          ->visit('/admin/users')
            ->click('New user')
            ->seePageIs('/admin/users/create')
            ->see('New User');
    }

		public function test_create_new_user()
		{
				//Set the currently logged in user for the application.
				$this->actingAs( $this->getUser() )
					->visit( '/admin/users/create' )
					->type( 'Maria Pepa', 'name' )
					->type( 'pepa@gmail.com', 'email' )
					->type( 'RG-34567', 'num_rg' )
					->type( '22211122211', 'num_cpf' )
					->type( '2', 'civil_status' )
					->type( '2', 'city_id' )
					->type( '2', 'type_address' )
					->press( 'Save' )
					->seePageIs( '/admin/users' )
					->see( 'Maria Pepa' );
		}

		/**
		 * Cria em memoria um objeto de usuario
		 * @return mixed
		 */
		protected function getUser()
		{
				return factory( User::class )->create();
		}

		public function test_when_an_action_button_is_missing_from_the_listing()
		{
				$this->actingAs( $this->getUser() )
					->visit( '/admin/users' )
					->see( 'New user' );
		}
}