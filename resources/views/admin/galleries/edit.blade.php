@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Foto Galeri</h1>

    <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control">
            @if($gallery->thumbnail_url)
                <img src="{{ asset('storage/' . $gallery->thumbnail_url) }}" width="100" class="mt-2">
            @endif
        </div>

        <div class="mb-3">
            <label for="alt_text" class="form-label">Alt Text</label>
            <input type="text" name="alt_text" class="form-control" value="{{ old('alt_text', $gallery->alt_text) }}">
        </div>

        <div class="mb-3">
            <label for="order" class="form-label">Urutan</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $gallery->order) }}">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Aktif</label>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
