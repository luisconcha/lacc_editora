<?php
return [
  'name' => 'LaccBook',
  'acl'  => [
    'role_author'             => env( 'ROLE_AUTHOR', 'Author' ),
    'permissions'             => [
      'book_manage_all' => 'books-admin/manage_all',
    ],
    'controllers_annotations' => [],
  ],
];
