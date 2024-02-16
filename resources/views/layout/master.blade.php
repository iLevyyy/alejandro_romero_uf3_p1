<!-- resources/views/master.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your App Title')</title>
    <!-- Add your additional head content here -->

    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            background-color: #444;
            overflow: hidden;
        }

        nav ul li {
            float: left;
            margin-right: 20px;
        }

        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .content {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    @section('header')
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/filmout/films">List Films</a></li>
                <li><a href="/filmout/oldFilms">Old Films</a></li>
                <li><a href="/filmout/newFilms">New Films</a></li>
                <li><a href="/filmout/countFilms">Count Films</a></li>
                <li><a href="/filmout/sortFilms">Sorted Films</a></li>
                <li><a href="/actorout/actors">List Actors</a></li>
                <li><a href="/actorout/countActors">Count Actors</a></li>
                <li><img src="{{asset('img/cara.png')}}" alt="Error al cargar la imagen" srcset=""></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
       
    </header>
    @show
    <!-- Content Section -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer Section -->
    @section('footer')
    <footer>
        <p>&copy; {{ date('Y') }} Practica UF2. Nota de 10 esperada.</p>
    </footer>
    @show
</body>

</html>
