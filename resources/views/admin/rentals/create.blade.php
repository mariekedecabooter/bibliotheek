@extends('layouts.admin')
@section('content')
    <h1>Create Rental</h1>
    {!! Form::open(['method'=>'POST', 'action'=> 'AdminRentalController@store','files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('user_id', 'user:') !!}
        {!! Form::select('user_id',[''=>'Choose options'] + $users,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('record_id', 'record:') !!}
        {!! Form::select('record_id',[''=>'Choose options'] + $records,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('date_out', 'date_out: ') !!}
        {!! Form::date('date_out', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('date_returned', 'date returned: ') !!}
        {!! Form::date('date_returned', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create rental', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop
