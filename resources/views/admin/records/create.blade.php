@extends('layouts.admin')
@section('content')
    <h1>Create Record</h1>
    {!! Form::open(['method'=>'POST', 'action'=> 'AdminRecordController@store','files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('titel', 'titel: ') !!}
        {!! Form::text('titel', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('auteur_id', 'auteur:') !!}
        {!! Form::select('auteur_id',[''=>'Choose options'] + $authors,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('isbn', 'isbn: ') !!}
        {!! Form::text('isbn', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('jaartal', 'jaartal: ') !!}
        {!! Form::text('jaartal', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('uitgave', 'uitgave: ') !!}
        {!! Form::text('uitgave', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('beschrijving', 'beschrijving: ') !!}
        {!! Form::textarea('beschrijving', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('aantal', 'aantal: ') !!}
        {!! Form::text('aantal', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id', 'foto:') !!}
        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create Record', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop
