<?php

// Importamos los controladores
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\PartidoController;

// Definimos una ruta GET para la raíz, devolviendo la vista welcome
Route::get('/', function () {
    return view('welcome');
});

// Asignamos un nombre a cada ruta utilizando el método name. Definimos una ruta GET/POST/PUT/DELETE para cada URL
// Utilizamos GET para solicitar los datos al servidor
// Utilizamos POST para enviar los datos al servidor
// Utilizamos PUT para actualizar los datos en el servidor
// Utilizamos DELETE para eliminar un recurso en el servidor

// Definimos una ruta que llama al método index de temporadaController
Route::get('/temporadas', [TemporadaController::class, 'index'])->name('temporadas.index');
// Definimos una ruta en la que la parte {id} es un marcador de posición para el ID de la temporada
// Esta ruta llama al método show de temporadaController
Route::get('/temporadas/{id}/partidos', [TemporadaController::class, 'show'])->name('temporadas.partidos');
// Definimos una ruta en la que la parte {temporada_id} es un marcador de posición para el ID de la temporada
// Esta ruta llama al método create de partidoController
Route::get('/partidos/{temporada_id}/create', [PartidoController::class, 'create'])->name('partidos.create');
// Definimos esta ruta para que cuando se envíe un formulario a esta URL, se llame al método store de partidoController
Route::post('/partidos', [PartidoController::class, 'store'])->name('partidos.store');
// Definimos una ruta en la que la parte {temporada_id} y {partido_id} son marcadores de posición
// Esta ruta llama al método edit del controlador partidoController
Route::get('/partidos/{temporada_id}/{partido_id}/edit', [PartidoController::class, 'edit'])->name('partidos.edit');
// Definimos esta ruta para que cuando se envíe una solicitud se llame al método update de partidoController
Route::put('/partidos/{temporada_id}/{partido_id}', [PartidoController::class, 'update'])->name('partidos.update');
// Definimos esta ruta para que cuando se envíe una solicitud se llame al método destroy de partidoController
Route::delete('/partidos/{partido}', [PartidoController::class, 'destroy'])->name('partidos.destroy');