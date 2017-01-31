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
		Route::resource( '/categories', 'CategoriesController', [ 'except' => [ 'show' ] ] );
		Route::get( 'categories/{id}', [ 'as' => 'categories.destroy', 'uses' => 'CategoriesController@destroy' ] );
} );

