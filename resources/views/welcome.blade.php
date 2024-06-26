<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRM Система</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
<!-- Боковая навигационная панель -->
<div class="sidebar">
    <h2 class="text-center text-white">SRM Система</h2>
    <a href="{{ route('tasks.index') }}">Задачи</a>
    @if(auth()->check() && (auth()->user()->is_admin || auth()->user()->role === 'manager'))
        <a href="{{ route('employees.index') }}">Сотрудники</a>
        <a href="{{ route('departments.index') }}">Отделы</a>
    @endif
    @if(auth()->check() && auth()->user()->role === 'manager')
        <a href="{{ route('manager.reviewTasks') }}">Проверить задачи</a>
    @endif
</div>

<!-- Основной контент -->
<div class="content">
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">SRM Система</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Вход</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ Auth::check() ? route('profile.show', ['id' => Auth::user()->id]) : '#' }}">Профиль</a>
                            @if(Auth::check() && Auth::user()->is_admin)
                                <a class="dropdown-item" href="{{ route('admin.index') }}">Админ панель</a> <!-- Ссылка на админ панель -->
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
