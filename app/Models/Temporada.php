<?php

// Declaramos el espacio de nombres al que pertenece el archivo
namespace App\Models;
// Importamos la clase model de Eloquent para que heredemos todas sus funcionalidades
use Illuminate\Database\Eloquent\Model;

// Definimos la clase temporada que extiende de la clase model
class Temporada extends Model
{
    // Definimos qué atributos pueden ser asignados masivamente utilizando la función create
    protected $fillable = ['inicio', 'fin'];
    // Creamos un método de relación de 1:N con el modelo partido
    public function partidos()
    {
        // Utilizamos el método hasMany para definir que una temporada puede tener muchos partidos asociados
        return $this->hasMany('App\Models\Partido');
    }
}