@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Отдел: {{ $department->name }}</h1>
        <p>Менеджер: {{ $department->manager ? $department->manager->name : 'Не назначен' }}</p>

        <h3>Сотрудники отдела:</h3>
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
            @foreach($department->users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->position }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
