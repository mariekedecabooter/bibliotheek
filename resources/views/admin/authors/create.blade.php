@extends('layouts.admin')
@section('content')
    <h1>Create Author</h1>
    {!! Form::open(['method'=>'POST', 'action'=> 'AdminAuthorController@store']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create Author', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop
