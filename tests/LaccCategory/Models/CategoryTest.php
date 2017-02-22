<?php

/**
 * File: CategoryTest.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 16/02/17
 * Time: 23:10
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\LaccCategory\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use LaccBook\Models\Category;
use LaccUser\Models\User;
use Mockery as m;

class CategoryTest extends \TestCase
{
    use DatabaseTransactions;

    public function test_check_if_a_category_can_be_persisted()
    {
        $category = Category::create(['name' => 'Category 02']);
        $this->assertEquals('Category 02', $category->name);
    }

    public function test_check_if_a_category_can_be_persisted_and_view_data()
    {
        //Set the currently logged in user for the application.
        $this->actingAs($this->getUser())
            ->visit('/categories/create')
            ->type('New Category Test', 'name')
            ->press('Save')
            ->seePageIs('/categories')
            ->see('New Category Test');
    }

    /**
     * Cria em memoria um objeto de usuario
     * @return mixed
     */
    protected function getUser()
    {
        return factory(User::class)->create();
    }

}