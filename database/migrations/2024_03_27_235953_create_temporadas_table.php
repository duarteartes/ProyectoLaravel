<?php

// Importamos las clases necesarias para hacer la migración de la base de datos
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Definimos la clase que extiende migration
return new class extends Migration
{
    // Definimos las acciones que se deben realizar cuando ejecutamos la migración
    public function up(): void
    {
        // Creamos una nueva tabla llamada temporadas y definimos su estructura utilizando un objeto Blueprint
        Schema::create('temporadas', function (Blueprint $table) {
            // Definimos todos los campos que va a tener la tabla, en este caso 3
            $table->id('temporada_id');
            $table->integer('anio_inicio');
            $table->integer('anio_fin');
            // Se añaden automáticamente los campos que gestionarán marcas de tiempo de creación y actualización
            $table->timestamps();
        });

        // Insertamos los datos en la tabla temporadas
        DB::table('temporadas')->insert([
            ['anio_inicio' => 2021, 'anio_fin' => 2022],
            ['anio_inicio' => 2022, 'anio_fin' => 2023],
            ['anio_inicio' => 2023, 'anio_fin' => 2024],
        ]);
    }
    // Definimos las acciones que se deben realizar cuando se deshace la migración
    public function down(): void
    {
        // Eliminamos la tabla temporadas, si existe
        Schema::dropIfExists('temporadas');
    }
};
