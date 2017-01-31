@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Detail the Book: <strong><b>{{ $book->title }}</b></strong></h3>

            <span><b>Title</b></span>
            <p>{{ $book->title }}</p>

            <span><b>Subtitle</b></span>
            <p>{{ $book->subtitle }}</p>

            <span><b>Price:</b></span>
            <p> R$ {{ $book->price }}</p>
        </div>
        <div class="row">
            <a href="{{ route('books.index') }}" class="btn btn-primary">Return list of books</a>

            <a href="{{route('books.edit',['id'=>$book->id])}}" class="btn btn-warning">Edit the of book</a>
        </div>
    </div>

@endsection