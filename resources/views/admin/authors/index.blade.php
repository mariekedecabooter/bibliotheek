@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            @if(Auth::user()->role_id == 1)
                <div class="d-flex justify-content-end my-2">
                    @if (isset($message))
                        <p>{{$message}}</p>
                    @endif

                    <div>
                        <a href="{{route('authors.create')}}" class="btn btn-primary">
                            <i class="fas fa-user-plus" style="font-size: 12px;"></i> | Create new author</a>
                    </div>
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    @if(Auth::user()->role_id == 1)
                        <th scope="col"></th>

                    @endif

                </tr>
                </thead>
                <tbody>
                @if ($authors)
                    @foreach($authors as $author)
                        <tr>
                            <td>{{$author->id}}</td>
                            <td>{{$author->name}}</td>
                            @if(Auth::user()->role_id == 1)
                                <td class="d-flex flex-column justify-content-center align-items-end">
                                    <a href="{{route('authors.edit', $author->id)}}"><i class="fas fa-cog"></i></a>

                                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminAuthorController@destroy',
                                        $author->id]]) !!}
                                    <div class="form-group">
                                        <button type="submit" class="btn p-0">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

        </div>
    </div>
@stop
