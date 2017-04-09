{!! Form::hidden('redirect_to', URL::previous()) !!}


<div class="form-group {{ $errors->first('title')? ' has-error':'' }}">
    {!! Form::label('title','Title:', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['placeholder'=>'Enter book title:','class'=>'form-control', 'id'=>'title']) !!}
</div>

<div class="form-group {{ $errors->first('subtitle')? ' has-error':'' }}">
    {!! Form::label('subtitle','Subtitle', ['class' => 'control-label']) !!}
    {!! Form::text('subtitle', null, ['placeholder'=>'Enter the subtitle','class'=>'form-control', 'id'=>'Subtitle']) !!}
</div>

<div class="form-group {{ $errors->first('author_id')? ' has-error':'' }}">
    {!! Form::label('author','Author', ['class' => 'control-label']) !!}
    {!! Form::select('author_id', $users,null, ['class'=>'form-control']) !!}
</div>

<div class="form-group {{ $errors->first('categories')? ' has-error':'' }}">
    {!! Form::label('category','Category', ['class' => 'control-label']) !!}
    {!! Form::select('categories[]', $categories,null, ['class'=>'form-control', 'multiple' => true]) !!}
</div>

<div class="form-group {{ $errors->first('price')? ' has-error':'' }}">
    {!! Form::label('price','Price', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ['placeholder'=>'Enter the price','class'=>'form-control', 'id'=>'price']) !!}
</div>

<div class="form-group {{ $errors->first('dedication')? ' has-error':'' }}">
    {!! Form::label('dedication','Dedication', ['class' => 'control-label']) !!}
    {!! Form::textarea('dedication', null, ['placeholder'=>'Enter the dedication','class'=>'form-control',
    'id'=>'dedication']) !!}
</div>

<div class="form-group {{ $errors->first('description')? ' has-error':'' }}">
    {!! Form::label('description','Description', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['placeholder'=>'Enter the description','class'=>'form-control',
    'id'=>'description']) !!}
</div>

<div class="form-group {{ $errors->first('website')? ' has-error':'' }}">
    {!! Form::label('website','Website', ['class' => 'control-label']) !!}
    {!! Form::url('website', null, ['placeholder'=>'Enter the website','class'=>'form-control', 'id'=>'website']) !!}
</div>

<div class="form-group {{ $errors->first('percent_complete')? ' has-error':'' }}">
    {!! Form::label('percent_complete','Percent complete (%)', ['class' => 'control-label']) !!}
    {!! Form::number('percent_complete', null, ['placeholder'=>'Enter the percent_complete','class'=>'form-control', 'id'=>'percent_complete']) !!}
</div>

<div class="form-group {{ $errors->first('published')? ' has-error':'' }}">
    {!! Form::label('published','Published?', ['class' => 'control-label']) !!}
    {!! Form::checkbox('published',null, (isset($book->published) && $book->published == '1')?true:false) !!}
</div>