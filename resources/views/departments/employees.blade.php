

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Сотрудники отдела "{{ $department->name }}"</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Должность</th>
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
