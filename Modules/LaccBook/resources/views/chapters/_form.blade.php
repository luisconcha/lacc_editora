{{--{!! Form::hidden('redirect_to', URL::previous()) !!}--}}


<div class="form-group {{ $errors->first('name')? ' has-error':'' }}">
    {!! Form::label('name','Title:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['placeholder'=>'Enter chapter name:','class'=>'form-control', 'id'=>'name']) !!}
</div>

<div class="form-group {{ $errors->first('order_id')? ' has-error':'' }}">
    {!! Form::label('order','Order', ['class' => 'control-label']) !!}
    {!! Form::text('order', isset($chapter)?$chapter->order:1, ['placeholder'=>'Enter chapter order:',
    'class'=>'form-control',
    'id'=>'order'])
     !!}
</div>

<div class="form-group {{ $errors->first('content')? ' has-error':'' }}">
    {!! Form::label('content','Subtitle', ['class' => 'control-label']) !!}
    {!! Form::textarea('content', null, ['placeholder'=>'Enter the content','class'=>'form-control', 'id'=>'content']) !!}
</div>
