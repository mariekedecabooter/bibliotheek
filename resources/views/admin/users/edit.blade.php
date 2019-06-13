@extends('layouts.admin')
@section('content')
    <h1>Edit User</h1>
    {!! Form::model($user,['method'=>'PATCH','action'=>['AdminUsersController@update', $user->id]]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('last_name', 'Last name:') !!}
        {!! Form::text('last_name',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'E-mail:') !!}
        {!! Form::text('email',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'Role id:') !!}
        {!! Form::select('role_id',[''=>'Choose options'] + $roles,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active', 'Status:') !!}
        {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'),null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update User', ['class'=>'btn btn-primary col-md-6']) !!}
    </div>
    {!! Form::close() !!}
@stop
