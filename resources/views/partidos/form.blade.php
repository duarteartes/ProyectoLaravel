<!DOCTYPE html>
<html>

<head>
    <title>Crear Partido</title>
</head>

<body>
    <!-- Título de la página -->
    <h1>Crear un nuevo Partido</h1>
    <!-- Enviamos los datos a una URL dependiendo de si estamos creando o editando un partido -->
    <form action="{{ isset($partido) ? route('partidos.update', $partido->id) : route('partidos.store') }}" method="POST">
        <!-- Utilizamos esta directiva para evitar ataques -->
        @csrf
        <!-- Si estamos editando un partido utilizamos el método de solicitud PUT en vez del POST -->
        @if(isset($partido))
            @method('PUT')
        @endif
        <!-- Con este campo oculto enviamos la ID de la temporada -->
        <input type="hidden" name="temporada_id" value="{{ $temporada->id ?? '' }}">
        <!-- A partir de aquí comenzamos con el formulario, comentamos solo un bloque -->
        <div>
            <label for="equipo_local">Equipo Local:</label><br>
            <!-- Utilizamos la sintaxis de Blade -->
            <input type="text" id="equipo_local" name="equipo_local" value="{{ old('equipo_local', isset($partido) ? $partido->equipo_local : '') }}">
            <!-- Si hay algún error de validación, se muestran los mensajes de error debajo de los campos -->
            @error('equipo_local')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="equipo_visitante">Equipo Visitante:</label><br>
            <input type="text" id="equipo_visitante" name="equipo_visitante" value="{{ old('equipo_visitante', isset($partido) ? $partido->equipo_visitante : '') }}">
            @error('equipo_visitante')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="goles_local">Goles Equipo Local:</label><br>
            <input type="number" id="goles_local" name="goles_local" value="{{ old('goles_local', isset($partido) ? $partido->goles_local : '') }}">
            @error('goles_local')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="goles_visitante">Goles Equipo Visitante:</label><br>
            <input type="number" id="goles_visitante" name="goles_visitante" value="{{ old('goles_visitante', isset($partido) ? $partido->goles_visitante : '') }}">
            @error('goles_visitante')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="fecha_hora">Fecha y Hora:</label><br>
            <input type="datetime-local" id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora', isset($partido) ? date('Y-m-d\TH:i', strtotime($partido->fecha_hora)) : '') }}">
            @error('fecha_hora')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <!-- Creamos el botón para guardar y enviar los datos del formulario -->
        <button type="submit">Guardar</button>
    </form>
    <!-- Botón de 'Volver' a través del método GET y la acción URL para redirigirnos a una página en concreto -->
    <form method="GET" action="{{ route('temporadas.partidos', $temporada->id) }}">
        <button type="submit">Volver</button>
    </form>
</body>

</html>