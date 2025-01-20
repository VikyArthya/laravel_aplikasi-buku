@extends('layouts.main')

@section('header')
    <h1>Edit Buku</h1>
@endsection

@section('content')
    <form action="/bukus/{{ $buku->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Buku</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $buku->name }}" required>
        </div>

        <div class="form-group">
            <label for="path">Upload Gambar</label>
            <input type="file" name="path" id="path" class="form-control" accept="image/*"
                onchange="previewImage(event)">

            <!-- Pratinjau Gambar -->
            <div class="mt-2">
                @if ($buku->path)
                    <img id="imagePreview" src="{{ asset('storage/' . $buku->path) }}" alt="Gambar Buku"
                        class="img-thumbnail" width="200">
                @else
                    <img id="imagePreview" src="#" alt="Pratinjau Gambar" class="img-thumbnail" width="200"
                        style="display: none;">
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $buku->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();


            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
