@extends('layouts.app')
<<<<<<< Updated upstream
=======
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
>>>>>>> Stashed changes

@section('content')
    <div class="container">
        <h1>Список сотрудников</h1>
        <table class="table">
            <thead>
            <tr>
<<<<<<< Updated upstream
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Отдел</th>
                <th>Должность</th>
=======
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Отдел</th>
                <th scope="col">Действия</th>
>>>>>>> Stashed changes
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
<<<<<<< Updated upstream
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->department }}</td>
                    <td>{{ $employee->position }}</td>
=======
                    <td>
                        <a href="{{ route('employees.show', $employee->id) }}">{{ $employee->name }}</a>
                    </td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ optional($employee->department)->name ?: 'Не назначен' }}</td>
                    <td>
                        <!-- Другие действия, если необходимо -->
                    </td>
>>>>>>> Stashed changes
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
