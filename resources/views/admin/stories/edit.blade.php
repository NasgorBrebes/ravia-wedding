{{-- File: resources/views/admin/stories/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Cerita Pernikahan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Cerita Pernikahan
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.stories.update', $story) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Cerita <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $story->title) }}" 
                                           placeholder="Masukkan judul cerita">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" 
                                           class="form-control @error('date') is-invalid @enderror" 
                                           id="date" 
                                           name="date" 
                                           value="{{ old('date', $story->date) }}">
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="story" class="form-label">Cerita <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('story') is-invalid @enderror" 
                                              id="story" 
                                              name="story" 
                                              rows="8" 
                                              placeholder="Tulis cerita pernikahan yang indah...">{{ old('story', $story->story) }}</textarea>
                                    @error('story')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar</label>
                                    
                                    @if($story->image)
                                        <div class="mb-2">
                                            <label class="form-label text-muted small">Gambar saat ini:</label>
                                            <div>
                                                <img src="{{ Storage::url($story->image) }}" 
                                                     alt="{{ $story->title }}" 
                                                     class="img-fluid rounded" 
                                                     style="max-height: 150px;">
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <input type="file" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*">
                                    <div class="form-text">Kosongkan jika tidak ingin mengubah gambar</div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <label class="form-label text-muted small">Preview gambar baru:</label>
                                        <div>
                                            <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 150px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="order" class="form-label">Urutan Tampil <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control @error('order') is-invalid @enderror" 
                                           id="order" 
                                           name="order" 
                                           value="{{ old('order', $story->order) }}" 
                                           min="0">
                                    <div class="form-text">Angka kecil akan tampil lebih dulu</div>
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1" 
                                               {{ old('is_active', $story->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Aktifkan cerita ini
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.stories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>Update Cerita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').style.display = 'none';
    }
});
</script>
@endsection