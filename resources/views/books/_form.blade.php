<div class="form-group {{ $errors->first('title')? ' has-error':'' }}">
    {!! Form::label('Title','Title:', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['placeholder'=>'Enter book title:','class'=>'form-control', 'id'=>'title']) !!}
</div>

<div class="form-group {{ $errors->first('subtitle')? ' has-error':'' }}">
    {!! Form::label('Subtitle','Subtitle', ['class' => 'control-label']) !!}
    {!! Form::text('subtitle', null, ['placeholder'=>'Enter the subtitle','class'=>'form-control', 'id'=>'Subtitle']) !!}
</div>

<div class="form-group {{ $errors->first('price')? ' has-error':'' }}">
    {!! Form::label('Price','Price', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ['placeholder'=>'Enter the price','class'=>'form-control', 'id'=>'price']) !!}
</div>