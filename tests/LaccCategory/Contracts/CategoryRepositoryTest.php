<?php

/**
 * File: CategoryRepositoryTest.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 17/02/17
 * Time: 00:32
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\LaccCategory\Contracst;

use LaccBook\Repositories\CategoryRepository;
use LaccBook\Repositories\CategoryRepositoryEloquent;
use Mockery as m;

class CategoryRepositoryTest extends \TestCase
{

    public function test_if_implements_repositoryInterface()
    {
        $mock = m::mock(CategoryRepositoryEloquent::class);

        $this->assertInstanceOf(CategoryRepository::class, $mock);
    }
}