@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Редактировать профиль</div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="passport" class="form-label">Паспорт</label>
                        <input type="text" name="passport" id="passport" class="form-control" value="{{ old('passport', $user->passport) }}">
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Отдел</label>
                        <input type="text" name="department" id="department" class="form-control" value="{{ old('department', $user->department) }}">
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Должность</label>
                        <input type="text" name="position" id="position" class="form-control" value="{{ old('position', $user->position) }}">
                    </div>
                    <div class="mb-3">
                        <label for="responsibilities" class="form-label">Должностные обязанности</label>
                        <textarea name="responsibilities" id="responsibilities" class="form-control">{{ old('responsibilities', $user->responsibilities) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </form>
            </div>
        </div>
    </div>
@endsection
