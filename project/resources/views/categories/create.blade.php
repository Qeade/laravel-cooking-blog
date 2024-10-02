
@extends('layouts.app')

@section('title', 'Додати категорію')

@section('content')
<div class="container">
    <h1>Додати категорію</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Назва категорії</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Додати</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
@endsection
