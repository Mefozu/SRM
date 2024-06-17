@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Админ панель</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Отдел</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->department }}</td>
                    <td>
                        <form action="{{ route('admin.assignDepartment', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="text" name="department" placeholder="Назначить отдел" required>
                            <button type="submit" class="btn btn-primary">Назначить</button>
                        </form>
                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
