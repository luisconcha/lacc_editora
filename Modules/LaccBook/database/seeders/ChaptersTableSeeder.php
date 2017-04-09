<?php
namespace LaccBook\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use LaccBook\Models\Book;
use LaccBook\Models\Chapter;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $books = Book::all();
        foreach ( $books as $book ):
            factory( Chapter::class, 10 )->make()->each( function ( $chapter ) use ( $book ) {
                $chapter->book_id = $book->id;
                $chapter->save();
            } );
        endforeach;
    }
}
