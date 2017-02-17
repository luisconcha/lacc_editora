<?php

/**
 * File: CategoryControllerTest.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 17/02/17
 * Time: 00:32
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\LaccCategory\Controllers;

use Illuminate\Http\Request;
use LaccBook\Http\Controllers\CategoriesController;

use LaccBook\Http\Controllers\Controller;
use LaccBook\Models\Category;
use LaccBook\Repositories\CategoryRepository;
use LaccBook\Services\CategoryService;
use Mockery as m;

class CategoryControllerTest extends \TestCase
{
    public function test_should_extends_from_controller()
    {
        $categoryRepository = m::mock(CategoryRepository::class);
        $categoryService    = m::mock(CategoryService::class);

        $controller = new CategoriesController($categoryRepository, $categoryService);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_run_index_method()
    {
        $category           = m::mock(Category::class);
        $categoryRepository = m::mock(CategoryRepository::class);
        $categoryService    = m::mock(CategoryService::class);
        $html               = m::mock();
        $request            = m::mock(Request::class);

        $controller = new CategoriesController($categoryRepository, $categoryService);

        $categoryResult = ['cat01', 'cat02'];
        $category->shouldReceive('all')->andReturn($categoryResult);


        \View::shouldReceive('view')
            ->with('laccbook::categories.index', ['categories' => $categoryResult, 'search' => '' ] )
            ->andReturn($html);

        $this->assertEquals($controller->index($request), $html);
    }
}