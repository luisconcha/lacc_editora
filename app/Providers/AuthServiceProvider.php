<?php
namespace LACC\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      'LACC\Model' => 'LACC\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
        \Gate::define( 'update-book', function ( $user, $book ) {
            return $user->id == $book->author_id;
        } );
        /**
         * Executa antes de chamar outras hailidades
         * //if retorna true - autorizado
         * //if retorna false - NÃO autorizado
         * //if retorna void - executa a habilidade em questão
         */
        \Gate::before( function ( $user, $ability  ) {
            if ( $user->isAdmin() ) {
                return true;
            }
        } );
    }
}
