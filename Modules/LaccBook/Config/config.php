<?php
return [
    'name'         => 'LaccBook',
    'acl'          => [
        'role_author'             => env( 'ROLE_AUTHOR', 'Author' ),
        'permissions'             => [
            'book_manage_all' => 'books-admin/manage_all',
        ],
        'controllers_annotations' => [],
    ],
    'book_storage' => env( 'BOOK_STORAGE_DISK', 'book_local' ),
    'book_thumbs'  => 'storage/books/thumbs'
];
