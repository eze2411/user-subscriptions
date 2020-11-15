@extends('layouts.app')

@section('title', 'Búsqueda de usuario')

@section('content')
    <h1>Resultados de la búsqueda</h1>
    <div class="title-bar rounded"></div>
    @if (count($users))
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col">Ultimo login</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $value => $user)
                <tr>
                    <th scope="row">{{$value + 1}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td><a href="{{ route('usuario.login', $user->email) }}" class="btn btn-link p-0">Ver detalles</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No se encontraron usuarios con el parámetro indicado</p>
    @endif
@endsection
