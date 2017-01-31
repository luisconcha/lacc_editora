<?php

namespace LACC\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LACC\Book;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::query()->paginate(10);

        return view( 'books.index', compact( 'books' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'books.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Book::create($data);

        return redirect()->route( 'books.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        if( !( $book = Book::find( $id ) ) ){
            throw new ModelNotFoundException( 'Book not found' );
        }

        return view( 'books.detail',compact( 'book' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( !( $book = Book::find( $id ) ) ){
            throw new ModelNotFoundException( 'Book not found' );
        }

        return view( 'books.edit',compact( 'book' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if( !( $book = Book::find( $id ) ) ){
            throw new ModelNotFoundException( 'Book not found' );
        }

        $data = $request->all();
        $book->fill( $data );
        $book->save();
        return redirect()->route( 'books.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( !( $book = Book::find( $id ) ) ) {
            throw new ModelNotFoundException( 'Book not found.' );
        }
        $book->find( $id )->delete();

        return redirect()->route( 'books.index' );
    }
}
