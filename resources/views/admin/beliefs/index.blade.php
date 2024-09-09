@extends('layouts.admin_main')

@section('content')
    <div>
        <a href="{{ route('admin.bel.create') }}" class="btn btn-primary mb-3">Создать</a>
    </div>
    <div class="tablica">
    <table style="border-collapse: collapse; width: 100%">
        <thead>
        <tr>
            <th style="padding: 5px; text-align: left">ID</th>
            <th>user_id</th>
            <th>name</th>
            <th>percent</th>
            <th>is_сontinues</th>
            <th>start_date</th>
            <th>last_complate_date</th>
            <th>end_date</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($beliefs as $bel)
            <tr>
                <td style="border-bottom: 1px solid #ddd;">{{ $bel->id }}</td>
                <td style="border-bottom: 1px solid #ddd;">{{ $bel->user_id }}</td>
                <td style="border-bottom: 1px solid #ddd;">
                @foreach($bel->name as $n)
                    <li>{{ $n }}</li>
                @endforeach
                </td>
                @if(empty($bel->percent))
                    <td style="border-bottom: 1px solid #ddd;">Пусто</td>
                @else
                    <td style="border-bottom: 1px solid #ddd;">{{ $bel->percent }}</td>
                @endif
                @if($bel->is_сontinues == 1)
                    <td style="border-bottom: 1px solid #ddd;">Завершено</td>
                @else
                    <td style="border-bottom: 1px solid #ddd;">Не завершено</td>
                @endif
                <td style="border-bottom: 1px solid #ddd;">{{ $bel->start_date }}</td>
                <td style="border-bottom: 1px solid #ddd;">{{ $bel->last_complate_date }}</td>
                @if(empty($bel->end_date))
                    <td style="border-bottom: 1px solid #ddd;"> Пусто </td>
                @else
                    <td style="border-bottom: 1px solid #ddd;">{{ $bel->end_date }}</td>
                @endif
                <td style="border-bottom: 1px solid #ddd;">{{ $bel->created_at->format('Y-m-d H:i:s') }}</td>
                <td style="border-bottom: 1px solid #ddd;">{{ $bel->updated_at->format('Y-m-d H:i:s') }}</td>
                <td>
                    <a href="{{ route('admin.bel.update', ['id' => $bel->id]) }}" title="Изменить">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.bel.delete', ['id' => $bel->id]) }}" title="Удалить" onclick="return confirm('Вы действительно хотите удалить');">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>

@endsection
