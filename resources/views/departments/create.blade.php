<!-- resources/views/departments/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создать новый отдел</h1>
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название отдела</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection
