@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between my-2">
                <h1>All users</h1>
                @if(Auth::user()->role_id == 1)
                    <div>
                        <a href="{{route('users.create')}}" class="btn btn-primary">
                            <i class="fas fa-user-plus" style="font-size: 12px;"></i> | Create new user</a>
                    </div>
                @endif
            </div>

            <table class="table table-striped border">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    @if(Auth::user()->role_id == 1)
                        <th scope="col">Last name</th>
                        <th scope="col">Rijksregisternummer</th>
                        <th scope="col">Address id</th>
                        <th scope="col">Email</th>
                        <th scope="col">Active</th>
                    @endif
                    <th scope="col">Role</th>
                    <th scope="col"></th>
                </tr>
                </thead>

                <tbody>
                @if ($users)
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            @if(Auth::user()->role_id == 1)
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->rijksregisternummer}}</td>
                                <td>{{$user->address_id}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->is_active}}</td>
                            @endif
                            <td>{{$user->role ? $user->role->name : ''}}</td>
                            <td class="d-flex justify-content-end">
                                @if(Auth::user()->role_id == 1)
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',
                                       $user->id]]) !!}
                                    <div class="form-group">
                                        <button type="submit" class="btn p-0">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </div>
                                @endif

                                {!! Form::close() !!}
                                    @if (Auth::user()->id == $user->id || Auth::user()->role_id == 1)
                                        <a href="{{route('users.edit', $user->id)}}" class="mx-2">
                                            <i class="fas fa-user-cog"></i>
                                        </a>
                                  @endif

                                <a href="{{route('users.show', $user->id)}}" class="mx-2">
                                    <i class="fas fa-user-tag"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{$users->links()}}
            </div>
        </div>
    </div>
@stop
