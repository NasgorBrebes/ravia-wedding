@extends('admin.layouts.app')

@section('title', 'Edit Tamu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Edit Tamu: {{ $guest->name }}</h3>
                    <a href="{{ route('admin.guests.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <form method="POST" action="{{ route('admin.guests.update', $guest) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $guest->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email', $guest->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone', $guest->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="relationship" class="form-label">Hubungan <span class="text-danger">*</span></label>
                                    <select class="form-select @error('relationship') is-invalid @enderror"
                                            id="relationship" name="relationship" required>
                                        <option value="">Pilih Hubungan</option>
                                        <option value="keluarga" {{ old('relationship', $guest->relationship) == 'keluarga' ? 'selected' : '' }}>Keluarga</option>
                                        <option value="teman" {{ old('relationship', $guest->relationship) == 'teman' ? 'selected' : '' }}>Teman</option>
                                        <option value="rekan_kerja" {{ old('relationship', $guest->relationship) == 'rekan_kerja' ? 'selected' : '' }}>Rekan Kerja</option>
                                        <option value="lainnya" {{ old('relationship', $guest->relationship) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('relationship')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="attendance" class="form-label">Status Kehadiran <span class="text-danger">*</span></label>
                                    <select class="form-select @error('attendance') is-invalid @enderror"
                                            id="attendance" name="attendance" required>
                                        <option value="">Pilih Status</option>
                                        <option value="hadir" {{ old('attendance', $guest->attendance) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="tidak_hadir" {{ old('attendance', $guest->attendance) == 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                        <option value="belum_konfirmasi" {{ old('attendance', $guest->attendance) == 'belum_konfirmasi' ? 'selected' : '' }}>Belum Konfirmasi</option>
                                    </select>
                                    @error('attendance')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if($guest->rsvp_date)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal RSVP</label>
                                    <input type="text" class="form-control" value="{{ $guest->rsvp_date->format('d/m/Y H:i:s') }}" readonly>
                                    <small class="text-muted">Otomatis terupdate saat status kehadiran berubah</small>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control @error('message') is-invalid @enderror"
                                      id="message" name="message" rows="4" placeholder="Pesan atau ucapan dari tamu...">{{ old('message', $guest->message) }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Info tambahan -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Dibuat</label>
                                    <input type="text" class="form-control" value="{{ $guest->created_at->format('d/m/Y H:i:s') }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Terakhir Diperbarui</label>
                                    <input type="text" class="form-control" value="{{ $guest->updated_at->format('d/m/Y H:i:s') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Perbarui
                        </button>
                        <a href="{{ route('admin.guests.index') }}" class="btn btn-secondary ms-2">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
