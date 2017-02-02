@extends('layouts.app')

@section('title')
    List of Users
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3>List of users</h3>
            <a href="{{ route( 'users.create' )  }}" class="btn btn-primary">New user</a>
        </div>

        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <a href="{{route('users.edit',['id'=>$user->id])}}"
                               class="btn btn-warning btn-outline btn-xs">
                                <strong>Edit</strong>
                            </a>
                            <a href="{{route('users.destroy',['id'=>$user->id])}}"
                               class="btn btn-danger btn-outline btn-xs">
                                <strong>Delete</strong>
                            </a>
                            <a href="{{route('users.detail',['id'=>$user->id])}}"
                               class="btn btn-warning btn-outline btn-xs">
                                <strong>Detail</strong>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">{{ $users->links() }}</div>

        </div>
    </div>
@endsection
