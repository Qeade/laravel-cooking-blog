
@extends('layouts.app')

@section('title', 'Переглянути категорію')

@section('content')
<div class="container">
    <h1>Категорія: {{ $category->name }}</h1>

    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Редагувати</a>

    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені?')">Видалити</button>
    </form>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Повернутися до списку</a>
</div>
@endsection
