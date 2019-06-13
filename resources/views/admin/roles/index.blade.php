@extends('layouts.admin')
@section('content')
    <div class="row">

        <div class="col-lg-6">
            <h1>Roles</h1>
            @if (Auth::user()->role_id == 1)
                <div class="card mb-2">
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
            @endif
            @if ($roles)
                <table class="table table-striped border">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>
                                @if (Auth::user()->role_id == 1)
                                    <div class="d-flex">
                                        {!! Form::model($role,['method'=>'PATCH','action'=>['AdminRolesController@update', $role->id]]) !!}
                                        <div class="d-flex">
                                            <div class="form-group mr-2">
                                                {!! Form::text('name',null, ['class'=>'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::submit('edit', ['class'=>'btn btn-primary mx-2']) !!}
                                            </div>

                                        </div>
                                        {!! Form::close() !!}

                                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminRolesController@destroy',
                                    $role->id]]) !!}
                                        <div class="form-group">
                                            {!! Form::submit('Delete', ['class'=>'btn btn-danger mx-2']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                @else
                                    {{$role->name}}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>

        </div>
    </div>
@stop
