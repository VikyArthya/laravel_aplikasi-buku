@extends('layouts.main')

@section('header')
    <h1>Edit Kategori</h1>
@endsection

@section('content')
    <form id="editCategoryForm" action="/categories/{{ $category->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
        Kategori berhasil diperbarui.
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // Ketika form disubmit
        $('#editCategoryForm').on('submit', function(e) {
            e.preventDefault(); // Mencegah form submit biasa

            var formData = $(this).serialize(); // Ambil data form

            $.ajax({
                url: $(this).attr('action'), // URL action dari form
                type: 'POST',
                data: formData, // Kirimkan data form
                success: function(response) {
                    if (response.success) {
                        // Redirect ke halaman index kategori
                        window.location.href = '/categories';
                    } else {
                        alert('Kategori gagal diperbarui!');
                    }
                },
                error: function(error) {
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        });
    });
</script>
