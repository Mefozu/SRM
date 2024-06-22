<!-- resources/views/departments/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список отделов</h1>
        <div class="mb-3">
            <a href="{{ route('departments.create') }}" class="btn btn-primary">Создать отдел</a>
        </div>
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
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('departments.employees', $department->id) }}" class="btn btn-info">Сотрудники</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
