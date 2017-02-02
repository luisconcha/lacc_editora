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
            'num_cpf'        => $faker->cpf,
            'num_rg'         => $faker->rg,
            'avatar'         => 'image.jpg',
            'civil_status'   => $faker->numberBetween( 1,5 ),
            'password'       => $password ? : $password = bcrypt( '123456' ),
            'remember_token' => str_random( 10 ),
		];
} );
//
$factory->define( LACC\State::class, function ( Faker\Generator $faker ) {
    return [
        'nom_state' => $faker->country,
        'sig_state' => $faker->citySuffix
    ];
} );
//
$factory->define( LACC\City::class, function ( Faker\Generator $faker ) {
    return [
        'state_id' => $faker->numberBetween( 1,10 ),
        'nom_city' => $faker->city
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
        'author_id'       => $faker->numberBetween( 1,10 ),
        'category_id'     => $faker->numberBetween( 1,10 ),
        'title'           => ucfirst( $faker->unique()->word ),
        'subtitle'        => $faker->text,
        'price'           => $faker->randomNumber( 4 )
    ];
} );

//
$factory->define( LACC\Address::class, function ( Faker\Generator $faker ) {

    return [
        'city_id'      => $faker->numberBetween( 1,10 ),
        'user_id'      => $faker->numberBetween( 1,10 ),
        'address'      => $faker->address,
        'district'     => $faker->citySuffix,
        'cep'          => str_random( 8 ),
        'type_address' => $faker->randomElement(array('casa','apartamento','sobrado','chacara')),
    ];
} );
//
$factory->define( LACC\TelephoneUser::class, function ( Faker\Generator $faker ) {
    return [
        'num_telephone'  => $faker->phoneNumber,
        'type_telephone' => 'celular',
        'user_id'        => $faker->numberBetween( 1,10 ),
    ];
} );

