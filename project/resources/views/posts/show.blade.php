@extends('layouts.app')

@section('title', 'Деталі поста')

@section('content')
<div class="container">

    <form method="GET" action="{{ route('posts.show', $post->id) }}">
        <label for="user_select">Оберіть користувача:</label>
        <select id="user_select" name="selected_user" class="form-control" onchange="this.form.submit()">
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $selectedUserId ? 'selected' : '' }}>
                    {{ $user->username }}
                </option>
            @endforeach
        </select>
    </form>

    <form action="{{ $isLiked ? route('likes.destroy', [$post->id, $selectedUserId]) : route('likes.store', [$post->id, $selectedUserId]) }}" method="POST">
        @csrf
        @if($isLiked)
            @method('DELETE')
        @endif
        <button type="submit" class="btn btn-{{$isLiked? 'danger':'primary'}} mt-3">
            {{ $isLiked ? 'Забрати лайк' : 'Лайк' }}
        </button>
    </form>

    <p class="mt-3">Лайків: {{ $post->likes->count() }}</p>

    <h1>{{ $post->title }}</h1>

    <div class="mb-3">
        <h5>Автор:</h5>
        <p>{{ $post->user->username }}</p>
    </div>

    <div class="mb-3">
        <h5>Опис:</h5>
        <p>{{ $post->description }}</p>
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
