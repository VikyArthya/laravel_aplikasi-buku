@extends('layouts.main')

@section('header')
    <h1>Tambah Kategori</h1>
@endsection

@section('content')
    <form id="categoryForm" action="/categories/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
@endsection
