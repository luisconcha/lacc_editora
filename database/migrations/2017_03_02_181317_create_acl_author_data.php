<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use LaccUser\Models\Role;
use LaccUser\Models\User;

class CreateAclAuthorData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create( [
          'name'        => config( 'laccbook.acl.role_author' ),
          'cor'         => '#155b2a',
          'description' => 'Papel do usuário author do sistema',
        ] );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAuthor = Role::where( 'name', config( 'laccbook.acl.role_author' ) )->first();
        $roleAuthor->permissions()->detach();
        $roleAuthor->users()->detach();
        $roleAuthor->delete();
    }
}
