@extends('layouts.admin')
@section('content')
    <h1>Edit Address</h1>
    {!! Form::model($address,['method'=>'PATCH','action'=>['AdminAddressController@update', $address->id]]) !!}

    <h5>{{$address->user->name}}</h5>
    <div class="form-group">
        {!! Form::label('straat', 'straat:') !!}
        {!! Form::text('straat',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('nummer', 'nummer:') !!}
        {!! Form::text('nummer',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('busnummer', 'busnummer:') !!}
        {!! Form::text('busnummer',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('postcode', 'postcode:') !!}
        {!! Form::text('postcode',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('stad', 'stad:') !!}
        {!! Form::text('stad',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update address', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop
