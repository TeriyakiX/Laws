@extends('layouts.admin_main')

@section('content')
    <table style="border-collapse: collapse; width: 70%">
        <thead>
        <tr>
            <th>ID</th>
            <th>user_id</th>
            <th>name</th>
            <th>date</th>
            <th>finished</th>
            <th>for_myself</th>
            <th>Update At</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($checklist as $check)
            <tr>
                <td>{{ $check->id }}</td>
                <td>{{ $check->user_id }}</td>
                <td>{{ $check->name }}</td>
                <td>{{ $check->date }}</td>
{{--                <td>{{ $check->date->format('Y-m-d') }}</td>--}}
                @if($check->finished == 1)
                    <td>Завершено</td>
                @else
                    <td>Не завершено</td>
                @endif
                @if($check->for_myself == 1)
                    <td>Для себя</td>
                @else
                    <td>Для вселенной</td>
                @endif
                <td>{{ $check->created_at }}</td>
                <td>{{ $check->updated_at }}</td>
{{--                <td>{{ $check->created_at->format('Y-m-d H:i:s') }}</td>--}}
{{--                <td>{{ $check->updated_at->format('Y-m-d H:i:s') }}</td>--}}
                <td>
                    <a href="{{ route('admin.checklist.update', ['id' => $check->id]) }}" title="Изменить">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.checklist.delete', ['id' => $check->id]) }}" title="Удалить" onclick="return confirm('Вы действительно хотите удалить {{ $check->name }}');">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
