{{-- File: resources/views/admin/stories/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Kelola Cerita Pernikahan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-heart me-2"></i>Kelola Cerita Pernikahan
                    </h4>
                    <a href="{{ route('admin.stories.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i>Tambah Cerita
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($stories->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">#</th>
                                        <th width="100">Gambar</th>
                                        <th>Judul</th>
                                        <th width="120">Tanggal</th>
                                        <th width="80">Urutan</th>
                                        <th width="80">Status</th>
                                        <th width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stories as $story)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($story->image)
                                                    <img src="{{ Storage::url($story->image) }}" 
                                                         alt="{{ $story->title }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 60px; border-radius: 8px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ $story->title }}</div>
                                                <small class="text-muted">{{ Str::limit($story->story, 50) }}</small>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($story->date)->format('d M Y') }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $story->order }}</span>
                                            </td>
                                            <td>
                                                @if($story->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('admin.stories.show', $story) }}" 
                                                       class="btn btn-outline-info" title="Lihat">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.stories.edit', $story) }}" 
                                                       class="btn btn-outline-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.stories.destroy', $story) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus cerita ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada cerita pernikahan</h5>
                            <p class="text-muted">Mulai tambahkan cerita pernikahan yang indah!</p>
                            <a href="{{ route('admin.stories.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah Cerita Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection