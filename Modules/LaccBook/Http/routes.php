<?php

Route::group( [ 'middleware' => [ 'auth', config( 'laccuser.middleware.isVerified' ) ] ], function() {

    Route::group( [ 'prefix' => 'admin', 'middleware' => 'auth.resource' ], function() {
        //Categories
        Route::resource( '/categories', 'CategoriesController', [ 'except' => [ 'show' ] ] );
        Route::get( 'categories/{id}', [ 'as' => 'categories.destroy', 'uses' => 'CategoriesController@destroy' ] );

        //Chaters (add antes da rotas de resource books)
        Route::group( [ 'prefix' => '/books/{book}' ], function() {
            //Cover
            Route::get( 'cover', [ 'as' => 'books.cover.create', 'uses' => 'BooksController@coverForm' ] );
            Route::post( 'cover', [ 'as' => 'books.cover.store', 'uses' => 'BooksController@coverStore' ] );
            //Exports
            Route::post( 'export', [ 'as' => 'books.export', 'uses' => 'BooksController@export' ] );
            //Chapters
            Route::get( 'chapters/{id}', [ 'as' => 'chapters.destroy', 'uses' => 'ChaptersController@destroy' ] );
            Route::get( 'chapters-detail/{id}', [ 'as' => 'chapters.detail', 'uses' => 'ChaptersController@detail' ] );
            Route::resource( 'chapters', 'ChaptersController', [ 'except' => 'show' ] );
        } );

        //Books
        Route::resource( '/books', 'BooksController', [ 'except' => [ 'show' ] ] );
        Route::get( 'books/{id}', [ 'as' => 'books.destroy', 'uses' => 'BooksController@destroy' ] );
        Route::get( 'books-detail/{id}', [ 'as' => 'books.detail', 'uses' => 'BooksController@detail' ] );

        //Trashed
        Route::group( [ 'prefix' => 'trashed', 'as' => 'trashed.' ], function() {
            Route::resource( 'categories', 'Trashs\CategoriesTrashController',
                [ 'except' => [ 'show', 'create', 'store', 'edit', 'update', 'destroy' ] ] );
            Route::get( 'categories/{id}', [ 'as'   => 'categories.restore',
                                             'uses' => 'Trashs\CategoriesTrashController@update' ] );

            Route::resource( 'books', 'Trashs\BooksTrashController',
                [ 'except' => [ 'show', 'create', 'store', 'edit', 'update', 'destroy' ] ] );
            Route::get( 'books/{id}', [ 'as' => 'books.restore', 'uses' => 'Trashs\BooksTrashController@update' ] );
        } );
    } );
} );