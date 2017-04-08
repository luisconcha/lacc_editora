<?php
use Illuminate\Database\Migrations\Migration;
use LaccUser\Models\Permission;

class CreateManagerBookPermissionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        list( $name, $resourceName ) = explode( '/', config( 'laccbook.acl.permissions.book_manage_all' ) );
        Permission::create( [
          'name'                 => $name,
          'description'          => 'Book administration',
          'resource_name'        => $resourceName,
          'resource_description' => 'Manage all books',
        ] );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        list( $name, $resourceName ) = explode( '/', config( 'laccbook.acl.permissions.book_manage_all' ) );
        $permission = Permission::where( 'name', $name )
          ->where( 'resource_name', $resourceName )
          ->first();
        $permission->roles()->detach();
        $permission->delete();
    }
}
