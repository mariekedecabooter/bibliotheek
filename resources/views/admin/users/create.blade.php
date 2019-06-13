@extends('layouts.admin')
@section('content')
    <h1>Create User</h1>
    {!! Form::open(['method'=>'POST', 'action'=> 'AdminUsersController@store']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('last_name', 'last name: ') !!}
        {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email: ') !!}
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'password: ') !!}
        {!! Form::password('password', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('rijksregisternummer', 'Rijksregisternummer: ') !!}
        {!! Form::text('rijksregisternummer', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'Role id:') !!}
        {!! Form::select('role_id',[''=>'Choose options'] + $roles,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop
