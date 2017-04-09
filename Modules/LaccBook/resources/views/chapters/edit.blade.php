@extends('layouts.app')

@section('title')
    Edit Chapter
@endsection

@section('content')
    <div class="container">
        <h1>Editing chapter of the book: <span class="label label-primary">{{ $book->title }}</span></h1>

        @include('errors._check')

        {!! Form::model($chapter,['route'=>['chapters.update','books'=>$book->id,'id'=>$chapter->id],'method'=>'put'])
        !!}

        @include('laccbook::chapters._form')

        <div class="form-group text-center">
        {!! Form::submit('Edit', ['class'=>'btn btn-primary btn-sm']) !!}

        <a href="{{route('chapters.index',['book'=>$book->id])}}" class="btn btn-warning btn-sm"> Return </a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection