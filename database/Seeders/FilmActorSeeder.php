<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Obtener todas las películas y actores existentes
        $movies = DB::table('films')->pluck('id');
        $actors = DB::table('actors')->pluck('id');

        foreach ($movies as $movie) {
            // Relacionar cada película con 1 a 3 actores de forma aleatoria
            $actorsForMovie = $faker->randomElements($actors, $faker->numberBetween(1, 3));

            // Insertar las relaciones en la tabla pivot
            foreach ($actorsForMovie as $actor) {
                DB::table('films_actors')->insert([
                    'film_id' => $movie,
                    'actor_id' => $actor,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
