<?php

namespace LACC\Http\Controllers;

use Illuminate\Http\Request;
use LACC\Http\Requests\BookRequest;
use LACC\Repositories\BookRepository;
use LACC\Services\BookService;
use LACC\Services\CategoryService;
use LACC\Services\UserService;

class bookscontroller extends Controller
{
    private $with = [ 'author', 'category' ];

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var BookService
     */
    protected $bookService;

    /**
     * @var BookRepository
     */
    protected $bookRepository;

    protected $urlDefault = 'books.index';

    public function __construct( UserService $userService, BookService $bookService, CategoryService $categoryService, BookRepository $bookRepository)
    {
        $this->userService     = $userService;
        $this->categoryService = $categoryService;
        $this->bookService     = $bookService;
        $this->bookRepository = $bookRepository;
    }

    /**
     * display a listing of the resource.
     *
     * @return \illuminate\http\response
     */
    public function index()
    {
        $books = $this->bookRepository->with( $this->with )->paginate( 15 );

        return view( 'books.index', compact( 'books' ) );
    }

    /**
     * show the form for creating a new resource.
     *
     * @return \illuminate\http\response
     */
    public function create()
    {
        $users      = $this->userService->getListUsersInSelect();
        $categories = $this->categoryService->getListCategoriesInSelect();

        return view( 'books.create', compact( 'users', 'categories' ) );
    }

    /**
     * @param BookRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        $this->bookRepository->create( $data );

        $request->session()->flash('message', ['type' => 'success','msg'=> "Book '{$data['title']}' successfully registered!"]);

        return redirect()->route( 'books.index' );
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $book = $this->bookService->verifyTheExistenceOfObject( $this->bookRepository, $id );

        return view( 'books.detail',compact( 'book' ) );
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $book       = $this->bookService->verifyTheExistenceOfObject( $this->bookRepository, $id );
        $users      = $this->userService->getListUsersInSelect();
        $categories = $this->categoryService->getListCategoriesInSelect();

        return view( 'books.edit',compact( 'book', 'users','categories' ) );
    }

    /**
     * @param BookRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Bookrequest $request, $id)
    {
        $this->bookService->verifyTheExistenceOfObject( $this->bookRepository, $id );
        $data = $request->all();

        $this->bookRepository->update( $data, $id );

        $urlTo = $this->bookService->checksTheCurrentUrl( $data['redirect_to'], $this->urlDefault );

        $request->session()->flash('message', ['type' => 'success','msg'=> "Book '{$data['title']}' successfully update!"]);

        return redirect()->to( $urlTo );
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request)
    {
        $this->bookService->verifyTheExistenceOfObject( $this->bookRepository, $id );
        $this->bookRepository->delete( $id );

        $request->session()->flash('message', ['type' => 'success','msg'=> 'Book deleted successfully!']);

        return redirect()->route( 'books.index' );
    }
}
