@extends('layouts.admin')
@section('content')
    <h1>Edit Role</h1>
    {!! Form::model($role,['method'=>'PATCH','action'=>['AdminRolesController@update', $role->id]]) !!}
    <div class="form-group">
        {!! Form::label('name', 'role name:') !!}
        {!! Form::text('name',null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update Role', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop
