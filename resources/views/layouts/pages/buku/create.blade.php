@extends('layouts.main')

@section('header')
    <h1>Tambah Buku</h1>
@endsection

@section('content')
    <form id="addBookForm" action="/bukus/store" method="POST" enctype="multipart/form-data">
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

    <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
        Buku berhasil ditambahkan.
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // Ketika form disubmit
        $('#addBookForm').on('submit', function(e) {
            e.preventDefault(); // Mencegah form submit biasa

            var formData = new FormData(this); // Ambil data form termasuk file

            $.ajax({
                url: $(this).attr('action'), // URL action dari form
                type: 'POST',
                data: formData, // Kirimkan data form
                contentType: false, // Jangan set content type otomatis
                processData: false, // Jangan proses data
                success: function(response) {
                    if (response.success) {
                        // Tampilkan pesan sukses
                        $('#successMessage').show();
                        // Reset form
                        $('#addBookForm')[0].reset();
                    } else {
                        alert('Buku gagal ditambahkan!');
                    }
                },
                error: function(error) {
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        });
    });
</script>
