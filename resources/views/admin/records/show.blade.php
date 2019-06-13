@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td>
                                <img src="{{$record->photo ? asset($record->photo->file) :
                                'http://place-hold.it/400x400'}}" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Id</th>
                            <td>{{$record->id}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Titel</th>
                            <td>{{$record->titel}}</td>

                        </tr>
                        <tr>
                            <th scope="row">Auteur</th>
                            <td>{{$record->author->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">ISBN</th>
                            <td>{{$record->isbn}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jaartal</th>
                            <td>{{$record->jaartal}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Uitgave</th>
                            <td>{{$record->uitgave}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Beschrijving</th>
                            <td>{{$record->beschrijving}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Aantal</th>
                            <td>Totaal aantal boeken {{$record->aantal}} -
                                @if ($record->aantal - count($record->rentals->where('date_returned','=',NULL)->all()
                                ) == 0)
                                    <span style="color: red;">Geen beschikbaar</span>
                                @else

                                    <span style="color: darkgreen;">{{($record->aantal) -
                            (count($record->rentals->where('date_returned','=',NULL)->all()))}} beschikbaar</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Gemaakt op</th>
                            <td>{{$record->created_at}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Gewijzigd op</th>
                            <td>{{$record->updated_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-lg-6">
            @if (count($record->rentals->where('user_id','=',Auth::user()->id)->where('date_returned','=',NULL)) == 1)

                {!! Form::model($rentals,['method'=>'PATCH',
                                        'action'=>['AdminRentalController@update', $rentals->id]])!!}

                <input type="hidden" name="return" value="true">
                <div class="form-group">
                    {!! Form::submit('Lever dit boek in', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            @endif
            <h3>Uitgeleend</h3>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">record</th>
                    <th scope="col">user</th>
                    <th scope="col">date out</th>
                    <th scope="col">date in</th>
                    <th scope="col">date returned</th>

                </tr>
                </thead>
                <tbody>
                @if ($recordRentals = $record->rentals->where('date_returned','=', NULL))
                    @foreach($recordRentals as $recordRental)

                        <tr>
                            <td>{{$recordRental->id}}</td>
                            <td>{{$recordRental->record->titel}}</td>
                            <td><a href="{{route('users.show',$recordRental->user->id)
                                }}">{{$recordRental->user->name}}</a></td>
                            <td>{{$recordRental->date_out}}</td>
                            <td>{{$recordRental->date_in}}</td>
                            <td>{{$recordRental->date_returned}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

            <h3>History</h3>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">record</th>
                    <th scope="col">user</th>
                    <th scope="col">date out</th>
                    <th scope="col">date in</th>
                    <th scope="col">date returned</th>

                </tr>
                </thead>
                <tbody>
                @if ($recordRentals = $record->rentals->where('date_returned','!=', NULL))
                    @foreach($recordRentals as $recordRental)

                        <tr>
                            <td>{{$recordRental->id}}</td>
                            <td>{{$recordRental->record->titel}}</td>
                            <td><a href="{{route('users.show',$recordRental->user->id)
                                }}">{{$recordRental->user->name}}</a></td>
                            <td>{{$recordRental->date_out}}</td>
                            <td>{{$recordRental->date_in}}</td>
                            <td>{{$recordRental->date_returned}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@stop
