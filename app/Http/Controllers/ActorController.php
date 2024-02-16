<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Actor; // Asegúrate de importar el modelo Actor correspondiente

class ActorController extends Controller
{
    public function listActors(Request $request)
    {
        $actors_filtered = [];
        $title = "Listado de todos los actores";
        $actors = $this->readActors();

        // Obtener el valor de year desde la solicitud
        $year = $request->input('year');

        // Si year no está presente en la solicitud, se establece como null
        if (is_null($year)) {
            return view('actors.list', ["actors" => $actors, "title" => $title]);
        }

        // Listar según la década informada
        // foreach ($actors as $actor) {
        //     if (!is_null($actor['birthdate']) && $this->decadeMatches($actor['birthdate'], $year)) {
        //         $title = "Listado de todos los actores filtrados por década ".$year;
        //         $actors_filtered[] = $actor;
        //     }
        // }


        return view("actors.list", ["actors" => $actors_filtered, "title" => $title]);
    }
    public function listActorsByDecade(Request $request)
    {
        // Obtener el valor de year desde la solicitud
        $year = $request->input('year');
        $actors_filtered = [];
        $title = "Listado de todos los actores filtrados por la década del " . $year;
        $actors = $this->readActors();



        // Si year no está presente en la solicitud, se establece como null
        if (is_null($year)) {
            return view('actors.list', ["actors" => $actors, "title" => $title]);
        }

        // Listar según la década informada
        foreach ($actors as $actor) {
            if (!is_null($actor['birthdate']) && $this->decadeMatches($actor['birthdate'], $year)) {

                $actors_filtered[] = $actor;
            }
        }

        return view("actors.list", ["actors" => $actors_filtered, "title" => $title]);
    }


    public function readActors()
    {
        // Utilizar el Query Builder para obtener solo las columnas deseadas de la tabla actors
        $actors = DB::table('actors')->select('name', 'surname', 'birthdate', 'country', 'img_url')->get();

        // Convertir los resultados a un array para que sean más fáciles de manejar en la vista
        $actorsArray = json_decode(json_encode($actors), true);

        return $actorsArray;
    }


    public function countActors()
    {
        $actors = ActorController::readActors();
        $totalActors = count($actors);

        return view("actors.count", ["totalActors" => $totalActors]);
    }

    /**
     * Elimina un actor por su ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteActor($id)
    {
        $delete =  DB::table('actors')->where('id', $id)->delete();
        if ($delete) {
            return response()->json(['action' => $delete, "status" => "true"]);
        } else {
            return response()->json(['action' => $delete, "status" => "false"]);
        }
    }

    // Función auxiliar para verificar si un año pertenece a una década
    private function decadeMatches($year, $decade)
    {
        $startYear = $decade;
        $endYear = $decade + 9;

        return $year >= $startYear && $year <= $endYear;
    }
}
