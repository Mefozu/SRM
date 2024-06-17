@extends('layouts.app')

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
