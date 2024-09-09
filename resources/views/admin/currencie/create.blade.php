@extends('layouts.admin_main')

@section('content')
    <form action="{{ route('curs.create') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Страна:</label>
            <input type="text" id="country" name="country" class="form-control" required>

            <label for="date">Название:</label>
            <input type="text" id="currency_name" name="currency_name" class="form-control" required>

            <label for="date">Символ:</label>
            <input type="text" id="currency_symbol" name="currency_symbol" class="form-control" required>

            <label for="date">Валюта:</label>
            <input type="text" id="currency" name="currency" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
<br>
    <div>
        <a href="{{ route('admin.curs.index') }}" class="btn btn-primary mb-3">Вернуться назад</a>
    </div>
@endsection
