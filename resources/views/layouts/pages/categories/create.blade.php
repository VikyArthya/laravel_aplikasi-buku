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

    <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
        Kategori berhasil ditambahkan.
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // Ketika form disubmit
        $('#categoryForm').on('submit', function(e) {
            e.preventDefault(); // Mencegah form submit biasa

            var formData = $(this).serialize(); // Ambil data form

            $.ajax({
                url: $(this).attr('action'), // URL action dari form
                type: 'POST',
                data: formData, // Kirimkan data form
                success: function(response) {
                    if (response.success) {
                        // Tampilkan pesan sukses
                        $('#successMessage').show();
                        // Kosongkan input field
                        $('#name').val('');
                    } else {
                        alert('Kategori gagal ditambahkan!');
                    }
                },
                error: function(error) {
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        });
    });
</script>
