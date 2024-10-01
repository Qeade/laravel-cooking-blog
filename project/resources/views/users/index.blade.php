

@extends('layouts.app')

@section('title', 'Користувачі')

@section('content')
<div class="container">
    <h1>Список користувачів</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Додати користувача</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ім'я</th>
                <th>Email</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Переглянути</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Редагувати</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Видалити</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
