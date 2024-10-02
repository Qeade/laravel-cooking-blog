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

    <h5>Категорії:</h5>
    @foreach ($post->categories as $category)
        <span class="badge bg-info"><h5>{{ $category->name }}</h5></span>
    @endforeach
    <h1>{{ $post->title }}</h1>

    <div class="mb-3">
        <h5>Автор:</h5>
        <p>{{ $post->user->username }}</p>
    </div>

    <div class="mb-3">
        <h5>Опис:</h5>
        <p>{{ $post->description }}</p>
    </div>

    <h3>Додати коментар</h3>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $selectedUserId }}">
        <div class="mb-3">
            <label for="text" class="form-label">Коментар</label>
            <textarea class="form-control" id="text" name="text" rows="3" required>{{ old('text') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Додати коментар</button>
    </form>


    <h3>Коментарі</h3>
    <ul class="list-group mt-3">
        @foreach($comments as $comment)
            <li class="list-group-item">
                <strong>{{ $comment->user->username }}</strong>: {{ $comment->text }}
            </li>
        @endforeach
    </ul>

    <p></p>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Назад до списку</a>
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Редагувати</a>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені, що хочете видалити цей пост?')">Видалити</button>
    </form>
</div>
@endsection
