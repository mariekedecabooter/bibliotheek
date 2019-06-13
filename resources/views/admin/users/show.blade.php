@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-lg-6">
            <h3>{{$user->name}}</h3>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th scope="row">Id</th>
                            <td>{{$user->id}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Name</th>
                            <td>{{$user->name}}</td>

                        </tr>
                        <tr>
                            <th scope="row">Last name</th>
                            <td>{{$user->last_name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Rijksregisternummer</th>
                            <td>{{$user->rijksregisternummer}}</td>
                        </tr>
                        @if (isset($user->address_id) )
                            <tr>
                                <th scope="row">Straat</th>
                                <td>{{$user->address->straat}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nummer</th>
                                <td>{{$user->address->nummer}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Busnummer</th>
                                <td>{{$user->address->busnummer}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Postcode</th>
                                <td>{{$user->address->postcode}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Stad</th>
                                <td>{{$user->address->stad}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Role</th>
                                <td>{{$user->role->name}}</td>
                            </tr>
                        @endif
                        <tr>
                            <th scope="row">Created at</th>
                            <td>{{$user->created_at}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Updated at</th>
                            <td>{{$user->updated_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-lg-6">
            <h3>Uitgeleende boeken</h3>
            <table class="table table-striped border">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Record</th>
                    <th scope="col">Date out</th>
                    <th scope="col">Date in</th>
                    @if(Auth::user()->id == $user->id)
                        <th scope="col">Return</th>

                    @endif

                </tr>
                </thead>
                <tbody>
                @if ($userRentals =  ($userRentalsOrder->where('date_returned','=',NULL)))
                    @foreach($userRentals as $userRental)

                        <tr>
                            <td>{{$userRental->id}}</td>
                            <td>{{$userRental->record->titel}}</td>
                            <td>{{$userRental->date_out}}</td>
                            <td>{{$userRental->date_in}}</td>
                            <td>
                                @if(Auth::check())
                                    @if (Auth::user()->id  == $user->id)
                                        {!! Form::model($userRental,['method'=>'PATCH',
                                        'action'=>['AdminRentalController@update', $userRental->id]])!!}

                                        <input type="hidden" name="return" value="true">
                                        <div class="form-group">
                                            {!! Form::submit('Lever dit boek in', ['class'=>'btn btn-primary']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>History</h3>
            <table class="table table-striped border">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Record</th>
                    <th scope="col">User</th>
                    <th scope="col">Date out</th>
                    <th scope="col">Date in</th>
                    <th scope="col">Date returned</th>
                </tr>
                </thead>
                <tbody>
                @if ($userRentalsHistories =  $userRentalsOrderHistory)
                    @foreach($userRentalsHistories as $userRentalsHistory)

                        <tr>
                            <td>{{$userRentalsHistory->id}}</td>
                            <td>{{$userRentalsHistory->record->titel}}</td>
                            <td>{{$userRentalsHistory->name}}</td>
                            <td>{{$userRentalsHistory->date_out}}</td>
                            <td>{{$userRentalsHistory->date_in}}</td>
                            <td>{{$userRentalsHistory->date_returned}}</td>
                        </tr>

                    @endforeach
                @endif
                </tbody>
            </table>
            {{$userRentalsOrderHistory->links()}}

        </div>
    </div>

@stop
