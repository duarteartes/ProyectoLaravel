<?php

// Declaramos el espacio de nombres al que pertenece el archivo
namespace App\Models;
// Importamos la clase model de Eloquent para que heredemos todas sus funcionalidades
use Illuminate\Database\Eloquent\Model;

// Definimos la clase partido que extiende de la clase model
class Partido extends Model
{
    // Definimos qué atributos pueden ser asignados masivamente utilizando la función create
    protected $fillable = ['equipo_local', 'equipo_visitante', 'goles_local', 'goles_visitante', 'fecha_hora'];
    // Creamos un método de relación de N:1 con el modelo temporada
    public function temporada()
    {
        // Utilizamos el método hasMany para definir que una temporada puede tener muchos partidos asociados
        return $this->belongsTo('App\Models\Temporada');
    }
}