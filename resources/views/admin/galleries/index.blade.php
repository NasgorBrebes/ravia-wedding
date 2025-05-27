@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Galeri Pernikahan</h1>
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary mb-3">Tambah Foto</a>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Galeri --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Alt Text</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($galleries as $gallery)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $gallery->thumbnail_url) }}" width="100" class="img-thumbnail">
                </td>
                <td>{{ $gallery->alt_text }}</td>
                <td>{{ $gallery->order }}</td>
                <td>
                    <span class="badge {{ $gallery->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $gallery->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada foto di galeri.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
