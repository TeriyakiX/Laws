@extends('layouts.admin_main')

@section('content')
{{--    <h2>{{ $message }}</h2>--}}
<h2>{{ $user->name }} ({{ $user->id }})</h2>
    <form action="{{ route('user.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Имя:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
            <label for="date">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
            <input type="hidden" name="user_id" value="{{ $user->id }}">
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
<br>
    <div>
        <a href="{{ route('admin.user.index') }}" class="btn btn-primary mb-3">Вернуться назад</a>
    </div>
@endsection
