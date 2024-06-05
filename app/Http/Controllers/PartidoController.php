<?php

// Declaramos el espacio de nombres al que pertenece el archivo
namespace App\Http\Controllers;
// Importamos las clases necesarias. La clase Request se utiliza para manejar solicitudes HTTP entrantes
// La clase Redirect se utiliza para redirigir a diferentes rutas y con Validator validamos los datos de entrada
use App\Models\Temporada;
use App\Models\Partido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

// Definimos la clase que extiende de controller
class PartidoController extends Controller
{
    // Definimos este método para mostrar el formulario donde crearemos un partido nuevo
    public function create($temporada_id)
    {
        // Recibe el id de la temporada a la que se asociará el nuevo partido por parámetro utilizando 'findOrFail'
        $temporada = Temporada::findOrFail($temporada_id);
        // Se devuelve la vista form y se pasa la variable a la vista
        return view('partidos.form', compact('temporada'));
    }
    // Definimos este método con la lógica para guardar un nuevo partido en la BBDD
    public function store(Request $request, Temporada $temporada)
    {
        // Validamos los datos del formulario
        $validator = Validator::make($request->all(), [
            'equipo_local' => 'required|string|max:255',
            'equipo_visitante' => 'required|string|max:255',
            'goles_local' => 'required|integer|min:0',
            'goles_visitante' => 'required|integer|min:0',
            'fecha_hora' => 'required|date',
        ]);
        // Si la validación falla, se redirige al formulario
        if ($validator->fails()) {
            // Nos redirigirá con los errores de la validación y los datos de entrada anteriores
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Si la validación es correcta se crea un nuevo objeto Partido
        $temporada_id = $request->temporada_id;
        $partido = new Partido([
            'equipo_local' => $request->equipo_local,
            'equipo_visitante' => $request->equipo_visitante,
            'goles_local' => $request->goles_local,
            'goles_visitante' => $request->goles_visitante,
            'fecha_hora' => $request->fecha_hora,
        ]);
        $temporada = Temporada::findOrFail($temporada_id);
        // Guardamos el partido en la BBDD con la temporada correspondiente
        $temporada->partidos()->save($partido);
        // Redirigimos a la página de la temporada mostrando los partidos y un mensaje de éxito al usuario
        return redirect()->to("/temporadas/{$temporada->id}/partidos")->with('success', 'Partido creado correctamente.');
    }
    // Definimos este método con la lógica para mostrar el fomulario de edición de un partido
    // Recibe por parámetros los IDs de temporada y el partido que queremos modificar
    public function edit($temporada_id, $partido_id)
    {
        // Buscamos los registros correspondientes utilizando 'findOrFail'
        $temporada = Temporada::findOrFail($temporada_id);
        $partido = Partido::findOrFail($partido_id);
        // Devolvemos la vista editForm pasando las variables a la vista
        return view('partidos.editForm', compact('temporada', 'partido'));
    }
    // Definimos este método con la lógica para actualizar un partido en la BBDD
    public function update(Request $request, $temporada_id, $partido_id)
    {
        // Validamos los datos del formulario
        $validator = Validator::make($request->all(), [
            'equipo_local' => 'required|string|max:255',
            'equipo_visitante' => 'required|string|max:255',
            'goles_local' => 'required|integer|min:0',
            'goles_visitante' => 'required|integer|min:0',
            'fecha_hora' => 'required|date',
        ]);
        // Si la validación falla, se redirige al formulario
        if ($validator->fails()) {
            // Nos redirigirá con los errores de la validación y los datos de entrada anteriores
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Si la validación es correcta se actualiza el objeto Partido con los nuevos datos en la BBDD
        $temporada = Temporada::findOrFail($temporada_id);
        $partido = Partido::findOrFail($partido_id);
        $partido->update([
            'equipo_local' => $request->equipo_local,
            'equipo_visitante' => $request->equipo_visitante,
            'goles_local' => $request->goles_local,
            'goles_visitante' => $request->goles_visitante,
            'fecha_hora' => $request->fecha_hora,
        ]);
        // Redirigimos a la página de la temporada mostrando los partidos y un mensaje de éxito al usuario
        return redirect()->route('temporadas.partidos', ['id' => $temporada->id])->with('success', 'Partido actualizado correctamente.');
    }
    // Definimos este método con la lógica para eliminar un partido existente en la BBDD. Recibe un objeto Partido
    public function destroy(Partido $partido)
    {
        // Se obtiene la ID de la temporada asociada y se elimina el partido de la BBDD
        $temporada_id = $partido->temporada->id;
        $partido->delete();
        // Redirigimos a la página de la temporada mostrando los partidos y un mensaje de éxito al usuario
        return redirect()->route('temporadas.partidos', ['id' => $temporada_id])->with('success', 'Partido eliminado correctamente.');
    }
}