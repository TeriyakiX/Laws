@extends('layouts.admin_main')

@section('content')
    <form action="{{ route('checklist.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">ID пользователя:</label>
            <input type="text" id="user_id" name="user_id" value="{{ $checklist->user_id }}" class="form-control" required>
            <br>
            <label for="name">Название:</label>
            <input type="text" id="name" name="name" value="{{ $checklist->name }}" class="form-control" required>
            <br>
            <label for="date">Дата:</label><br>
            <input type="date" id="date" value="{{ $checklist->date }}" name="date" required>
            <br><br>
            @if($checklist->finished == 1)
                <label for="finished">Завершено?</label><br>
                <select id="finished" name="finished" required>
                    <option value="1">Да</option>
                    <option value="0">Нет</option>
                </select>
            @else
                <label for="finished">Завершено?</label><br>
                <select id="finished" name="finished">
                    <option value="0">Нет</option>
                    <option value="1">Да</option>
                </select>
            @endif
            <br><br>
            @if($checklist->for_myself == 1)
                <label for="for_myself">Для чего?</label><br>
                <select id="for_myself" name="for_myself" required>
                    <option value="1">Меня</option>
                    <option value="0">Вселеной</option>
                </select>
            @else
                <label for="for_myself">Для чего?</label><br>
                <select id="for_myself" name="for_myself">
                    <option value="0">Вселеной</option>
                    <option value="1">Меня</option>
                </select>
            @endif

            <input type="hidden" name="checklist_id" value="{{ $checklist->id }}">
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
<br>
    <div>
        <a href="{{ route('admin.checklist.index') }}" class="btn btn-primary mb-3">Вернуться назад</a>
    </div>
@endsection
