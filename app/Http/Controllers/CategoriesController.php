<?php
namespace LACC\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LACC\Category;
use LACC\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{

    /**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
				$categories = Category::query()->paginate( 10 );

				return view( 'categories.index', compact( 'categories' ) );
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
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
				Category::create( $data );

                $request->session()->flash('message', ['type' => 'success','msg'=> "Category '{$data['name']}' successfully registered!"]);

                return redirect()->route( 'categories.index' );
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit( $id )
		{
				if ( !( $category = Category::find( $id ) ) ) {
						throw new ModelNotFoundException( 'Category not found.' );
				}

				return view( 'categories.edit', compact( 'category' ) );
		}

        /**
         * @param CategoryRequest $request
         * @param $id
         * @return \Illuminate\Http\RedirectResponse
         */
		public function update( CategoryRequest $request, $id )
		{
				if ( !( $category = Category::find( $id ) ) ) {
						throw new ModelNotFoundException( 'Category not found.' );
				}
				$data = $request->all();

				$category->fill( $data );
				$category->save();

                $urlTo = $this->checksTheCurrentUrl( $data['redirect_to'] );
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
				if ( !( $category = Category::find( $id ) ) ) {
						throw new ModelNotFoundException( 'Category not found.' );
				}

				$category->find( $id )->delete();

                $request->session()->flash('message', ['type' => 'success','msg'=> 'Category deleted successfully!']);

                return redirect()->route( 'categories.index' );
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
