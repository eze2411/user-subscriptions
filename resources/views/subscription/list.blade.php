@extends('layouts.app')

@section('title', 'Listado de suscripciones')

@section('content')
    <h1>Listado de Suscripciones</h1>
    <div class="title-bar rounded"></div>
    @foreach ($subscriptions as $subscription)
        <hr>
        <div class="pt-3 row">
            <div class="col-12 col-sm-4">
                <h2>Equipo #{{$subscription->id}}</h2>
                <p>Usuario que realizo el pago:</p>
                <p><strong>{{$subscription->user->name}}</strong> ({{$subscription->user->email}})</p>
                <h2 class="mt-3">Suscripcion:</h2>
                <p>{{count($subscription->team->users)}} usuarios - ${{$subscription->getMonthlyBillingByUser()}} por mes</p>
                <h2 class="mt-3">Historial de pagos:</h2>
                <ul class="list-group list-group-flush">
                    @foreach ($subscription->billings as $billing)
                        <li class="list-group-item list-group-item-{{$billing->getStateColor()}}">
                            {{$billing->period}} - {{$billing->getStateLabel()}}
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="col-12 col-sm-8 mt-3 mt-md-0">
                <h2>Usuarios en el equipo:</h2>
                <ul class="list-group list-group-flush user-list">
                    @foreach ($subscription->team->users as $team_user)
                        <li class="list-group-item pl @if ($team_user->email == $subscription->user->email)active @endif ">
                            {{$team_user->name}} @if ($team_user->email == $subscription->user->email)(Administrador) @endif
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    @endforeach
@endsection
