<?php
/**
 * File: BookStorageTrait.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 23/04/17
 * Time: 11:14
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LaccBook\Models;


trait BookStorageTrait
{
    public function getDiskAttribute()
    {
        $bookStorageDriver = config( 'laccbook.book_storage' );

        return config( "filesystems.disks.{$bookStorageDriver}.root" );
    }

    public function getBookStorageAttribute()
    {
        return "{$this->disk}/{$this->id}";
    }

    public function getCoverEbookNameAttribute()
    {
        return 'cover.jpg';
    }

    public function getEbookTemplateAttribute()
    {
        return "{$this->id}/Resources/Templates/ebook";
    }

    public function getCoverEbookFileAttribute()
    {
        return "{$this->disk}/{$this->ebook_template}/{$this->cover_ebook_name}";
    }

    public function getCoverPdfNameAttribute()
    {
        return 'cover.pdf';
    }

    public function getPdfTemplateAttribute()
    {
        return "{$this->id}/Resources/Templates/pdf";
    }

    public function getPdfTemplateStorageAttribute()
    {
        return "{$this->disk}/{$this->pdf_template}";
    }

    public function getCoverPdfFileAttribute()
    {
        return "{$this->pdf_template_storage}/{$this->cover_pdf_name}";
    }

    public function getContentsStorageAttribute()
    {
        return "{$this->book_storage}/Contents";
    }

    public function getTemplateConfigFileAttribute()
    {
        return "{$this->disk}/template/config.yml";
    }

    public function getConfigFileAttribute()
    {
        return "{$this->book_storage}/config.yml";
    }

}