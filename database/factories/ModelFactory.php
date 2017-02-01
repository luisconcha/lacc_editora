<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define( LACC\User::class, function ( Faker\Generator $faker ) {
		static $password;

		return [
			'name'           => $faker->name,
			'email'          => $faker->unique()->safeEmail,
			'password'       => $password ? : $password = bcrypt( '123456' ),
			'remember_token' => str_random( 10 ),
		];
} );
//
$factory->define( LACC\Category::class, function ( Faker\Generator $faker ) {
		return [
			'name' => ucfirst( $faker->unique()->word ),
		];
} );
//
$factory->define( LACC\Book::class, function ( Faker\Generator $faker ) {
    return [
        'author_id' => $faker->numberBetween( 1,10 ),
        'title'     => ucfirst( $faker->unique()->word ),
        'subtitle'  => $faker->text,
        'price'     => $faker->randomNumber(4)
    ];
} );

