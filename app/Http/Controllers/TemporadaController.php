<?php

// Declaramos el espacio de nombres al que pertenece el archivo
namespace App\Http\Controllers;
// Importamos las clases necesarias. La clase Request se utiliza para manejar solicitudes HTTP entrantes
use App\Models\Temporada;
use Illuminate\Http\Request;

// Definimos la clase que extiende de controller
class TemporadaController extends Controller
{
    // Definimos el método para manejar las solicitudes de temporadas
    public function index()
    {
        // Obtenemos todas las temporadas de la BBDD con 'all'
        $temporadas = Temporada::all();
        // Pasamos las temporadas a la vista index utilizando 'view' y con 'compact' pasamos la variable
        return view('temporadas.index', compact('temporadas'));
    }
    // Definimos el método para manejar las solicitudes de partidos
    public function show($id)
    {
        // Recibe el parámetro del id de la temporada que queremos mostrar con 'findOrFail'
        $temporada = Temporada::findOrFail($id);
        // Obtenemos los partidos de la temporada seleccionada y los ordenamos de forma ascendente
        $partidos = $temporada->partidos()->orderBy('fecha_hora', 'asc')->get();
        // Pasamos la información a la vista de partidos utilizando 'view' y con 'compact' pasamos las variables
        return view('temporadas.partidos', compact('temporada', 'partidos'));
    }
}