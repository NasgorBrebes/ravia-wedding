{{-- File: resources/views/admin/stories/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Detail Cerita Pernikahan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-eye me-2"></i>Detail Cerita Pernikahan
                    </h4>
                    <div>
                        <a href="{{ route('admin.stories.edit', $story) }}" class="btn btn-warning btn-sm me-2">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('admin.stories.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h2 class="text-primary">{{ $story->title }}</h2>
                                <div class="text-muted mb-3">
                                    <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($story->date)->format('d F Y') }}
                                    <span class="mx-3">|</span>
                                    <i class="fas fa-sort-numeric-up me-2"></i>Urutan: {{ $story->order }}
                                    <span class="mx-3">|</span>
                                    Status: 
                                    @if($story->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Isi Cerita:</h5>
                                <div class="bg-light p-4 rounded">
                                    {!! nl2br(e($story->story)) !!}
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <small class="text-muted">
                                        <i class="fas fa-plus-circle me-1"></i>
                                        Dibuat: {{ $story->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <small class="text-muted">
                                        <i class="fas fa-edit me-1"></i>
                                        Diupdate: {{ $story->updated_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @if($story->image)
                                <div class="mb-4">
                                    <h5 class="mb-3">Gambar:</h5>
                                    <div class="text-center">
                                        <img src="{{ Storage::url($story->image) }}" 
                                             alt="{{ $story->title }}" 
                                             class="img-fluid rounded shadow"
                                             style="max-height: 400px;">
                                    </div>
                                </div>
                            @else
                                <div class="mb-4">
                                    <h5 class="mb-3">Gambar:</h5>
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                         style="height: 200px;">
                                        <div class="text-center text-muted">
                                            <i class="fas fa-image fa-3x mb-2"></i>
                                            <div>Tidak ada gambar</div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Informasi Tambahan</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <strong>ID:</strong> {{ $story->id }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Jumlah Karakter:</strong> {{ strlen($story->story) }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Jumlah Kata:</strong> {{ str_word_count(strip_tags($story->story)) }}
                                        </li>
                                        <li>
                                            <strong>Format Gambar:</strong> 
                                            @if($story->image)
                                                {{ strtoupper(pathinfo($story->image, PATHINFO_EXTENSION)) }}
                                            @else
                                                -
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection