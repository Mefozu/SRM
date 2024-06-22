@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@section('content')
    <div class="container">
        <h1>Сотрудники</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Отдел</th>
                <th scope="col">Должность</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td scope="row">{{ $employee->id }}</td>
                    <td scope="row">{{ $employee->name }}</td>
                    <td scope="row">{{ $employee->email }}</td>
                    <td scope="row">{{ $employee->department }}</td>
                    <td scope="row">{{ $employee->position }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
