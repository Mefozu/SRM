@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Мои задачи</h1>
        <a href="{{ route('manager.create') }}" class="btn btn-primary mb-3">Создать задачу</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
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
                    <td>{{ $task->due_date->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('manager.show', $task->id) }}" class="btn btn-info">Просмотр</a>
                        <a href="{{ route('manager.edit', $task->id) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('manager.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
