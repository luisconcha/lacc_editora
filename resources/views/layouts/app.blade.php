<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode( [
          'csrfToken' => csrf_token(),
        ] ); ?>
    </script>
</head>
<body>
<div id="app">
    <?php
    $navbar = Navbar::withBrand( config( 'app.name' ), url( '/home' ) )->inverse();
    if ( Auth::check() ) {
        $arrayLinks = array();
        //@see {$p->name}/{$p->resource_name} in Modules/LaccUser/Providers/AuthServiceProvider.php
        //'users-admin/list','roles-admin/list-roles', 'books-admin/list-books'
        if ( Auth::user()->can( 'users-admin/list' ) ) {
            $arrayLinks[] = [
              'User',
              [
                [
                  'link'  => route( 'laccuser.users.index' ),
                  'title' => 'User'
                ],
                [
                  'link'  => route( 'laccuser.advanced.users.search' ),
                  'title' => 'Advanced Search'
                ],
                [
                  'link'  => route( 'laccuser.trashed.users.index' ),
                  'title' => 'Users Trash'
                ]
              ]
            ];
        }
        if ( Auth::user()->can( 'roles-admin/list-roles' ) ) {
            $arrayLinks[] = [
              'Roles',
              [
                [
                  'link'  => route( 'laccuser.role.roles.index' ),
                  'title' => 'List of roles'
                ]
              ]
            ];
        }
        if ( Auth::user()->can( 'books-admin/list-books' ) ) {
            $arrayLinks[] = [
              'Book',
              [
                [
                  'link'  => route( 'books.index' ),
                  'title' => 'List of books'
                ],
                [
                  'link'  => route( 'trashed.books.index' ),
                  'title' => 'Books Trash'
                ]
              ]
            ];
        }
        if ( Auth::user()->can( 'categories-admin/list-categories' ) ) {
            $arrayLinks[] = [
              'Category',
              [
                [
                  'link'  => route( 'categories.index' ),
                  'title' => 'List of Categories'
                ],
                [
                  'link'  => route( 'trashed.categories.index' ),
                  'title' => 'Categories Trash'
                ]
              ]
            ];
        }
        $links  = Navigation::links( $arrayLinks );
        $logout = Navigation::links( [
          [
            Auth::user()->name,
            [
              [
                'link'           => url( '/logout' ),
                'title'          => 'Logout',
                'linkAttributes' => [
                  'onClick' => "event.preventDefault();document.getElementById(\"logout-form\").submit();"
                ]
              ],
              [
                'link'  => route( 'laccuser.users.edit', [ 'id' => Auth::user()->id ] ),
                'title' => 'Edit profile'
              ]
            ],
          ]
        ] )->right();
        $navbar->withContent( $links )->withContent( $logout );
    }
    ?>
    {!! $navbar !!}
    {!! Form::open(['url' => url('/logout'), 'id' => 'logout-form', 'style' => 'display:none']) !!}
    {!! Form::close() !!}

    @if( Session::has('message') )
        <div class="alert alert-{{ Session::get("message.type") }} alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            <p>The publisher reports:</p>
            <p><strong>{{Session::get("message.msg")}}</strong></p>
        </div>
    @endif

    @if( Session::has('error') )
        <div class="alert alert-{{ Session::get("error.type") }} alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            <p>The publisher reports:</p>
            <p><strong>{{Session::get("error.msg")}}</strong></p>
        </div>
    @endif

    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>

@yield('scripts')

@stack('scripts')
</body>
</html>
