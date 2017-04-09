<?php
/**
 * File: BookService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 04/02/17
 * Time: 17:16
 * Project: lacc_editora
 * Copyright: 2017
 */
namespace LaccBook\Services;

use LaccBook\Repositories\ChapterRepository;

class ChaptersService extends BaseService
{
    /**
     * @var \LaccBook\Repositories\ChapterRepository
     */
    private $chaptersRepository;

    public function __construct( ChapterRepository $chapterRepository )
    {
        $this->chaptersRepository = $chapterRepository;
    }

    public function verifyTheExistenceOfTheABook( $id )
    {
        if ( !( $book = $this->chaptersRepository->find( $id ) ) ) {
            throw new modelnotfoundexception( 'Chapters not found' );
        }

        return $book;
    }
}