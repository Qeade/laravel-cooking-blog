@extends('layouts.app')

@section('title', 'Список постів')

@section('content')
<div class="container">
    <h1>Список постів</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Додати пост</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Автор</th>
                <th>Категорії</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->username }}</td>
                    <td>
                        @foreach ($post->categories as $category)
                            <span class="badge bg-info">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">Переглянути</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Редагувати</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені?')">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
