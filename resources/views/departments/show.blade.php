@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $department->name }}</h1>
        <h2>Сотрудники:</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Должность</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->position }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
