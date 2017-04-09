<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'chapters', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name' );
            $table->text( 'content' );
            $table->integer( 'order' )->default( 1 );
            $table->integer( 'book_id' )->unsigned();
            $table->foreign( 'book_id' )->references( 'id' )->on( 'books' );
            $table->timestamps();
            $table->softDeletes();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'chapters' );
    }
}
