<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-image: url('background_weather.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;

    }

    .footer a:hover {
        text-decoration: underline !important;
    }
</style>

<body>
@show
@yield('content')
</body>

</html>
