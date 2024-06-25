@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список задач</h1>

        @if(auth()->check() && (auth()->user()->role === 'manager' || auth()->user()->is_admin))
            <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Создать задачу</a>
            <a href="{{ route('tasks.createAdditional') }}" class="btn btn-secondary mb-3">Создать доп. работу</a>
            <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#deleteTaskModal">
                Удалить задачу
            </button>
        @endif
        <!-- Модальное окно -->
        <div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTaskModalLabel">Удалить задачу</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tasks.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="mb-3">
                                <label for="task_id" class="form-label">Выберите задачу для удаления</label>
                                <select class="form-control" id="task_id" name="task_id" required>
                                    @foreach($tasks as $task)
                                        <option value="{{ $task->id }}">{{ $task->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Пользователь</th>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>

                <th scope="col">Отдел</th>
                <th scope="col">Срок выполнения</th>
                <th scope="col">Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->assignedTo ? $task->assignedTo->name : 'Не назначено' }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->department ? $task->department->name : 'Не назначено' }}</td>
                    <td>{{ $task->due_date->format('d.m.Y H:i') }}</td>
                    <td>{{ $task->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
@endsection
