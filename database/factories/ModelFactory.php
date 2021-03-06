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
$factory->define( \LaccUser\Models\User::class, function ( Faker\Generator $faker ) {
    static $password;

    return [
      'name'           => $faker->name,
      'email'          => $faker->unique()->safeEmail,
      'num_cpf'        => $faker->cpf,
      'num_rg'         => $faker->rg,
      'avatar'         => 'image.jpg',
      'civil_status'   => $faker->numberBetween( 1, 5 ),
      'password'       => $password ? : $password = bcrypt( '123456' ),
      'remember_token' => str_random( 10 ),
      'verified'       => true,
    ];
} );
//
$factory->state( \LaccUser\Models\User::class, 'author', function ( $faker ) {
    return [
      'name'  => 'Author',
      'email' => 'author@editora.com',
    ];
} );
//
$factory->define( \LACC\Models\State::class, function ( Faker\Generator $faker ) {
    return [
      'nom_state' => $faker->country,
      'sig_state' => $faker->citySuffix,
    ];
} );
//
$factory->define( \LACC\Models\City::class, function ( Faker\Generator $faker ) {
    $stateRepo = app( \LACC\Repositories\StateRepository::class );
    $stateId   = $stateRepo->all()->random()->id;

    return [
      'state_id' => $stateId,
      'nom_city' => $faker->city,
    ];
} );
//
$factory->define( \LaccBook\Models\Category::class, function ( Faker\Generator $faker ) {
    return [
      'name' => ucfirst( $faker->unique()->word ),
    ];
} );
//
$factory->define( \LaccBook\Models\Book::class, function ( Faker\Generator $faker ) {
    $userRepo           = app( \LaccUser\Repositories\UserRepository::class );
    $authorId           = $userRepo->all()->random()->id;
    $arrPercentComplete = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );
    $published          = array( 0, 1 );

    return [
      'author_id'        => $authorId,
      'title'            => ucfirst( $faker->unique()->word ),
      'subtitle'         => $faker->text,
      'price'            => $faker->randomNumber( 4 ),
      'dedication'       => $faker->paragraphs( 5, true ),
      'description'      => $faker->paragraphs( 10, true ),
      'website'          => $faker->url,
      'percent_complete' => $faker->randomKey( $arrPercentComplete ),
      'published'        => $faker->randomKey( $published ),
    ];
} );
//
$factory->define( \LACC\Models\Address::class, function ( Faker\Generator $faker ) {
    return [
      'city_id'      => $faker->numberBetween( 1, 10 ),
      'user_id'      => $faker->unique()->numberBetween( 1, 10 ),
      'address'      => $faker->address,
      'district'     => $faker->citySuffix,
      'cep'          => str_random( 8 ),
      'type_address' => $faker->numberBetween( 1, 5 ),
    ];
} );
//
$factory->define( LACC\Models\TelephoneUser::class, function ( Faker\Generator $faker ) {
    $userRepo = app( \LaccUser\Repositories\UserRepository::class );
    $userId   = $userRepo->all()->random()->id;

    return [
      'num_telephone'  => $faker->phoneNumber,
      'type_telephone' => 'celular',
      'user_id'        => $userId,
    ];
} );
//
$factory->define( \LaccBook\Models\Chapter::class, function ( Faker\Generator $faker ) {
    $arrOrder = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );

    return [
      'name'    => $faker->name,
      'content' => $faker->paragraphs( 10, true ),
      'order'   => $faker->randomKey( $arrOrder ),
    ];
} );

