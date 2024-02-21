<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorFilmTable extends Migration
{
    public function up()
    {
        Schema::create('actor_film', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actor_id');
            $table->unsignedBigInteger('film_id');
            // Otras columnas que puedas necesitar

            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actor_film');
    }
}
