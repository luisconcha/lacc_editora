<?php
namespace LaccBook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use LaccBook\Criteria\FindByAuthorCriteria;
use LaccBook\Criteria\FindByBookCriteria;
use LaccBook\Http\Requests\ChapterRequest;
use LaccBook\Models\Book;
use LaccBook\Repositories\BookRepository;
use LaccBook\Repositories\ChapterRepository;
use LaccUser\Annotations\Mapping as Permission;

/**
 * Class ChaptersController
 * @package LaccBook\Http\Controllers
 * @Permission\Controller(name="chapters-admin")
 */
class ChaptersController extends Controller
{
    /** @var ChapterRepository */
    protected $chapterRepository;

    /** @var  BookRepository */
    protected $bookRepository;

    public function __construct( ChapterRepository $chapterRepository, BookRepository $bookRepository )
    {
        $this->chapterRepository = $chapterRepository;
        $this->bookRepository    = $bookRepository;
        $this->bookRepository->pushCriteria( new FindByAuthorCriteria() );
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index( Request $request, $id )
    {
        $book   = $this->bookRepository->find( $id );
        $search = $request->get( 'search' );
        $this->chapterRepository->pushCriteria( new FindByBookCriteria( $book->id ) );
        $chapters = $this->chapterRepository->paginate( 5 );

        return view( 'laccbook::chapters.index', compact( 'chapters', 'search', 'book' ) );
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create( $id )
    {
        $book = $this->bookRepository->find( $id );

        return view( 'laccbook::chapters.create', compact( 'book' ) );
    }

    /**
     * @param ChapterRequest $request
     * @param                $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( ChapterRequest $request, $id )
    {
        $data              = $request->all();
        $data[ 'book_id' ] = $id;
        $this->chapterRepository->create( $data );
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "Chapter '{$data['name']}' successfully registered!" ] );

        return redirect()->route( 'chapters.index', [ 'book' => $id ] );

    }

    /**
     * @param Book $book
     * @param      $chapterId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( Book $book, $chapterId )
    {
        $this->chapterRepository->pushCriteria( new FindByBookCriteria( $book->id ) );
        $chapter = $this->chapterRepository->find( $chapterId );

        return view( 'laccbook::chapters.edit', compact( 'chapter', 'book' ) );
    }

    /**
     * @param Request $request
     * @param Book    $book
     * @param         $chapterId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Request $request, Book $book, $chapterId )
    {
        $this->chapterRepository->pushCriteria( new FindByBookCriteria( $book->id ) );
        $data = $request->except( [ 'book_id' ] );
        $this->chapterRepository->update( $data, $chapterId );
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "Chapter '{$data['name']}' successfully updated!" ] );

        return redirect()->route( 'chapters.index', [ 'book' => $book->id ] );
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
