@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6">

            <h1>Edit Record</h1>
            {!! Form::model($record,['method'=>'PATCH','action'=>['AdminRecordController@update', $record->id]]) !!}
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
                {!! Form::label('foto', 'foto:') !!}
                {!! Form::file('foto', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@stop
