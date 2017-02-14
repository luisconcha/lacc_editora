@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!

                    <ul>
                        <li><a href="{{ route('laccuser.users.index') }}">Users</a></li>
                        <li><a href="{{ route('categories.index') }}">Categories</a></li>
                        <li><a href="{{ route('books.index') }}">Books</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
