@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('Задачи на проверку') }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($tasks && count($tasks) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название</th>
                    <th scope="col">Создатель</th>
                    <th scope="col">Дедлайн</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->creator->name }}</td>
                        <td>{{ $task->due_date->format('d.m.Y H:i') }}</td>
                        <td>{{ $task->status }}</td>
                        <td>
                            <form action="{{ route('tasks.approve', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Одобрить</button>
                            </form>

                            <!-- Кнопка для отклонения задачи, вызывает модальное окно -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal" data-task-id="{{ $task->id }}">
                                Отклонить
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>{{ __('Нет задач на проверку') }}</p>
        @endif
    </div>

    <!-- Модальное окно для отклонения задачи -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Отклонить задачу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="reason" class="form-label">Причина отклонения</label>
                            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-danger">Отклонить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Скрипт для установки ID задачи в форму отклонения -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var rejectModal = document.getElementById('rejectModal');
            rejectModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var taskId = button.getAttribute('data-task-id');
                var form = document.getElementById('rejectForm');
                form.action = '/tasks/' + taskId + '/reject';
            });
        });
    </script>
@endsection
