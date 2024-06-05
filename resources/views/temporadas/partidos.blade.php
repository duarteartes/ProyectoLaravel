<!DOCTYPE html>
<html>

<head>
    <title>Partidos de la Temporada</title>
    <style>
        .bold {
            font-weight: bold;
        }
        .details {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <!-- Título de la página con la temporada concreta que estamos mostrando -->
    <h1>Partidos de la Temporada {{ $temporada->anio_inicio }} - {{ $temporada->anio_fin }}</h1>
    <!-- Mostramos un mensaje de éxito si los partidos se han creado actualizado o borrado correctamente -->
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif
    <!-- Utilizamos un bucle para mostrar el listado de partidos que contiene la temporada -->
    <ul>
        @foreach($partidos as $partido)
            <!-- Creamos un elemento para mostrar los detalles de cada partido -->
            <li>
                <span class="bold">{{ $partido->equipo_local }} vs {{ $partido->equipo_visitante }}</span><br>
                <div class="details">
                    <p>+ Goles Local: {{ $partido->goles_local }}</p>
                    <p>+ Goles Visitante: {{ $partido->goles_visitante }}</p>
                    <p>+ Fecha y hora: {{ $partido->fecha_hora }}</p>
                </div>
                <!-- Botón para eliminar un partido a través de una solicitud DELETE pasando el ID del partido -->
                <form action="{{ route('partidos.destroy', $partido->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
                <!-- Botón para editar un partido a través de una solicitud GET pasando los IDs de temporada y partido -->
                <form action="{{ route('partidos.edit', ['temporada_id' => $temporada->id, 'partido_id' => $partido->id]) }}" method="GET" style="display: inline;">
                    <button type="submit">Editar</button>
                </form>
            </li>
        @endforeach
    </ul>
    <!-- Botón para añadir un partido nuevo a través de una solicitud GET pasando el ID de temporada -->
    <form method="GET" action="{{ route('partidos.create', $temporada->id) }}">
        <button type="submit">Agregar Partido</button>
    </form>
    <!-- Botón de 'Volver' a través del método GET y la acción URL para redirigirnos a una página en concreto -->
    <form method="GET" action="{{ route('temporadas.index') }}">
        <button type="submit">Volver</button>
    </form>
</body>

</html>