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


trait BookThumbnailTrait
{
    public function getThumbnailNameAttribute()
    {
        return "{$this->id}.jpg";
    }

    public function getThumbnailSmallNameAttribute()
    {
        return "{$this->id}_small.jpg";
    }

    public function getThumbsPathAttribute()
    {
        return config( 'laccbook.book_thumbs' );
    }

    public function getThumbsStorageAttribute()
    {
        return public_path( $this->thumbs_path );
    }

    public function getThumbnailRelativeAttribute()
    {
        return "{$this->thumbs_path}/{$this->thumbnail_name}";
    }

    public function getThumbnailSmallRelativeAttribute()
    {
        return "{$this->thumbs_path}/{$this->thumbnail_small_name}";
    }

    public function getThumbnailFileAttribute()
    {
        return "{$this->thumbs_storage}/{$this->thumbnail_name}";
    }

    public function getThumbnailSmallFileAttribute()
    {
        return "{$this->thumbs_storage}/{$this->thumbnail_small_name}";
    }
}