@extends('layouts.app')

@section('title')
    Detail of Chapter
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h1>Detail chapter of the book: <span class="label label-primary">{{ $book->title }}</span></h1>

            @forelse($chapters as $chapter)

                <p><b>Name: </b>{{ $chapter->name}} - <span class="label label-default">id({{$chapter->id}})</span></p>
                <p><b>Content: </b>{{ $chapter->content}} </p>
                <p><b>Order: </b>{{ $chapter->order}} </p>
                <p><b>Created at: </b>{{dateHoraMinuteBR($chapter->created_at) }} </p>
                <p><b>Last change: </b>{{dateHoraMinuteBR($chapter->update_at) }} </p>

                <hr>
            @empty
                <p class="text-center"><span class="label label-warning">No records</span></p>
            @endforelse
        </div>
        <div class="row text-center">
            <a href="{{route('chapters.index',['book'=>$book->id])}}" class="btn btn-warning btn-block"> Return </a>
        </div>
    </div>

@endsection