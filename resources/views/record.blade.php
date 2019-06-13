@extends('layouts.front')
@section('title',$record->titel)

@section('content')
    <h1>{{$record->titel}}</h1>
    <img src="{{$record->foto}}" alt="">
    <table class="table table-striped border">
        <tbody>
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

        </tbody>
    </table>

@stop
