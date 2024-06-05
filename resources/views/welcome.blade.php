<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liga de Fútbol Cinco Villas</title>
</head>

<body>
    <!-- Establecemos el título, encabezado y pequeña descripción de la página -->
    <h1>Liga de Fútbol - Cinco Villas</h1>
    <h2>Bienvenido a la Liga de Fútbol de las Cinco Villas</h2>
    <p>Aquí encontrarás el historial con las diferentes temporadas</p>
    <p>Por favor, haz clic en el enlace de abajo para verlas:</p>
    <!-- Con este enlace redirigimos al usuario a la página con las temporadas -->
    <a href="{{ route('temporadas.index') }}">Ver Temporadas</a>
</body>

</html>