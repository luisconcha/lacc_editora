@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Book cover: <span class="label label-primary">{{ $book->title }}</span></h3>

            @include('errors._check')

            {!! Form::open(['route'=>['books.cover.store', $book->id],'files' => true]) !!}

            {!! Form::hidden('redirect_to', URL::previous()) !!}


            <div class="form-group {{ $errors->first('file')? ' has-error':'' }}">
                {!! Form::label('file','Cover (Accepted formats: .jpg, .png)', ['class' => 'control-label']) !!}
                {!! Form::file('file', ['class'=>'form-control']) !!}
            </div>

            <div class="form-group text-center">
                {!! Form::submit('Upload', ['class'=>'btn btn-primary btn-sm']) !!}
                <a href="{{ route('books.index') }}" class="btn btn-warning btn-sm"> Return </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection