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

//        //Users
//        Route::resource( '/users', 'UsersController', [ 'except' => [ 'show' ] ]  );
//        Route::get( 'users/{id}', [ 'as' => 'users.destroy', 'uses' => 'UsersController@destroy' ] );
//        Route::get( 'user-advanced-search', [ 'as' => 'advanced.users.search', 'uses' => 'UsersController@advancedSearch' ] );
//        Route::get( 'users-detail/{id}', [ 'as' => 'users.detail', 'uses' => 'UsersController@detail' ] );

} );

