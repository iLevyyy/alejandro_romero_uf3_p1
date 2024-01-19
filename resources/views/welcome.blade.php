<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout.master')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include any additional stylesheets or scripts here -->
    <style>
        body {
            padding-top: 5rem;
        }

        form {
            max-width: 600px;
            margin: auto;
        }
        .list-unstyled{
            text-align: center;
        }
    </style>
</head>
@section('content')

<body class="container">

    <h1 class="mt-4" style="text-align: center;">Lista de Películas</h1>


    @if(session('error'))
    <div class="alert alert-danger mt-4" style="text-align: center;">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('createFilm') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="year">Año:</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>

        <div class="form-group">
            <label for="genre">Género:</label>
            <input type="text" class="form-control" id="genre" name="genre" required>
        </div>

        <div class="form-group">
            <label for="img_url">URL de la Imagen:</label>
            <input type="text" class="form-control" id="img_url" name="img_url" required>
        </div>

        <div class="form-group">
            <label for="country">País:</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>

        <div class="form-group">
            <label for="duration">Duración (minutos):</label>
            <input type="number" class="form-control" id="duration" name="duration" required>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

</body>
@endsection

</html>