@extends('layouts.admin_main')

@section('content')
{{--    <div>--}}
{{--        <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">Создать пользователя</a>--}}
{{--    </div>--}}
    <table style="border-collapse: collapse; width: 60%">
        <thead>
        <tr>
            <th style="padding: 5px; text-align: left">ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
{{--            <th>Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                <td>{{ $user->updated_at->format('Y-m-d H:i:s') }}</td>
                <td>
                    <a href="{{ route('admin.user.update', ['id' => $user->id]) }}" title="Изменить">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.user.delete', ['id' => $user->id]) }}" title="Удалить" onclick="return confirm('Вы действительно хотите удалить пользователя {{ $user->name }} ({{ $user->id }})');">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    @if($user->banned)
                        <a href="{{ route('admin.user.unban', ['id' => $user->id]) }}" title="Разблокировать" onclick="return confirm('Вы действительно хотите разблокировать пользователя {{ $user->name }} ({{ $user->id }})');">

                            <i class="fas fa-unlock"></i>
                        </a>
                    @else
                        <a href="{{ route('admin.user.ban', ['id' => $user->id]) }}" title="Заблокировать"> {{-- onclick="return confirm('Вы действительно хотите заблокировать пользователя {{ $user->name }} ({{ $user->id }})');" --}}
                            <i class="fas fa-ban"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
