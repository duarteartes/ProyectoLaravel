<?php

// Importamos las clases necesarias para hacer la migración de la base de datos
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Definimos la clase que extiende migration
class CreatePartidosTable extends Migration
{
    // Definimos las acciones que se deben realizar cuando ejecutamos la migración
    public function up(): void
    {
        // Creamos una nueva tabla llamada partidos y definimos su estructura utilizando un objeto Blueprint
        Schema::create('partidos', function (Blueprint $table) {
            // Definimos todos los campos que va a tener la tabla, en este caso 7
            $table->id('partido_id');
            $table->unsignedBigInteger('temporada_id');
            $table->string('equipo_local');
            $table->string('equipo_visitante');
            $table->integer('goles_local');
            $table->integer('goles_visitante');
            $table->dateTime('fecha_hora');
            // Se añaden automáticamente los campos que gestionarán marcas de tiempo de creación y actualización
            $table->timestamps();
            // Definimos la FK que referenciará al campo temporada_id de la tabla temporadas
            // Utilizamos onDelete para eliminar todos los partidos de una temporada, si ésta se borra
            $table->foreign('temporada_id')->references('temporada_id')->on('temporadas')->onDelete('cascade');
        });
    }
    // Definimos las acciones que se deben realizar cuando se deshace la migración
    public function down(): void
    {
        // Eliminamos la tabla partidos, si existe
        Schema::dropIfExists('partidos');
    }
}