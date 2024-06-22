@extends('layouts.app')

@section('content')
    <div class="container">
<<<<<<< Updated upstream
        <h1>Отделы</h1>
        <ul>
=======
        <h1>Список отделов</h1>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="mb-3">
                <a href="{{ route('departments.create') }}" class="btn btn-primary">Создать отдел</a>
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
>>>>>>> Stashed changes
            @foreach($departments as $department)
                <li><a href="{{ route('departments.show', $department->id) }}">{{ $department->name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
