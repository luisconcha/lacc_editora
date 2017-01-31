<div class="form-group">
    {!! Form::label('Title','Title:') !!}
    {!! Form::text('title', null, ['placeholder'=>'Enter book title:','class'=>'form-control', 'id'=>'title']) !!}
</div>

<div class="form-group">
    {!! Form::label('Subtitle','Subtitle') !!}
    {!! Form::text('subtitle', null, ['placeholder'=>'Enter the subtitle','class'=>'form-control', 'id'=>'Subtitle']) !!}
</div>

<div class="form-group">
    {!! Form::label('Price','Price') !!}
    {!! Form::text('price', null, ['placeholder'=>'Enter the price','class'=>'form-control', 'id'=>'price']) !!}
</div>