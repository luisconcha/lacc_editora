<?php
/**
 * File: BookExport.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 23/04/17
 * Time: 18:14
 * Project: lacc_editora
 * Copyright: 2017
 */


namespace LaccBook\Pub;


use LaccBook\Util\ExtendedZip;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;
use LaccBook\Criteria\FindByBookCriteria;
use LaccBook\Criteria\OrderByOrderCriteria;
use LaccBook\Models\Book;
use LaccBook\Repositories\ChapterRepository;

class BookExport
{

    /** @var  ChapterRepository */
    private $chapterRepository;

    /** @var  Parser */
    private $ymlParser;

    /** @var  Dumper */
    private $ymlDumper;

    /**
     * BookExport constructor.
     * @param ChapterRepository $chapterRepository
     * @param Parser $ymlParser
     * @param Dumper $ymlDumper
     */
    public function __construct( ChapterRepository $chapterRepository, Parser $ymlParser, Dumper $ymlDumper )
    {
        $this->chapterRepository = $chapterRepository;
        $this->ymlParser = $ymlParser;
        $this->ymlDumper = $ymlDumper;
    }

    public function export( Book $book )
    {
        $chapters = $this->chapterRepository->pushCriteria( new FindByBookCriteria( $book->id ) )
                                            ->pushCriteria( new OrderByOrderCriteria() )
                                            ->all();

        $this->exportContents( $book, $chapters );
        file_put_contents( "{$book->contents_storage}/dedication.md", $book->dedication );

        $configContents = file_get_contents( "{$book->template_config_file}" );
        $config = $this->ymlParser->parse( $configContents );
        $config[ 'book' ][ 'title' ] = $book->title;
        $config[ 'book' ][ 'author' ] = $book->author->name;

        $contents = [];
        foreach( $chapters as $chapter ):
            $contents[] = [
                'element' => 'chapter',
                'number'  => $chapter->order,
                'content' => "{$chapter->order}.md"
            ];
        endforeach;

        $config[ 'book' ][ 'contents' ] = array_merge( $config[ 'book' ][ 'contents' ], $contents );

        $yml = $this->ymlDumper->dump( $config, 4 );

        file_put_contents( $book->config_file, $yml );
    }


    protected function exportContents( Book $book, $chapters )
    {
        if( !is_dir( $book->contents_storage ) ) {
            mkdir( $book->contents_storage, 0775, true );
        }

        foreach( $chapters as $chapter ):
            file_put_contents( "{$book->contents_storage}/{$chapter->order}.md", $chapter->content );
        endforeach;
    }

    public function compress( Book $book )
    {
        if( !is_dir( $book->output_storage ) ) {
            mkdir( $book->output_storage, 0775, true );
        }
        
        ExtendedZip::zipTree( $book->output_storage, $book->zip_file, ExtendedZip::CREATE );
    }
}