<!DOCTYPE html>
<html>

<head>
    <title>Editar Partido</title>
</head>

<body>
    <!-- Título de la página -->
    <h1>Editar Partido</h1>
    <!-- Verificamos si ha errores de validación, si los hay los muestra listados -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Enviamos los datos a la ruta para actualizar un partido utilizando el método PUT -->
    <!-- Proporciona los IDs de temporada y partido como parámetros en la URL -->
    <form action="{{ route('partidos.update', ['temporada_id' => $temporada->id, 'partido_id' => $partido->id]) }}" method="POST">
        <!-- Utilizamos esta directiva para evitar ataques -->
        @csrf
        @method('PUT')
        <!-- Con este campo oculto enviamos la ID de la temporada -->
        <input type="hidden" name="temporada_id" value="{{ $temporada->id }}">
        <!-- Mostramos los campos de entrada para editar los detalles de un partido -->
        <label for="equipo_local">Equipo Local:</label><br>
        <!-- Establecemos los valores y detalles de un partido utilizando la función 'old' -->
        <input type="text" id="equipo_local" name="equipo_local" value="{{ old('equipo_local', $partido->equipo_local) }}"><br>
        <label for="equipo_visitante">Equipo Visitante:</label><br>
        <input type="text" id="equipo_visitante" name="equipo_visitante" value="{{ old('equipo_visitante', $partido->equipo_visitante) }}"><br>
        <label for="goles_local">Goles Equipo Local:</label><br>
        <input type="number" id="goles_local" name="goles_local" value="{{ old('goles_local', $partido->goles_local) }}"><br>
        <label for="goles_visitante">Goles Equipo Visitante:</label><br>
        <input type="number" id="goles_visitante" name="goles_visitante" value="{{ old('goles_visitante', $partido->goles_visitante) }}"><br>
        <label for="fecha_hora">Fecha y Hora:</label><br>
        <input type="datetime-local" id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora', date('Y-m-d\TH:i', strtotime($partido->fecha_hora))) }}"><br>
        <!-- Creamos el botón para guardar y enviar los datos del formulario -->
        <button type="submit">Guardar</button>
    </form>
    <!-- Botón de 'Volver' a través del método GET y la acción URL para redirigirnos a una página en concreto -->
    <form method="GET" action="{{ route('temporadas.partidos', $temporada->id) }}">
        <button type="submit">Volver</button>
    </form>
</body>

</html>