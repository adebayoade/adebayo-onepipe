@extends('layout')

@section('content')
    <div class="container" style="max-width: 1000px">
        <h1 class="mt-5 col-sm-mt-5 text-white">Weather Today</h1>
        @include('form')
        <p class="mt-5 footer text-center text-white">
            Designed by
            <a class="text-white text-decoration-none" href="http://adebayoade.com">Adebayo Ade</a>
        </p>
    </div>
@endsection
