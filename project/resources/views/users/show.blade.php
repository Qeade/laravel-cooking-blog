
@extends('layouts.app')

@section('title', 'Переглянути користувача')

@section('content')
<div class="container">
    <h1>Користувач: {{ $user->username }}</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Created at:</strong> {{ $user->created_at }}</li>
        <li class="list-group-item"><strong>Last update at:</strong> {{ $user->updated_at }}</li>
    </ul>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Назад</a>
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mt-3">Редагувати</a>
</div>
@endsection
