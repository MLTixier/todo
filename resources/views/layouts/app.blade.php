<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>TODO</title>
        <!-- Styles, scripts, etc. -->
    </head>
    <body>
        <nav>
            <a id="bouton_courses" href="{{ route('listes.show', ['liste' => 1]) }}">Courses</a>
            <a id="bouton_achats" href="{{ route('listes.show', ['liste' => 2]) }}">Achats</a>
            <a id="bouton_todo" href="{{ route('listes.show', ['liste' => 3]) }}">To do</a>
        </nav>
        @yield('content')
        <!-- Scripts, footer, etc. -->
    </body>
</html>
