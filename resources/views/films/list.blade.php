@extends('layout.master')

@section('title', $title)

@section('content')
    {{-- Contenido de list.blade.php --}}
    <h1 class="mt-4">{{$title}}</h1>

    @if(empty($films))
        <p class="text-danger">No se ha encontrado ninguna película</p>
    @else
        {{-- Tu tabla de películas --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                {{-- Encabezados de la tabla --}}
                <thead class="thead-dark">
                    <tr>
                        @foreach($films[0] as $key => $value)
                            <th>{{$key}}</th>
                        @endforeach
                    </tr>
                </thead>

                {{-- Cuerpo de la tabla --}}
                <tbody>
                    @foreach($films as $film)
                        <tr>
                            <td>{{$film['name']}}</td>
                            <td>{{$film['year']}}</td>
                            <td>{{$film['genre']}}</td>
                            <td><img src="{{$film['img_url']}}" alt="{{$film['name']}}" style="width: 100px; height: 120px;"></td>
                            <td>{{$film['country']}}</td>
                            <td>{{$film['duration']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

<!-- Add Bootstrap CSS link -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
