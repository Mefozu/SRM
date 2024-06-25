<!-- resources/views/tasks/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ Auth::user()->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passport" class="col-md-4 col-form-label text-md-right">{{ __('Passport Number') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ Auth::user()->passport_number }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ Auth::user()->phone_number }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ Auth::user()->age }} лет</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ Auth::user()->gender }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ Auth::user()->department ? Auth::user()->department->name : '-' }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ Auth::user()->position }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="responsibilities" class="col-md-4 col-form-label text-md-right">{{ __('Responsibilities') }}</label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ Auth::user()->responsibilities }}</p>
                            </div>
                        </div>

                        <hr>

                        <!-- Первая таблица: Мои задачи -->
                        <h3>{{ __('Мои задачи') }}</h3>
                        @if ($tasks && count($tasks) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">Создатель</th>
                                    <th scope="col">Дедлайн</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->creator->name ?? 'Неизвестно' }}</td>
                                        <td>{{ $task->due_date->format('d.m.Y H:i') }}</td>
                                        <td>{{ $task->status }}</td>
                                        <td>
                                            @if ($task->status != 'completed')
                                                <form action="{{ route('tasks.submitForReview', $task->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Отправить на проверку</button>
                                                </form>
                                            @else
                                                {{ __('Завершено') }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>{{ __('Нет задач') }}</p>
                        @endif

                        <!-- Вторая таблица: Завершенные задачи -->
                        <h3>{{ __('Завершенные задачи') }}</h3>
                        @if ($completedTasks && count($completedTasks) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">Создатель</th>
                                    <th scope="col">Дата завершения</th>
                                    <th scope="col">Комментарий</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($completedTasks as $task)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->creator->name ?? 'Неизвестно' }}</td>
                                        <td>{{ $task->completed_at ? $task->completed_at->format('d.m.Y H:i') : '' }}</td>
                                        <td>{{ $task->comment }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>{{ __('Нет завершенных задач') }}</p>
                        @endif

                        <!-- Третья таблица: Дополнительная работа -->
                        <h3>{{ __('Дополнительная работа') }}</h3>
                        @if ($additionalTasks && count($additionalTasks) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">Создатель</th>
                                    <th scope="col">Дедлайн</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($additionalTasks as $task)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->creator->name ?? 'Неизвестно' }}</td>
                                        <td>{{ $task->due_date->format('d.m.Y H:i') }}</td>
                                        <td>{{ $task->status }}</td>
                                        <td>
                                            @if ($task->status != 'completed')
                                                <form action="{{ route('tasks.submitForReview', $task->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Отправить на проверку</button>
                                                </form>
                                            @else
                                                {{ __('Завершено') }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>{{ __('Нет дополнительной работы') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
