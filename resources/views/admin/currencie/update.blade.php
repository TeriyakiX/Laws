@extends('layouts.admin_main')

@section('content')
    <form action="{{ route('curs.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Страна:</label>
            <input type="text" id="country" name="country" value="{{ $cur->country }}" class="form-control" required>

            <label for="date">Название:</label>
            <input type="text" id="currency_name" name="currency_name" value="{{ $cur->currency_name }}" class="form-control" required>

            <label for="date">Символ:</label>
            <input type="text" id="currency_symbol" name="currency_symbol" value="{{ $cur->currency_symbol }}" class="form-control" required>

            <label for="date">Валюта:</label>
            <input type="text" id="currency" name="currency" value="{{ $cur->currency }}" class="form-control" required>
            <input type="hidden" name="cur_id" value="{{ $cur->id }}">
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
<br>
    <div>
        <a href="{{ route('admin.curs.index') }}" class="btn btn-primary mb-3">Вернуться назад</a>
    </div>
@endsection