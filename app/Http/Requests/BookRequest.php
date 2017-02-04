<?php

namespace LACC\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LACC\Models\Book;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $idUser   = \Auth::user()->id;
        $idBook   = $this->route('book');
        $isAuthor = Book::where('id', $idBook)->where('author_id',$idUser)->exists();

        //count($idBook) == 0 NOVO REGISTRO
        if( $isAuthor || count($idBook) == 0)
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
            'price'    => 'required|regex:/^\d*(\.\d{2})?$/'
        ];
    }
}
