@extends('layouts.app')

@section('title', 'Деталі поста')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>

    <div class="mb-3">
        <h5>Автор:</h5>
        <p>{{ $post->user->username }}</p>
    </div>

    <div class="mb-3">
        <h5>Опис:</h5>
        <p>{{ $post->description }}</p>
    </div>

    <div class="mb-3">
        <h5>Категорії:</h5>
        <ul>
            @foreach ($post->categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    </div>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Назад до списку</a>
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Редагувати</a>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені, що хочете видалити цей пост?')">Видалити</button>
    </form>
</div>
@endsection
