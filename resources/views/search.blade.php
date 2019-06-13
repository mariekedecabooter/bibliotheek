@extends('layouts.front')
@section('content')
    <div class="row">
        <div class="card col-6 offset-3 my-2">
            <div class="card-body">
                {!! Form::open(['method'=>'GET', 'action'=> 'FrontController@search']) !!}

                <div class="form-group">
                    {!! Form::text('search', null, ['class'=>'form-control']) !!}
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <div class="form-group mr-2">
                        {!! Form::label('searchOn', 'Zoek op') !!}
                        {!! Form::select('searchOn', array('author' => 'auteur', 'titel' => 'Titel', 'beschrijving' => 'Beschrijving'))!!}

                    </div>
                    <div class="form-group">
                        {!! Form::submit('Search', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @if (isset($authors) || isset($results))

        <table class="table table-striped border">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titel</th>
                <th scope="col">Auteur</th>
                <th scope="col">ISBN</th>
                <th scope="col">Jaartal</th>
                <th scope="col">Uitgave</th>
                <th scope="col">Beschrijving</th>
                <th scope="col">Aantal</th>
            </tr>
            </thead>
            <tbody>
            @if (isset($authors))
                @foreach($authors as $author)
                    @foreach(($records->where('auteur_id','=', $author->id)) as $record)
                        <tr>
                            <td>{{$record->id}}</td>
                            <td><a href="record/{{$record->id}}">{{$record->titel}}</a></td>
                            <td>{{$record->author->name}}</td>
                            <td>{{$record->isbn}}</td>
                            <td>{{$record->jaartal}}</td>
                            <td>{{$record->uitgave}}</td>
                            <td>{{$record->beschrijving}}</td>
                            <td>{{$record->aantal}}</td>
                        </tr>
                    @endforeach
                @endforeach
            @else
                @foreach(($results) as $record)
                    <tr>
                        <td>{{$record->id}}</td>
                        <td>{{$record->titel}}</td>
                        <td>{{$record->author->name}}</td>
                        <td>{{$record->isbn}}</td>
                        <td>{{$record->jaartal}}</td>
                        <td>{{$record->uitgave}}</td>
                        <td>{{$record->beschrijving}}</td>
                        <td>{{$record->aantal}}</td>
                    </tr>
                @endforeach

            @endif
            </tbody>
        </table>

    @endif
@stop
