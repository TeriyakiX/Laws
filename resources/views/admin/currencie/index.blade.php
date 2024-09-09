@extends('layouts.admin_main')

@section('content')
    <div>
        <a href="{{ route('admin.curs.create') }}" class="btn btn-primary mb-3">Создать</a>
    </div>
    <table style="border-collapse: collapse; width: 70%">
        <thead>
        <tr>
            <th>ID</th>
            <th>country</th>
            <th>currency_name</th>
            <th>currency_symbol</th>
            <th>currency</th>
            <th>Update At</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($curs as $cur)
            <tr>
                <td>{{ $cur->id }}</td>
                <td>{{ $cur->country }}</td>
                <td>{{ $cur->currency_name }}</td>
                <td>{{ $cur->currency_symbol }}</td>
                <td>{{ $cur->currency }}</td>
                <td>{{ $cur->created_at->format('Y-m-d H:i:s') }}</td>
                <td>{{ $cur->updated_at->format('Y-m-d H:i:s') }}</td>
                <td>
                    <a href="{{ route('admin.curs.update', ['id' => $cur->id]) }}" title="Изменить">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.curs.delete', ['id' => $cur->id]) }}" title="Удалить" onclick="return confirm('Вы действительно хотите удалить {{ $cur->currency_name }}');">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
