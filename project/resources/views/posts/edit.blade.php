@extends('layouts.app')

@section('title', 'Редагувати пост')

@section('content')
<div class="container">
    <h1>Редагувати пост</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Опис</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $post->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Автор</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $post->user_id ? 'selected' : '' }}>{{ $user->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Категорії</label>
            <select class="form-control" id="categories" name="categories[]" multiple required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        @if(in_array($category->id, $post->categories->pluck('id')->toArray())) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
@endsection
