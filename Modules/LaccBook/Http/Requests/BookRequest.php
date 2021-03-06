<?php
namespace LaccBook\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LaccBook\Models\Book;
use LaccBook\Repositories\BookRepository;
use LaccUser\Repositories\UserRepository;

class BookRequest extends FormRequest
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct( BookRepository $bookRepository )
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
        $idBook = (int)$this->route( 'book' );
        //$idBook == 0 NOVO REGISTRO
        if ( $idBook == 0 ) {
            return true;
        }
        $book = $this->bookRepository->find( $idBook );
        $user = \Auth::user();

        //Autorização baseada em modelo, seed BookPolice funciton update (ability)
        return $user->can( 'update', $book );

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $idBook = ( $this->route( 'book' ) ) ? $this->route( 'book' ) : null;

        return [
          'title'            => "required|max:200|unique:books,title,$idBook",
          'subtitle'         => 'required|max:250',
          'dedication'       => 'required',
          'description'      => 'required',
          'website'          => 'required|max:255|url',
          'percent_complete' => 'required|integer|min:0',
          'author_id'        => 'required',
          'price'            => 'required|numeric|regex:/^\d*(\.\d{2})?$/',
          'categories.*'     => 'exists:categories,id',
          'categories'       => 'required|array',
        ];
    }

    /**
     * Função para personalizar a mensagem de retorno quando o valor do campo Category (multiselect)
     * não existir no BD, o retorno mostrara a mensagem quantas vezes precisar, ou seja, caso o usuário
     * mudar o valor do ID pelo DOM e submeter o form, será verificado a existencia do campo.
     * @see /path/resources/lang/pt-BR/validation.php - Custom Validation Attributes: 'categories_*' => 'categoria :num',
     * @return array
     */
    public function messages()
    {
        $result     = [];
        $categories = $this->get( 'categories', [] );
        $count      = count( $categories );
        if ( is_array( $categories ) && $count > 0 ) {
            foreach ( range( 0, $count - 1 ) as $value ) {
                $field                                = \Lang::get( 'validation.attributes.categories_*', [
                  'num' => $value + 1,
                ] );
                $message                              = \Lang::get( 'validation.exists', [
                  'attribute' => $field,
                ] );
                $result[ "categories.$value.exists" ] = $message;
            }
        }

        return $result;
    }
}
