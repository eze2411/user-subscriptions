@extends('layouts.app')

@section('title', 'Detalle de usuario')

@section('content')
    <h1>Detalle de login</h1>
    <div class="title-bar rounded"></div>
    <h3>Usuario</h3>
    <p>{{$user->name}}</p>
    <p></p>
    <h3>Ultimo inicio de sesion</h3>
    @if ($user->getLastLoginDate())
        <p>{{$user->getLastLoginDate()}}</p>
    @else
        <p>El usuario no ha iniciado sesión por el momento</p>
    @endif

    <h3>Ubicacion</h3>
    <p>{{$location}}</p>
    <div id="map-canvas" style="width: 500px; height: 450px;">
    </div>
@endsection

@if($user->getLastLoginDate())
@section('footer')
    <script type="text/javascript">
        var map;
        function initialize() {
            var latitude = "{{ $user->logins[0]->latitude }}";
            var longitude = "{{ $user->logins[0]->longitude }}";
            var mapOptions = {
                zoom: 13,
                center: new google.maps.LatLng(latitude,longitude),
            };

            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var myLatlng = new google.maps.LatLng(latitude, longitude);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'Ultimo login realizado'
            });
        }

        function loadScript() {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBCHmAbrq2Z-YNVEPmmhbfGJlPTE2MUids&callback=initialize';
            document.body.appendChild(script);
        }

        window.onload = loadScript;
    </script>
@endsection
@endif
