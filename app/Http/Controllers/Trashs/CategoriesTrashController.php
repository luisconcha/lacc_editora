<?php
namespace LACC\Http\Controllers\Trashs;

use Illuminate\Http\Request;
use LACC\Http\Controllers\Controller;
use LACC\Repositories\CategoryRepository;

class CategoriesTrashController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    protected $urlDefault = 'categories.index';

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search     = $request->get( 'search' );
        $this->categoryRepository->onlyTrashed();
        $categories = $this->categoryRepository->paginate( 10 );

        return view( 'trashs.books.index', compact( 'categories', 'search' ) );
    }
}
