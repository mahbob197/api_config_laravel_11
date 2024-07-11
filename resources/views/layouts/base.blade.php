<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Ajoutez ici d'autres liens de style ou scripts nécessaires -->
</head>
<body>
    <nav>
        <!-- Barre de navigation -->
        <ul>
            <li><a href="{{ route('posts.index') }}">Home</a></li>
            <li><a href="{{ route('posts.create') }}">Create Post</a></li>
        </ul>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <footer>
        <!-- Pied de page -->
        <p>&copy; 2024 Laravel CRUD Application</p>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Ajoutez ici d'autres scripts nécessaires -->
</body>
</html>
