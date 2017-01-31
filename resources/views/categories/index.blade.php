@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>List of categories</h3>
            <a href="{{ route( 'categories.create' )  }}" class="btn btn-primary">New category</a>
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
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{route('categories.edit',['id'=>$category->id])}}"
                               class="btn btn-warning btn-outline btn-xs">
                                <strong>Edit</strong>
                            </a>
                            <a href="{{route('categories.destroy',['id'=>$category->id])}}"
                               class="btn btn-danger btn-outline btn-xs">
                                <strong>Delete</strong>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">{{ $categories->links() }}</div>

        </div>
    </div>
@endsection
