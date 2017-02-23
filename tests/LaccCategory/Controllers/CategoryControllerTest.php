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

//use Illuminate\Http\Request;
//use Request;
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
        $request            = m::mock(\Illuminate\Http\Request::class);

        $categoryController = new CategoriesController($categoryRepository, $categoryService);

        $categoryResult = ['cat01', 'cat02'];
		    $categoryRepository->shouldReceive('paginate')->with(15)->andReturn(['cat1', 'cat2']);

        \View::shouldReceive('views')
            ->with('laccbook::categories.index', ['categories' => $categoryResult, 'search' => 'cat1' ] )
            ->andReturn($categoryResult);

        //$this->assertEquals($categoryController->index($request));

        //$this->assertEquals($categoryController->index(Request::class)->offsetGet('get'), $categoryResult);
    }

}