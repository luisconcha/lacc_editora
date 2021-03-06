<?php
namespace LaccBook\Http\Controllers;

use Illuminate\Http\Request;
use LaccBook\Http\Requests\CategoryRequest;
use LaccBook\Repositories\CategoryRepository;
use LaccBook\Services\CategoryService;
use LaccUser\Annotations\Mapping as Permission;

/**
 * Class CategoriesController
 * @package LaccBook\Http\Controllers
 * @Permission\Controller(name="categories-admin", description="Category administration")
 */
class CategoriesController extends Controller
{
    /**
     * @var \LaccBook\Repositories\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var CategoryService
     */
    protected $categoryService;

    protected $urlDefault = 'laccbook::categories.index';

    private $with = [];

    public function __construct( CategoryRepository $categoryRepository, CategoryService $categoryService )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryService    = $categoryService;
    }

    /**
     * @param Request $request
     * @Permission\Action(name="list-categories", description="View categories list")
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Request $request )
    {
        $search     = $request->get( 'search' );
        $categories = $this->categoryRepository->paginate( 15 );

        return view( 'laccbook::categories.index', compact( 'categories', 'search' ) );
    }

    /**
     * @Permission\Action(name="store-categories", description="Store categories")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view( 'laccbook::categories.create' );
    }

    /**
     * @param CategoryRequest $request
     * @Permission\Action(name="store-categories", description="Store categories")
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( CategoryRequest $request )
    {
        $data = $request->all();
        $this->categoryRepository->create( $data );
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "Category '{$data['name']}' successfully registered!" ] );

        return redirect()->route( 'categories.index' );
    }

    /**
     * @param $id
     * @Permission\Action(name="update-categories", description="Update categories")
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( $id )
    {
        $category = $this->categoryService->verifyTheExistenceOfObject( $this->categoryRepository, $id, $this->with );

        return view( 'laccbook::categories.edit', compact( 'category' ) );
    }

    /**
     * @param CategoryRequest $request
     * @param                 $id
     * @Permission\Action(name="update-categories", description="Update categories")
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( CategoryRequest $request, $id )
    {
        $this->categoryService->verifyTheExistenceOfObject( $this->categoryRepository, $id, $this->with );
        $data = $request->all();
        $this->categoryRepository->update( $data, $id );
        $urlTo = $this->categoryService->checksTheCurrentUrl( $data[ 'redirect_to' ], $this->urlDefault );
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "Category '{$data['name']}' successfully updated!" ] );

        return redirect()->to( $urlTo );
    }

    /**
     * @param         $id
     * @param Request $request
     * @Permission\Action(name="destroy-category", description="Destroy category data")
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( $id, Request $request )
    {
        $this->categoryService->verifyTheExistenceOfObject( $this->categoryRepository, $id, $this->with );
        $this->categoryRepository->delete( $id );
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => 'The category has been successfully trashed!' ] );

        return redirect()->route( 'categories.index' );
    }
}
