<?php

namespace LACC\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LACC\Book;
use LACC\Models\Category;
use LACC\Http\Requests\BookRequest;
use LACC\User;

class bookscontroller extends Controller
{
    private $with = [ 'author', 'category' ];

    /**
     * @var user
     */
    protected $user;

    /**
     * @var category
     */
    protected $category;

    public function __construct(  user $user, category $category )
    {
        $this->user     = $user;
        $this->category = $category;
    }

    /**
     * display a listing of the resource.
     *
     * @return \illuminate\http\response
     */
    public function index()
    {
        $books = book::query()->with( $this->with )->paginate(10);

        return view( 'books.index', compact( 'books' ) );
    }

    /**
     * show the form for creating a new resource.
     *
     * @return \illuminate\http\response
     */
    public function create()
    {
        $users      = $this->getlistusers();
        $categories = $this->getlistcategories();

        return view( 'books.create', compact( 'users', 'categories' ) );
    }

    /**
     * @param bookrequest $request
     * @return \illuminate\http\redirectresponse
     */
    public function store(bookrequest $request)
    {
        $data = $request->all();
        book::create($data);

        $request->session()->flash('message', ['type' => 'success','msg'=> "Book '{$data['title']}' successfully registered!"]);

        return redirect()->route( 'books.index' );
    }

    /**
     * display the specified resource.
     *
     * @param  int $id
     * @return \illuminate\http\response
     */
    public function detail($id)
    {
        if( !( $book = book::find( $id ) ) ){
            throw new modelnotfoundexception( 'book not found' );
        }

        return view( 'books.detail',compact( 'book' ) );
    }

    /**
     * show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \illuminate\http\response
     */
    public function edit($id)
    {
        if( !( $book = book::find( $id ) ) ){
            throw new modelnotfoundexception( 'book not found' );
        }

        $users      = $this->getlistusers();
        $categories = $this->getlistcategories();

        return view( 'books.edit',compact( 'book', 'users','categories' ) );
    }

    /**
     * @param bookrequest $request
     * @param $id
     * @return \illuminate\http\redirectresponse
     */
    public function update(bookrequest $request, $id)
    {
        if( !( $book = book::find( $id ) ) ){
            throw new modelnotfoundexception( 'book not found' );
        }

        $data = $request->all();
        $book->fill( $data );
        $book->save();

        $urlTo = $this->checksTheCurrentUrl( $data['redirect_to'] );
        $request->session()->flash('message', ['type' => 'success','msg'=> "Book '{$data['title']}' successfully updated!"]);

        return redirect()->to( $urlTo );
    }

    /**
     * remove the specified resource from storage.
     *
     * @param  int $id
     * @return \illuminate\http\response
     */
    public function destroy($id, Request $request)
    {
        if ( !( $book = book::find( $id ) ) ) {
            throw new modelnotfoundexception( 'book not found.' );
        }

        $book->find( $id )->delete();

        $request->session()->flash('message', ['type' => 'success','msg'=> 'Book deleted successfully!']);

        return redirect()->route( 'books.index' );
    }

    private function getlistcategories()
    {
        $categories = [ '' => '--select an category--' ];
        $categories += $this->category->orderby( 'name', 'asc' )->pluck( 'name','id' )->all();

        return $categories;
    }
    private function getlistusers()
    {
        $users = [ '' => '--select an author--' ];
        $users += $this->user->orderby( 'name', 'asc' )->pluck( 'name','id' )->all();

        return $users;
    }

    /**
     * @param $currentUrl
     * @return string
     */
    public function checksTheCurrentUrl( $currentUrl )
    {
        $urlTo = ( $currentUrl ) ? $currentUrl : route('categories.index');

        return $urlTo;
    }
}
