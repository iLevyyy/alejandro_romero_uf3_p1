<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Film;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array
    {
        $filmsJSON = Storage::json('/public/films.json');
        //$filmsDB = json_decode(json_encode(DB::table('films')->get()), true);
        $filmsDB = json_decode(json_encode(Film::all()), true);
        $allFilms = array_merge($filmsJSON, $filmsDB);
        //dd($allFilms);

        return $allFilms;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */



    public function listFilmsByYear($year)
    {
        return $this->listFilms($year, null);
    }

    public function listFilmsByGenre($genre)
    {
        return $this->listFilms(null, $genre);
    }
    public function sortFilmsByYear()
    {
        $title = "Listado de todas las pelis ordenadas por año (de más nuevo a más antiguo)";
        $films = FilmController::readFilms();

        // Sort films by year in descending order
        usort($films, function ($a, $b) {
            return $b['year'] - $a['year'];
        });

        return view("films.list", ["films" => $films, "title" => $title]);
    }
    // public function countFilms()
    // {
    //     $films = FilmController::readFilms();
    //     $totalFilms = count($films);

    //     return view("films.count", ["totalFilms" => $totalFilms]);
    // }
    public function countFilms()
    {
        $totalFilms = Film::count();

        return view("films.count", ["totalFilms" => $totalFilms]);
    }

    public function createFilm(Request $request)
    {
        $film = $request->all();
        $source = env('DATA_SOURCE', 'database');

        if (!FilmController::isFilm($film['name'])) {
            unset($film['_token']);
            if ($source != 'database' || $source != 'Database') {
                $films = FilmController::readFilms();
                $films[] = $film;

                $films = json_encode($films);
                Storage::put('/public/films.json', $films);
            } else {
                //DB::table('films')->insert($film);
                Film::insert($film);
            }
            return FilmController::listFilms();
        } else {
            return redirect('/')->with('error', 'La pelicula ya esta registrada');
        }
    }
    public function isFilm($name): bool
    {
        $films = FilmController::readFilms();
        foreach ($films as $film) {
            if ($film['name'] == $name) {
                return true;
            }
        }
        return false;
    }
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            } else if ((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            } else if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
}
