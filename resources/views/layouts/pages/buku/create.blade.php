@extends('layouts.main')

@section('header')
    <h1>Tambah Buku</h1>
@endsection

@section('content')
    <form action="/bukus/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nama Buku</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="path">Upload Gambar</label>
            <input type="file" name="path" id="path" class="form-control">
        </div>
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
