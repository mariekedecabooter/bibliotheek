@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            @if(Auth::user()->role_id == 2)
                <div class="d-flex justify-content-end my-2">
                    <div>
                        <p></p>
                        <a href="{{route('rentals.create')}}" class="btn btn-primary">
                            <i class="fas fa-user-plus" style="font-size: 12px;"></i> | Create new rental</a>
                    </div>
                </div>
            @endif
            <h3>Uitgeleend - {{count($rentalsOrder)}}</h3>
            <table class="table table-striped border">
                <thead>
                <tr>
                    <th scope="col">Rental id</th>
                    <th scope="col">Record id - titel</th>
                    <th scope="col">user</th>
                    <th scope="col">date out</th>
                    <th scope="col">date in</th>
                    <th scope="col">date returned</th>

                </tr>
                </thead>
                <tbody>
                @if ($rentals = $rentalsOrder)
                    @foreach($rentals as $rental)

                        <tr>
                            <td>{{$rental->id}}</td>
                            <td>{{$rental->record->id}} - {{$rental->record->titel}}</td>
                            <td>{{$rental->user->name}}</td>
                            <td>{{$rental->date_out}}</td>
                            <td>{{$rental->date_in}}</td>
                            <td>{{$rental->date_returned = 'NULL' ? 'Uitgeleend' :
                            $rental->date_returned}}</td>
                            <td><a href="{{route('rentals.edit', $rental->id)}}"><i class="fas fa-cog"></i></a>

                                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminRentalController@destroy',
                                       $rental->id]]) !!}
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
            <h3>History - {{count($rentalsOrderHistory)}}</h3>
            <table class="table table-striped border">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">record</th>
                    <th scope="col">user</th>
                    <th scope="col">date out</th>
                    <th scope="col">date in</th>
                    <th scope="col">Terug gebracht op</th>

                </tr>
                </thead>
                <tbody>
                @if ($rentalsHistories = $rentalsOrderHistory)
                    @foreach($rentalsHistories as $rentalsHistory)

                        <tr>
                            <td>{{$rentalsHistory->id}}</td>
                            <td>{{$rentalsHistory->record->titel}}</td>
                            <td>{{$rentalsHistory->user->name}}</td>
                            <td>{{$rentalsHistory->date_out}}</td>
                            <td>{{$rentalsHistory->date_in}}</td>
                            <td>{{$rentalsHistory->date_returned == 'NULL' ? 'Uitgeleend' :
                                $rentalsHistory->date_returned}}</td>
                            <td><a href="{{route('rentals.edit', $rentalsHistory->id)}}"><i class="fas fa-cog"></i></a>
                                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminRentalController@destroy',
                                       $rentalsHistory->id]]) !!}
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
            <div class="d-flex justify-content-end">
                {{$rentalsOrderHistory->links()}}
            </div>
        </div>
    </div>
@stop
