@extends('layouts.layout')

@section('title')
Edit {{$place->hotelName}}
@stop

@section('body')
<div style="margin-left:5%">
  {!!Form::model($place,[
    'method'=>'patch',
    'route'=>['product.update',$place->hotelID]
    ]) !!}

    {!!Form::label('Name: ')!!}
    {!!Form::text('name',$place->hotelName,['placeholder'=>"give a nanme"])!!}

  {!!Form::submit('Edit')!!}
  {!!Form::close()!!}
</div>
@stop
