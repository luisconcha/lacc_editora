<?php
namespace LaccBook\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use LaccBook\Models\Book;
use LaccUser\Models\User;

class BookPolicy
{
    use HandlesAuthorization;

    public function before( $user, $ability )
    {
        if ( $user->can( config( 'laccbook.acl.permissions.book_manage_all' ) ) ) {
            return true;
        }
    }

    /**
     * @param User $user
     * @param Book $book
     *
     * @return bool
     */
    public function update( User $user, Book $book )
    {
        return $user->id == $book->author_id;
    }
}
