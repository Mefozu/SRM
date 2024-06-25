@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@section('content')
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Employee Photo">
                    <h2>{{ $employee->name }}</h2>
                </div>
                <h4>Информация:</h4>
                <p><strong>Email:</strong> {{ $employee->email }}</p>
                <p><strong>Отдел:</strong> {{ is_object($employee->department) ? $employee->department->name : 'Не назначен' }}</p>
                <p><strong>Должность:</strong> {{ $employee->position }}</p>

                <h3 class="mt-4">Назначенные задачи</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Срок выполнения</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->due_date->format('d.m.Y H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <h3 class="mt-4">Отметить отсутствие</h3>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sickModal">
                    Больничный
                </button>
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#absentModal">
                    Прогул
                </button>

                <!-- Sick Modal -->
                <div class="modal fade" id="sickModal" tabindex="-1" aria-labelledby="sickModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="sickModalLabel">Отметить больничный</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="sickForm" action="{{ route('admin.absence.create', ['userId' => $employee->id]) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="sickStartDate" class="form-label">Начало больничного</label>
                                        <input type="date" class="form-control" id="sickStartDate" name="start_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sickEndDate" class="form-label">Окончание больничного</label>
                                        <input type="date" class="form-control" id="sickEndDate" name="end_date" required>
                                    </div>
                                    <input type="hidden" name="type" value="sick">
                                    <button type="submit" class="btn btn-success">Отметить больничный</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="hookyModal" tabindex="-1" aria-labelledby="hookyModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hookyModalLabel">Отметить прогул</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.hooky.create', ['userId' => $employee->id]) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="hookyDate" class="form-label">Дата отсутствия</label>
                                        <input type="date" class="form-control" id="hookyDate" name="date" required>
                                    </div>
                                    <button type="submit" class="btn btn-dark">Отметить прогул</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('sickForm').addEventListener('submit', function(event) {
            console.log('Sick leave form submitted');
        });
    </script>
@endsection

@section('scripts')
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
@endsection
