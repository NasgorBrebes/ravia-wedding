@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Foto ke Galeri</h1>

    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="alt_text" class="form-label">Alt Text</label>
            <input type="text" name="alt_text" class="form-control" value="{{ old('alt_text') }}">
        </div>

        <div class="mb-3">
            <label for="order" class="form-label">Urutan</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ old('is_active') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Aktif</label>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
