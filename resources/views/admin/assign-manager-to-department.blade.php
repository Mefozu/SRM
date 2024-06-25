@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">{{ __('Assign Manager to Department') }}</div>
            <div class="card-body">
                <form action="{{ route('admin.storeManagerToDepartment') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="department_id" class="form-label">{{ __('Department') }}</label>
                        <select class="form-select" id="department_id" name="department_id" required>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="manager_id" class="form-label">{{ __('Manager') }}</label>
                        <select class="form-select" id="manager_id" name="manager_id" required>
                            @foreach($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Assign') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
