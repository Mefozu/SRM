<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRM Система</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .navbar-light .navbar-nav .nav-link {
            color: rgba(0, 0, 0, 0.5);
        }
        .navbar-light .navbar-nav .nav-link:hover {
            color: rgba(0, 0, 0, 0.7);
        }
        .navbar-light .navbar-nav .nav-link.active {
            color: rgba(0, 0, 0, 0.9);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2 class="text-center text-white">SRM Система</h2>
    <a href="{{ route('employees.index') }}">Сотрудники</a>
    <a href="#">Задачи</a>
    <a href="{{ route('departments.index') }}">Отделы</a>
    <a href="#">Задачи</a>
<<<<<<< Updated upstream
=======
    @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'manager'))
        <li class="menu-item">
            <a href="{{ route('employees.index') }}">Сотрудники</a>
        </li>
        <li class="menu-item">
            <a href="{{ route('departments.index') }}">Отделы</a>
        </li>
    @endif
>>>>>>> Stashed changes
</div>

<!-- Основной контент -->
<div class="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">SRM Система</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <!-- Элементы для гостей -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Вход</a>
                    </li>
                @else
                    <!-- Элементы для аутентифицированных пользователей -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.show') }}">Профиль</a> <!-- Ссылка на профиль -->
                            @if(Auth::user()->is_admin)
                                <a class="dropdown-item" href="{{ route('admin.index') }}"><br>Админ панель</a> <!-- Ссылка на админ панель -->
                            @endif
                            <div class="dropdown-divider"></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Выйти
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Здесь будет содержимое выбранного раздела -->
        <h1>Добро пожаловать в SRM Систему!</h1>
        <p>Выберите нужный раздел в навигационном меню.</p>
    </div>
</div>

<!-- Подключаем скрипты Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>
</html>
