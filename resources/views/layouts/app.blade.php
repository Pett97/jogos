<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Api Jogos</title>
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper teal darken-1">   
                <a href="#" class="brand-logo center">Api Jogos</a>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    @vite('resources/js/app.js')
</body>

</html>