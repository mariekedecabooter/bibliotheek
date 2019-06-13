@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-end my-2">
                <div>
                    <a href="{{route('addresses.create')}}" class="btn btn-primary">
                        <i class="fas fa-user-plus" style="font-size: 12px;"></i> | Create new address</a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">user</th>
                    <th scope="col">Id</th>
                    <th scope="col">straat</th>
                    <th scope="col">nummer</th>
                    <th scope="col">busnummer</th>
                    <th scope="col">postcode</th>
                    <th scope="col">stad</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @if ($addresses)
                    @foreach($addresses as $address)
                        <tr>
                            <td>{{$address->user->name}}</td>
                            <td>{{$address->id}}</td>
                            <td>{{$address->straat}}</td>
                            <td>{{$address->nummer}}</td>
                            <td>{{$address->busnummer}}</td>
                            <td>{{$address->postcode}}</td>
                            <td>{{$address->stad}}</td>
                            <td><a href="{{route('addresses.edit', $address->id)}}"><i class="fas fa-cog"></i></a>
                                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminAddressController@destroy',
                                       $address->id]]) !!}
                                <div class="form-group">
                                    <button type="submit" class="btn p-0">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

        </div>
    </div>
@stop
