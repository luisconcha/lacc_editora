<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer( 'city_id' )->unsigned();
            $table->foreign( 'city_id' )->references( 'id' )->on( 'city' );
            $table->integer( 'user_id' )->unsigned();
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
            $table->string('address');
            $table->string('district');
            $table->string('cep');
            $table->string('type_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'address' );
    }
}
