@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Buku</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Buku</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <form action="{{ url('/bukus') }}" method="GET">
                        <select name="category" class="form-control form-control-sm" onchange="this.form.submit()">
                            <option value="">-- Semua Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    <a href="/bukus/create" class="btn btn-sm btn-primary">
                        Tambah Buku
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukus as $buku)
                            <tr id="buku-{{ $buku->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $buku->name }}</td>
                                <td>
                                    @if ($buku->path)
                                        <img src="{{ asset('storage/' . $buku->path) }}" alt="Gambar Buku" width="100">
                                    @else
                                        <span>Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>{{ $buku->category->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/bukus/edit/{{ $buku->id }}" class="btn btn-sm btn-warning mr-3">
                                            Ubah
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteBuku({{ $buku->id }})">
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
    function deleteBuku(id) {
        if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
            $.ajax({
                url: '/bukus/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE',
                },
                success: function(response) {
                    if (response.success) {
                        // Menghapus baris buku dari tabel
                        $('#buku-' + id).remove();
                    } else {
                        alert('Gagal menghapus buku.');
                    }
                },
                error: function(error) {
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        }
    }
</script>
