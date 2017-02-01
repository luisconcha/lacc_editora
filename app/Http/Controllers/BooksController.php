<?php

namespace LACC\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LACC\Book;
use LACC\Http\Requests\BookRequest;
use LACC\User;

class BooksController extends Controller
{
    private $with = [ 'author' ];

    protected $user;

    public function __construct(  User $user )
    {
        $this->user  = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::query()->with( $this->with )->paginate(10);

        return view( 'books.index', compact( 'books' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = [ '' => '--Select an author--' ];
        $users += $this->user->orderBy( 'name', 'ASC' )->pluck( 'name','id' )->all();

        return view( 'books.create', compact( 'users' ) );
    }

    /**
     * @param BookRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookRequest $request)
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

        $users = [ '' => '--Select an author--' ];
        $users += $this->user->orderBy( 'name', 'ASC' )->pluck( 'name','id' )->all();

        return view( 'books.edit',compact( 'book', 'users' ) );
    }

    /**
     * @param BookRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookRequest $request, $id)
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
