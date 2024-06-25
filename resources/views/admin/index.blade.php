@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Админ панель</h1>
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

        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#assignManagerModal">
            Назначить менеджера отделу
        </button>

        <!-- The Modal -->
        <div class="modal fade" id="assignManagerModal" tabindex="-1" aria-labelledby="assignManagerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignManagerModalLabel">Назначить менеджера отделу</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.storeManagerToDepartment') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="department_id" class="form-label">Отдел</label>
                                <select class="form-select" id="department_id" name="department_id" required>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="manager_id" class="form-label">Менеджер</label>
                                <select class="form-select" id="manager_id" name="manager_id" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Назначить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Отдел</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->department ? $user->department->name : 'Не назначен' }}</td>
                    <td>
                        <form action="{{ route('admin.assignDepartment', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <select name="department_id" required>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Назначить</button>
                        </form>

                        <form action="{{ route('admin.assignManagerRole', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Назначить менеджером</button>
                        </form>
                        @if($user->role == 'manager')
                            <form action="{{ route('admin.deleteManager', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить менеджера</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
@endsection
