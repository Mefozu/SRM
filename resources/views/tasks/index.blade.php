<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список задач</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Создать задачу</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col">Назначено</th>
                <th scope="col">Отдел</th>
                <th scope="col">Срок выполнения</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->assignedTo ? $task->assignedTo->name : 'Не назначено' }}</td>
                    <td>{{ $task->department ? $task->department->name : 'Не назначено' }}</td>
                    <td>{{ $task->due_date->format('d.m.Y H:i') }}</td>
                    <td>
                        <!-- Добавьте кнопки для редактирования и удаления задачи, если необходимо -->
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
