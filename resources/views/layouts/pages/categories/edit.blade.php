@extends('layouts.main')

@section('header')
    <h1>Edit Kategori</h1>
@endsection

@section('content')
    <form action="/categories/{{ $category->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
@endsection
