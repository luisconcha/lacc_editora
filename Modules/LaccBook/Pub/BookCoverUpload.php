<?php
/**
 * File: BookCoverUpload.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 23/04/17
 * Time: 11:11
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LaccBook\Pub;

use Illuminate\Http\UploadedFile;
use LaccBook\Models\Book;

class BookCoverUpload
{
    public function upload( Book $book, UploadedFile $file )
    {
        \Storage::disk( config( 'laccbook.book_storage' ) )
                ->putFileAs( $book->ebook_template, $file, $book->cover_ebook_name );

        $this->makeCoverPdf( $book );
    }

    protected function makeCoverPdf( Book $book )
    {
        if( !is_dir( $book->pdf_template_storage ) ) {
            mkdir( $book->pdf_template_storage, 0775, true );
        }

        $img = new \Imagick( $book->cover_ebook_file );
        $img->setImageFormat( 'pdf' );
        $img->writeImage( $book->cover_pdf_file );
    }

}