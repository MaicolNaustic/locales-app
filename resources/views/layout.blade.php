<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Locales App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/locales">Locales App</a>
    </div>
</nav>

<div class="container mt-4">
    @yield('contenido')
</div>

</body>
</html>