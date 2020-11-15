@extends('layouts.app')

@section('title', 'Búsqueda de usuario')

@section('content')
    <h1>Búsqueda de Usuario</h1>
    <div class="title-bar rounded"></div>

    <form method="POST" action="{{ route('usuario.busqueda') }}">
    @csrf <!-- {{ csrf_field() }} -->
        <div class="form-group">
            <label for="userInput">Nombre</label>
            <input id="userInput" name="userInput" type="text" class="form-control w-50" aria-describedby="inputHelp" placeholder="ej. Juan Perez" />
            <small id="inputHelp" class="form-text text-muted">Ingrese un usuario para ver en que provincia utilizo la aplicacion por ultima vez</small>
        </div>
        <input class="btn btn-aw mt-3" type="submit" value="Buscar">
    </form>
@endsection
