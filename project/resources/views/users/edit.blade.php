
@extends('layouts.app')

@section('title', 'Редагувати користувача')

@section('content')
<div class="container">
    <h1>Редагувати користувача</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="username" class="form-label">Ім'я</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль (залиште пустим, щоб не змінювати)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
@endsection
