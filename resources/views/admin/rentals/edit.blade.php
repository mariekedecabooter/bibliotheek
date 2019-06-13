@extends('layouts.admin')
@section('content')
    <h1>Edit Rental</h1>
    {!! Form::model($rental,['method'=>'PATCH', 'action'=> ['AdminRentalController@update',$rental->id]]) !!}
    <div class="form-group">
        {!! Form::label('user_id', 'user:') !!}
        {!! Form::select('user_id',[''=>'Choose options'] + $users,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('record_id', 'record:') !!}
        {!! Form::select('record_id',[''=>'Choose options'] + $records,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('date_out', 'date out: ') !!}
        {!! Form::DateTime('date_out', null, ['class'=>'form-control date']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('date_returned', 'date returned: ') !!}
        {!! Form::DateTime('date_returned', null, ['class'=>'form-control timepicker']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}


@stop
