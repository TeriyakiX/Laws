@extends('layouts.admin_main')

@section('content')
    <form action="{{ route('bel.create') }}" method="POST" id="dynamicForm">
        @csrf
        <div class="form-group">
            <label for="user_id">ID пользователя:</label>
            <input type="number" id="user_id" name="user_id" class="form-control" required>
            <br>
{{--            <label for="name">Название в формате json:</label><br>--}}
{{--            <textarea id="name" name="name" required></textarea>--}}
{{--            <br><br>--}}
            <label for="start_date">Старт дата:</label><br>
            <input type="date" id="start_date" name="start_date" required>
            <br><br>
            <label for="last_complate_date">последняя дата расчета:</label><br>
            <input type="date" id="last_complate_date" name="last_complate_date" required>
            <br><br>
            <label for="end_date">Дата окончания:</label><br>
            <input type="date" id="end_date" name="end_date" required>
            <br><br>
            <label for="percent">Процент:</label>
            <input type="number" id="percent" name="percent" class="form-control" required>
            <br>
            <label for="is_сontinues">Завершено?</label><br>
            <select id="is_сontinues" name="is_сontinues" required>
                <option value="1">Да</option>
                <option value="0">Нет</option>
            </select>
            <br><br>
            <div class="field">
                <label for="field1">Название 1:</label>
                <input type="text" id="field1" name="field1" required>
            </div>
{{--            <div class="field">--}}
{{--                <label for="field2">Название 2:</label>--}}
{{--                <input type="text" id="field2" name="field2">--}}
{{--            </div>--}}
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
<br>
    <div>
        <a href="{{ route('admin.bel.index') }}" class="btn btn-primary mb-3">Вернуться назад</a>
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('dynamicForm');
            let fieldCount = 1;

            form.addEventListener('input', function(event) {
                if (event.target.tagName.toLowerCase() === 'input') {
                    const currentFieldNumber = parseInt(event.target.name.replace('field', ''), 10);
                    if (currentFieldNumber === fieldCount && fieldCount < 5) {
                        fieldCount++;
                        const newField = document.createElement('div');
                        newField.className = 'field';
                        newField.innerHTML = `
                            <label for="field${fieldCount}">Название ${fieldCount}:</label>
                            <input type="text" id="field${fieldCount}" name="field${fieldCount}">
                        `;
                        form.insertBefore(newField, form.querySelector('button'));
                    }
                }
            });

            // form.addEventListener('submit', function(event) {
            //     event.preventDefault();
            //
            //     const formData = {};
            //     for (let i = 1; i <= fieldCount; i++) {
            //         const value = document.getElementById(`field${i}`).value;
            //         if (value) {
            //             formData[`field${i}`] = value;
            //         }
            //     }
            //
            //     console.log('Form Data:', formData);
            //     // Здесь можно отправить данные на сервер
            // });
        });
    </script>
@endsection
