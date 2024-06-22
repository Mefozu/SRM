@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Админ панель</h1>
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
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->department }}</td>
                    <td>
                        <form action="{{ route('admin.assignDepartment', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <select name="department_id" required>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Назначить</button>
                        </form>
                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                        <!-- Форма для назначения роли "менеджер" -->
                        <form action="{{ route('admin.assignManagerRole', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Назначить менеджером</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap JS (если не используется CDN) -->
    {{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
@endpush
