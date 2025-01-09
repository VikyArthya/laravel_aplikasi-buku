@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Kategori</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Kategori</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="/categories/create" class="btn btn-sm btn-primary">
                        Tambah Kategori
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr id="category-{{ $category->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="/categories/edit/{{ $category->id }}"
                                                class="btn btn-sm btn-warning mr-3">
                                                Ubah
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="deleteCategory({{ $category->id }})">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    function deleteCategory(id) {
        if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
            $.ajax({
                url: '/categories/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE',
                },
                success: function(response) {
                    if (response.success) {
                        // Menghapus baris kategori dari tabel
                        $('#category-' + id).remove();
                    } else {
                        alert('Gagal menghapus kategori.');
                    }
                },
                error: function(error) {
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        }
    }
</script>
