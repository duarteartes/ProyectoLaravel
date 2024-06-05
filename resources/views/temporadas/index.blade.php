<!DOCTYPE html>
<html>

<head>
    <title>Temporadas</title>
</head>

<body>
    <!-- Título y encabezado de la página -->
    <h1>Temporadas - Liga de Fútbol Cinco Villas</h1>
    <p>Aquí puedes consultar todas las temporadas que ha tenido nuestra Liga</p>
    <!-- Utilizamos un bucle para mostrar el listado de las temporadas -->
    <ul>
        @foreach($temporadas as $temporada)
            <!-- Creamos un enlace para redirigirnos a la página de cada temporada con el listado de partidos -->
            <li><a href="{{ route('temporadas.partidos', $temporada->id) }}">{{ $temporada->anio_inicio }} - {{ $temporada->anio_fin }}</a></li>
        @endforeach
    </ul>
    <!-- Botón de 'Volver' a través del método GET y la acción URL para redirigirnos a una página en concreto -->
    <form method="GET" action="{{ url('/') }}">
        <button type="submit">Volver</button>
    </form>
</body>

</html>