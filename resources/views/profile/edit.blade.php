@extends('layouts.app')

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
