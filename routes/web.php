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
} );

