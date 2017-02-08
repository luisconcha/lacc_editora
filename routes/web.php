<?php
Route::get( '/', function () {
		return view( 'welcome' );
} );
//
Auth::routes();
//
Route::get( '/home', 'HomeController@index' );
//
Route::group( [ 'middleware' => 'auth' ], function () {
        //Categories
		Route::resource( '/categories', 'CategoriesController', [ 'except' => [ 'show' ] ] );
		Route::get( 'categories/{id}', [ 'as' => 'categories.destroy', 'uses' => 'CategoriesController@destroy' ] );

        //Books
        Route::resource( '/books', 'BooksController', [ 'except' => [ 'show' ] ]  );
        Route::get( 'books/{id}', [ 'as' => 'books.destroy', 'uses' => 'BooksController@destroy' ] );
        Route::get( 'books-detail/{id}', [ 'as' => 'books.detail', 'uses' => 'BooksController@detail' ] );

        //Users
        Route::resource( '/users', 'UsersController', [ 'except' => [ 'show' ] ]  );
        Route::get( 'users/{id}', [ 'as' => 'users.destroy', 'uses' => 'UsersController@destroy' ] );
        Route::get( 'user-advanced-search', [ 'as' => 'advanced.users.search', 'uses' => 'UsersController@advancedSearch' ] );
        Route::get( 'users-detail/{id}', [ 'as' => 'users.detail', 'uses' => 'UsersController@detail' ] );

        Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function (){
            Route::resource( 'books', 'Trashs\CategoriesTrashController',
                [ 'except' => [ 'show','create', 'store','edit', 'update', 'destroy' ] ]  );

            Route::get( 'books/{id}', [ 'as' => 'restore', 'uses' => 'Trashs\CategoriesTrashController@update' ] );
        });
} );

