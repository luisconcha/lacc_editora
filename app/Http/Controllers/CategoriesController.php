<?php
namespace LACC\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LACC\Models\Category;
use LACC\Http\Requests\CategoryRequest;
use LACC\Repositories\CategoryRepository;
use LACC\Services\CategoryService;

class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var CategoryService
     */
    protected $categoryService;

    protected $urlDefault = 'categories.index';

    private $with = [];

    public function __construct(CategoryRepository $categoryRepository, CategoryService $categoryService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryService    = $categoryService;
    }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
		public function index()
		{
            $categories = $this->categoryRepository->paginate( 15 );

			return view( 'categories.index', compact( 'categories' ) );
		}

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
		public function create()
		{
				return view( 'categories.create' );
		}

        /**
         * @param CategoryRequest $request
         * @return \Illuminate\Http\RedirectResponse
         */
		public function store( CategoryRequest $request )
		{
				$data = $request->all();
                $this->categoryRepository->create( $data );

                $request->session()->flash('message', ['type' => 'success','msg'=> "Category '{$data['name']}' successfully registered!"]);

                return redirect()->route( 'categories.index' );
		}

        /**
         * @param $id
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
		public function edit( $id )
		{
                $category = $this->categoryService->verifyTheExistenceOfObject($this->categoryRepository, $id, $this->with);

				return view( 'categories.edit', compact( 'category' ) );
		}

        /**
         * @param CategoryRequest $request
         * @param $id
         * @return \Illuminate\Http\RedirectResponse
         */
		public function update( CategoryRequest $request, $id )
		{
                $this->categoryService->verifyTheExistenceOfObject($this->categoryRepository, $id, $this->with);
				$data     = $request->all();
                $this->categoryRepository->update( $data, $id );

                $urlTo = $this->categoryService->checksTheCurrentUrl( $data['redirect_to'], $this->urlDefault );
                $request->session()->flash('message', ['type' => 'success','msg'=> "Category '{$data['name']}' successfully updated!"]);

				return redirect()->to( $urlTo );
		}

        /**
         * @param $id
         * @param Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
		public function destroy( $id, Request $request )
		{
                $this->categoryService->verifyTheExistenceOfObject($this->categoryRepository, $id, $this->with);
				$this->categoryRepository->delete( $id );

                $request->session()->flash('message', ['type' => 'success','msg'=> 'Category deleted successfully!']);

                return redirect()->route( 'categories.index' );
		}
}
