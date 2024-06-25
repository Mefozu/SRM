@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Создать новую задачу</h1>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="due_date" class="form-label">Срок выполнения</label>
                <input type="datetime-local" class="form-control" id="due_date" name="due_date" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Назначить задачу</label>
                <div>
                    <input type="radio" id="assign_to_user" name="assign_to" value="user" checked>
                    <label for="assign_to_user">Конкретному пользователю</label>
                </div>
                <div>
                    <input type="radio" id="assign_to_department" name="assign_to" value="department">
                    <label for="assign_to_department">Целому отделу</label>
                </div>
            </div>

            <div class="mb-3" id="user_select">
                <label for="assigned_to" class="form-label">Пользователь</label>
                <select class="form-control" id="assigned_to" name="assigned_to">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 d-none" id="department_select">
                <label for="department_id" class="form-label">Отдел</label>
                <select class="form-control" id="department_id" name="department_id">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="is_additional" class="form-label">Это дополнительная работа?</label>
                <input type="checkbox" id="is_additional" name="is_additional" value="1">
            </div>

            <button type="submit" class="btn btn-primary">Создать задачу</button>
        </form>
    </div>

    <script>
        document.getElementById('assign_to_user').addEventListener('change', function() {
            document.getElementById('user_select').classList.remove('d-none');
            document.getElementById('department_select').classList.add('d-none');
        });

        document.getElementById('assign_to_department').addEventListener('change', function() {
            document.getElementById('user_select').classList.add('d-none');
            document.getElementById('department_select').classList.remove('d-none');
        });
    </script>
@endsection
