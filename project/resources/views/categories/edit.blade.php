
@extends('layouts.app')

@section('title', 'Редагувати категорію')

@section('content')
<div class="container">
    <h1>Редагувати категорію</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Назва категорії</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
@endsection
