@extends('layouts.app')

@section('title')
    List of Books
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3>List of books</h3>
            <a href="{{ route( 'books.create' )  }}" class="btn btn-primary">New book</a>
        </div>
        <br>
        <div class="row">
            {!! Form::model(compact($search), ['class' => 'form', 'method' => 'GET']) !!}
            <div class="input-group">
                <span class="input-group-btn">
                    {!! Form::submit('Search by:', ['class'=>'btn btn-primary']) !!}
                </span>
                {!! Form::text('search', null, ['placeholder'=> ($search) ? $search : 'title, author, category, price','class'=>'form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Author</th>
                    <th>Category</th>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->price }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>
                            <a href="{{route('books.edit',['id'=>$book->id])}}"
                               class="btn btn-warning btn-outline btn-xs">
                                <strong>Edit</strong>
                            </a>
                            <a href="{{route('books.destroy',['id'=>$book->id])}}"
                               class="btn btn-danger btn-outline btn-xs">
                                <strong>Delete</strong>
                            </a>
                            <a href="{{route('books.detail',['id'=>$book->id])}}"
                               class="btn btn-warning btn-outline btn-xs">
                                <strong>Detail</strong>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">{{ $books->links() }}</div>

        </div>
    </div>
@endsection
