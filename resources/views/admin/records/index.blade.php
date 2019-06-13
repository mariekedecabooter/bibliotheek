@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
            @if(Auth::user()->role_id == 1)
                <div class="d-flex justify-content-end my-2">
                    <div>
                        <a href="{{route('records.create')}}" class="btn btn-primary">
                            <i class="fas fa-user-plus" style="font-size: 12px;"></i> | Create new record</a>
                    </div>
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">titel</th>
                    <th scope="col">auteur</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Jaartal</th>
                    <th scope="col">Uitgave</th>
                    <th scope="col">Beschrijving</th>
                    <th scope="col">aantal</th>
                    <th scope="col">foto</th>
                    <th scope="col"></th>
                    @if(Auth::user()->role_id == 1)
                        <th scope="col"></th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @if ($records)
                    @foreach($records as $record)
                        <tr>
                            <td>{{$record->id}}</td>
                            <td>{{$record->titel}}</td>
                            <td>{{$record->author->name}}</td>
                            <td>{{$record->isbn}}</td>
                            <td>{{$record->jaartal}}</td>
                            <td>{{$record->uitgave}}</td>
                            <td>{{Str::limit($record->beschrijving,80)}}</td>
                            <td>{{$record->aantal}}</td>
                            <td>{{$record->foto}}</td>
                            <td>{{$aantalBeschikb = $record->aantal - (count(($record->rentals)->where('date_returned',
                            '=',NULL)))}} beschikbaar

                                @if(
                                $aantalBeschikb > 0 &&
                                (count(Auth::user()->rentals->where('record_id','=', $record->id)->where
                                ('date_returned','=',NULL))) == 0 &&
                                count(Auth::user()->rentals->where('date_returned','=',NULL)) < 7)
                                    {{Form::open(['method'=>'POST', 'action'=> 'AdminRentalController@store'])}}
                                    <input type="hidden" name="record_id" value="{{$record->id}}">
                                    {!! Form::submit('Reserveer',['class'=>'btn btn-success btn-sm']) !!}
                                    {{Form::close()}}

                                @elseif(count(Auth::user()->rentals->where('record_id','=',$record->id)->where('date_returned','=',NULL)) == 1)
                                    {{Form::open()}}
                                    <a href="" class="btn btn-warning">
                                        Gereserveerd tot {{ $record->rentals->where('user_id','=',
                                        Auth::user()->id)->first()->date_in}}
                                    </a>
                                    {{Form::close()}}

                                @elseif(count($record->rentals->where('date_returned','=',NULL)) === $record->aantal)
                                    {{Form::open()}}
                                    {!! Form::submit('Niet beschikbaar',['class'=>'btn btn-danger btn-sm','disabled'])
                                     !!}
                                    {{Form::close()}}

                                @elseif (count(Auth::user()->rentals->where('date_returned','=',NULL)) >= 7)
                                    {{Form::open()}}
                                    {!! Form::submit('max van 7 boeken geleend',['class'=>'btn btn-danger btn-sm d',
                                    'disabled'])
                                     !!}
                                    {{Form::close()}}


                                @endif
                            </td>
                            @if(Auth::user()->role_id == 1)
                                <td><a href="{{route('records.edit', $record->id)}}"><i class="fas fa-cog"></i></a>
                                    <a href="{{route('records.show', $record->id)}}"><i class="fas fa-search"></i></a>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminRecordController@destroy',
                                       $record->id]]) !!}
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
            <div class="d-flex justify-content-center">
                {{$records->links()}}
            </div>

        </div>
    </div>
@stop
