<!DOCTYPE html>
<html lang="en">
@extends('layout.master')

@section('title', 'Total Films Count')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Films Count</title>

    <style>
        body {
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
    </style>
</head>

<body>
    @section('header')
    @parent() @endsection
    @section('content')
    <h1>Total Number of Films: {{ $totalFilms }}</h1>
    @endsection
    @section('footer')
    @parent()
    @endsection
</body>

</html>