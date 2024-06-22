@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Профиль</div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <p><strong>Имя:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Паспорт:</strong> {{ Auth::id() === $user->id ? $user->passport : 'Скрыто' }}</p>
                <p><strong>Отдел:</strong> {{ $user->department }}</p>
                <p><strong>Должность:</strong> {{ $user->position }}</p>
                <p><strong>Должностные обязанности:</strong> {{ $user->responsibilities }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Редактировать</a>
            </div>
        </div>
    </div>
@endsection
