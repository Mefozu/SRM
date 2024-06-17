@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Отделы</h1>
        <ul>
            @foreach($departments as $department)
                <li><a href="{{ route('departments.show', $department->id) }}">{{ $department->name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
