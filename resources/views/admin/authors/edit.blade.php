@extends('layouts.admin')
@section('content')
    <h1>Edit Author</h1>
    <div class="col-md-6 px-0">
        <div class="card">
            <div class="card-body">
                {!! Form::model($author,['method'=>'PATCH','action'=>['AdminAuthorController@update', $author->id]]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Update author', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
