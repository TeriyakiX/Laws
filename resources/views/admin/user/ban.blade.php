@extends('layouts.admin_main')

@section('content')
    <h2>{{ $message }}</h2>
    <form action="{{ route('user.ban') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Выберите дату:</label>
            <input type="date" id="date" name="date" class="form-control" required>
            <label for="reason">Причина:</label>
            <textarea id="reason" name="reason" class="form-control" rows="3" required></textarea>
            <input type="hidden" name="user_id" value="{{ $user_id }}">
        </div>
        <button type="submit" class="btn btn-primary">Забанить</button>
    </form>
    <br>
    <div>
        <a href="{{ route('admin.user.index') }}" class="btn btn-primary mb-3">Вернуться назад</a>
    </div>
@endsection
