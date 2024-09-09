@extends('layouts.admin_main')

@section('content')
    <h2>{{ $message }}</h2>
    <div>
        <a href="{{ route('admin.bel.index') }}" class="btn btn-primary mb-3">Вернуться назад</a>
    </div>
@endsection
