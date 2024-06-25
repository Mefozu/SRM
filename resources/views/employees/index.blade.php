@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@section('content')
    <div class="container mt-5">
        <h1>Employee List</h1>
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
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>
                        <a href="{{ route('employees.show', $employee->id) }}">{{ $employee->name }}</a>
                    </td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ is_object($employee->department) ? $employee->department->name : 'Не назначен' }}</td>
                    <td>
                        <!-- Другие действия, если необходимо -->
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

