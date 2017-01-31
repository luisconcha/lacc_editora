<?php
namespace LACC\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LACC\Category;

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
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store( Request $request )
		{
				$data = $request->all();
				Category::create( $data );

				return redirect()->route( 'categories.index' );
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show( $id )
		{

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
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  int                      $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( Request $request, $id )
		{
				if ( !( $category = Category::find( $id ) ) ) {
						throw new ModelNotFoundException( 'Category not found.' );
				}
				$data = $request->all();
				$category->fill( $data );
				$category->save();

				return redirect()->route( 'categories.index' );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( $id )
		{
				if ( !( $category = Category::find( $id ) ) ) {
						throw new ModelNotFoundException( 'Category not found.' );
				}
				$category->find( $id )->delete();

				return redirect()->route( 'categories.index' );
		}
}
