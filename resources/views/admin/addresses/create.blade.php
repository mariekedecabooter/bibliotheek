@extends('layouts.admin')
@section('content')
    <h1>Create Address</h1>
    {!! Form::open(['method'=>'POST', 'action'=> 'AdminAddressController@store']) !!}
    <div class="form-group">
        {!! Form::label('name', 'name:') !!}
        {!! Form::select('name',[''=>'Choose options'] + $users,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('straat', 'straat: ') !!}
        {!! Form::text('straat', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('nummer', 'nummer: ') !!}
        {!! Form::text('nummer', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('busnummer', 'busnummer: ') !!}
        {!! Form::text('busnummer', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('postcode', 'postcode: ') !!}
        {!! Form::text('postcode', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('stad', 'stad: ') !!}
        {!! Form::text('stad', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create Address', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop
