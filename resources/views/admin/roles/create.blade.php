@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h1>Create Role</h1>
                    {!! Form::open(['method'=>'POST', 'action'=> 'AdminRolesController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Role name: ') !!}
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create Role', ['class'=>'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>

@stop
