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
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <?php
        $navbar = Navbar::withBrand(config('app.name'), url('/home'))->inverse();
        if( Auth::check() ){
            $links = Navigation::links( [
                    [
                            'User',
                            [
                                    [
                                            'link' => route( 'users.index' ),
                                            'title' => 'User'
                                    ],
                                    [
                                            'link' => route( 'advanced.users.search' ),
                                            'title' => 'Advanced Search'
                                    ]
                            ]
                    ],
                    [
                            'Category',
                            [
                                    [
                                            'link' => route( 'categories.index' ),
                                            'title' => 'List of Categories'
                                    ],
                                    [
                                            'link' => route( 'trashed.categories.index' ),
                                            'title' => 'Categories Trash'
                                    ]
                            ]
                    ],
                    [
                            'Book',
                            [
                                    [
                                            'link' => route( 'books.index' ),
                                            'title' => 'List of books'
                                    ],
                                    [
                                            'link' => route( 'trashed.books.index' ),
                                            'title' => 'Books Trash'
                                    ]
                            ]
                    ]
            ] );
            $logout = Navigation::links([
                    [
                            Auth::user()->name,
                            [
                                    [
                                            'link' => url('/logout'),
                                            'title' => 'Logout',
                                            'linkAttributes' => [
                                                    'onClick' => "event.preventDefault();document.getElementById(\"logout-form\").submit();"
                                            ]
                                    ],
                                    [
                                        'link' => route('users.edit', ['id'=>Auth::user()->id]),
                                        'title' => 'Edit profile'
                                    ]
                            ],
                    ]
            ])->right();
            $navbar->withContent( $links )->withContent($logout);
        }
        ?>
        {!! $navbar !!}
        {!! Form::open(['url' => url('/logout'), 'id' => 'logout-form', 'style' => 'display:none']) !!}
        {!! Form::close() !!}

        @if( Session::has('message') )
                <div class="alert alert-{{ Session::get("message.type") }}">
                    <p>The publisher reports:</p>
                    <p><strong>{{Session::get("message.msg")}}</strong></p>
                </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>

    @yield('scripts')
</body>
</html>
