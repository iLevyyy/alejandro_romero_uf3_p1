<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE films ADD COLUMN rating VARCHAR(45)');
        // Ajusta la precisión y escala según tus necesidades
        // El método AFTER coloca el nuevo campo después de una columna existente
        // Obtener una instancia de Faker
        $faker = Faker::create();

        // Obtener todos los registros de la tabla films
        $films = DB::table('films')->get();

        // Iterar sobre los registros y actualizar la columna 'rating' con valores aleatorios
        foreach ($films as $film) {
            $randomRating = $faker->randomElement(['G', 'PG', 'PG-13', 'R', 'NC-17']);
            DB::table('films')->where('id', $film->id)->update(['rating' => $randomRating]);
        }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE films DROP COLUMN rating');
    }
};
