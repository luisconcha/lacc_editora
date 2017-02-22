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
use Request;
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

//    public function test_controller_should_run_index_method()
//    {
//        $category           = m::mock(Category::class);
//        $categoryRepository = m::mock(CategoryRepository::class);
//        $categoryService    = m::mock(CategoryService::class);
//        $html               = m::mock();
//        $request            = m::mock(Request::class);
//
//        $ccategoryController = new CategoriesController($categoryRepository, $categoryService);
//
//        $categoryResult = ['cat01', 'cat02'];
//        $category->shouldReceive('index')->andReturn($categoryResult);
//
//        \View::shouldReceive('views')
//            ->with('laccbook::categories.index', ['categories' => $categoryResult, 'search' => '' ] )
//            ->andReturn($html);
//
//        $this->assertEquals($ccategoryController->index($request->get('search')), $html);
//
////        $this->assertEquals($ccategoryController->index($request)->offsetGet('get'), $html);
//    }
    public function test_controller_should_run_index_method()
    {
        $category           = m::mock(Category::class);
        $categoryRepository = m::mock(CategoryRepository::class);
        $categoryService    = m::mock(CategoryService::class);
        $html               = 'cat1';
//        $request            = m::mock(Request::class);

        $categoryController = new CategoriesController($categoryRepository, $categoryService);

        $categoryResult = ['cat01', 'cat02'];
        $categoryController->shouldReceive('paginate')->with(15)->andReturn(['cat1', 'cat2']);

        \View::shouldReceive('views')
            ->with('laccbook::categories.index', ['categories' => $categoryResult, 'search' => 'cat1' ] )
            ->andReturn($html);

//        $this->assertEquals($categoryController->index(Request::class));

        $this->assertEquals($categoryController->index(Request::class)->offsetGet('get'), $html);
    }
}