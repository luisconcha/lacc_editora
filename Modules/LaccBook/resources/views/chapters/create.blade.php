@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>New Chapter - Book: <span class="label label-primary">{{$book->title}}</span></h3>

            @include('errors._check')
            {{ Form::open(array('route' => array('chapters.store', $book->id))) }}

            @include('laccbook::chapters._form')

            <div class="form-group text-center">
                {!! Form::submit('Save', ['class'=>'btn btn-primary btn-sm']) !!}
                <a href="{{route('chapters.index',['book'=>$book->id])}}" class="btn btn-warning btn-sm"> Return </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection