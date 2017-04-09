@extends('layouts.app')

@section('title')
    Detail of book
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3>Detail the Book: <strong><b>{{ $book->title }}</b></strong></h3>

            <span><b>Title</b></span>
            <p>{{ $book->title }}</p>

            <span><b>Subtitle</b></span>
            <p>{{ $book->subtitle }}</p>

            <span><b>Dedication</b></span>
            <p>{{ $book->dedication }}</p>

            <span><b>Description</b></span>
            <p>{{ $book->description }}</p>

            <span><b>Website</b></span>
            <p>{{ $book->website }}</p>

            <span><b>Author</b></span>
            <p>{{ $book->author->name }}</p>

            <span><b>Price:</b></span>
            <p> R$ {{ $book->price }}</p>
            
            <span><b>Percent complete</b></span>
            <p>{{ $book->percent_complete }}</p>

            <span><b>Is it published?</b></span>
            <p>{{ ($book->published == 0) ? "Yes, it's posted": "No, it's published." }}</p>

            <span><b>Categories:</b></span>
            <p>{{ $book->categories->implode('name_trashed',',') }}</p>
        </div>
        <div class="row">
            <a href="{{ route('books.index') }}" class="btn btn-primary">Return list of books</a>

            <a href="{{route('books.edit',['id'=>$book->id])}}" class="btn btn-warning">Edit the of book</a>
        </div>
    </div>

@endsection