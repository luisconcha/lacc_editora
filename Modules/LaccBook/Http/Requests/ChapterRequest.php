<?php
namespace LaccBook\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $idChapter = ( $this->route( 'chapter' ) ) ? $this->route( 'chapter' ) : null;

        return [
          'name'    => "required|max:255|unique:chapters,name, $idChapter",
          'content' => 'required',
          'order'   => 'required|integer',
        ];
    }
}
