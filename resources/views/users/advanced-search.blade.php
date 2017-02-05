@extends('layouts.app')

@section('title')
    Advanced user search
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3>Advanced user search</h3>

            {!! Form::model(compact([]), ['class' => 'form-search', 'method' => 'GET']) !!}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('name','Name', ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['placeholder'=>'Enter user name','class'=>'form-control', 'id'=>'name']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('CPF','CPF', ['class' => 'control-label']) !!}
                        {!! Form::text('num_cpf', null, ['placeholder'=>'Enter cpf','class'=>'form-control', 'id'=>'num_cpf']) !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('RG','RG', ['class' => 'control-label']) !!}
                        {!! Form::text('num_rg', null, ['placeholder'=>'Enter rg','class'=>'form-control', 'id'=>'num_cpf']) !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('Email','Email', ['class' => 'control-label']) !!}
                        {!! Form::text('email', null, ['placeholder'=>'Enter your email','class'=>'form-control', 'id'=>'email']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('District','District', ['class' => 'control-label']) !!}
                        {!! Form::text('district', null, ['placeholder'=>'Enter district','class'=>'form-control', 'id'=>'district']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('Address','Address', ['class' => 'control-label']) !!}
                        {!! Form::text('address', null, ['placeholder'=>'Enter address','class'=>'form-control', 'id'=>'address']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                {!! Form::submit('Search...', ['class'=>'btn btn-primary btn-sm']) !!}
                <a href="{{ route('users.index') }}" class="btn btn-warning btn-sm"> Return </a>
            </div>
            {!! Form::close() !!}
        </div>
        <hr>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <td>CPF</td>
                    <td>RG</td>
                    <td>District</td>
                    <th>Address</th>
                    <th>Cep</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->num_cpf }}</td>
                        <td>{{ $user->num_rg }}</td>
                        <td>{{ $user->address->district }}</td>
                        <td>{{ $user->address->address }}</td>
                        <td>{{ $user->address->cep }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">{{ $users->links() }}</div>

        </div>
    </div>
@endsection
