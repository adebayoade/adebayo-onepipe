@php
    use Carbon\Carbon;

    $getDate = Carbon::now();

@endphp

@extends('welcome')

@section('content')
    <div class="col-sm-12 col-md-5 shadow-lg p-5 weather">
        <div v-if="data" class="d-flex justify-content-between">
            <div>
                <h1>{{ $data['name'] }}</h1>
                <h2>{{ $data['main']['temp'] }} &deg;C</h2>
                <p>{{ $data['weather'][0]['description'] }}</p>
                <p>{{ $data['sys']['country'] }}</p>
                <p>{{ $getDate }}</p>
            </div>
            <div id="icon"><img id="wicon" width="80"
                    src="http://openweathermap.org/img/w/{{ $data['weather'][0]['icon'] }}.png" alt="Weather icon" />
            </div>
        </div>
    </div>
@endsection
