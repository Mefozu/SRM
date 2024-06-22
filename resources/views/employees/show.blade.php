<!-- resources/views/employees/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="https://via.placeholder.com/150" alt="Профиль" class="img-thumbnail">
                    </div>
                    <div class="col-md-9">
                        <h1>{{ $employee->name }}</h1>
                        <h3>Информация:</h3>
                        <p>Email: {{ $employee->email }}</p>
                        <p>Должность: {{ $employee->position }}</p>
                        <p>Должностные обязанности: {{ $employee->duties }}</p>
                        <p>Номер телефона: {{ $employee->phone_number }}</p>
                        <p>Возраст: {{ $employee->age }} лет</p>
                        <p>Пол: {{ $employee->gender }}</p>
                        <p>Отдел: {{ $employee->department ? $employee->department->name : 'Не назначен' }}</p>
                        <p>Статус: <span class="badge bg-success">{{ $employee->status }}</span></p>

                        <h3>Назначенные задачи</h3>
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

                        <h3>Назначить новую задачу</h3>
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="assigned_to" value="{{ $employee->id }}">
                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="due_date">Срок выполнения</label>
                                <input type="datetime-local" class="form-control" id="due_date" name="due_date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Назначить задачу</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
