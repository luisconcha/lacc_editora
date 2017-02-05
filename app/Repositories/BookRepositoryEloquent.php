<?php

namespace LACC\Repositories;

use LACC\Models\Book;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class BookRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{
    protected $fieldSearchable = [
        'title'       => 'like',
        'price',
        'author.name' => 'like',
        'category.name'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
/**
 *  Exemplos de como implementar Criteria (orderBy asc é padrão):
 *
 * a) Procura pelo id do author = a 5
 *   http://editora.dev/books?search=5&searchFields=author_id:=
 *
 * b) Procura pelo titulo utilizando like (search=Re)
 *  http://editora.dev/books?search=Re&searchFields=title:like
 *
 * c) Abreviar o search e já definir como like:
 *   protected $fieldSearchable = [
 *    'title' => 'like',
 *   ];
 * d) Para procurar por algum campo no relacionamento, se coloca o nome do relacionamento
 *    (author) seguido pelo nome do campo procurado
 *   protected $fieldSearchable = [
 *       'title' => 'like',
 *       'author.name'
 *   ];
 * e) Delimitar a procura fazendo combinações
 *    http://editora.dev/books?search=title:p;author.name:Luis&searchFields=title:=;author.name:like
 *    http://editora.dev/books?search=title:p;price:9491&searchFields=title:=;price:=
 *
 * f) Ordenar a busca por coluna determinada
 *    http://editora.dev/books?orderBy=title
 *    http://editora.dev/books?orderBy=id&sortedBy=desc
 *    http://editora.dev/books?orderBy=price&sortedBy=desc
 *
 *    Ordenar utilizando coluna com chave estrangeira
 *    http://editora.dev/books?orderBy=users:author_id|name&sortedBy=desc
 *
 * g) Filtrar o retorno da consulta com colunas determinadas; lembrando que se tem coluna relacionada
 *    o campo tem que ser ternonado caso ela esteja sendo renderizada na view
 *
 *    http://editora.dev/books?filter=title;author_id;category_id
 */
