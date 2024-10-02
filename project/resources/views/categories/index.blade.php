
@extends('layouts.app')

@section('title', 'Категорії')

@section('content')
<div class="container">
    <h1>Список категорій</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Додати категорію</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Назва</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info">Переглянути</a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Редагувати</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
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
