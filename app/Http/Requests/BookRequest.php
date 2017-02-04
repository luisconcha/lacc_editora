<?php

namespace LACC\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LACC\Models\Book;
use LACC\Repositories\BookRepository;
use LACC\Repositories\UserRepository;

class BookRequest extends FormRequest
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
         $this->bookRepository = $bookRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $idUser = \Auth::user()->id;
        $idBook = (int) $this->route('book');
        $book   = $this->bookRepository->findWhere([
            'id'        => $idBook,
            'author_id' => $idUser
        ]);


        //$idBook == 0 NOVO REGISTRO
        if( count($book) > 0 || $idBook == 0)
            return true;

        return false;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $idBook = ($this->route('book')) ? $this->route('book') : null;

        return [
            'title'    => "required|max:200|unique:books,title,$idBook",
            'subtitle' => 'required|max:250',
            'price'    => 'required|numeric|regex:/^\d*(\.\d{2})?$/'
        ];
    }
}
