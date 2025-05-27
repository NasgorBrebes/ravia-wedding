{{-- resources/views/admin/bank-accounts/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Tambah Rekening Bank')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Rekening Bank Baru</h3>
                </div>
                <form action="{{ route('admin.bank-accounts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="bank_name" class="form-label">Nama Bank <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('bank_name') is-invalid @enderror"
                                           id="bank_name"
                                           name="bank_name"
                                           value="{{ old('bank_name') }}"
                                           placeholder="Contoh: Bank BCA, Bank Mandiri">
                                    @error('bank_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="account_holder" class="form-label">Pemegang Rekening <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('account_holder') is-invalid @enderror"
                                           id="account_holder"
                                           name="account_holder"
                                           value="{{ old('account_holder') }}"
                                           placeholder="Nama lengkap pemegang rekening">
                                    @error('account_holder')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="account_number" class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('account_number') is-invalid @enderror"
                                           id="account_number"
                                           name="account_number"
                                           value="{{ old('account_number') }}"
                                           placeholder="Masukkan nomor rekening">
                                    @error('account_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="bank_logo" class="form-label">Logo Bank</label>
                                    <input type="file"
                                           class="form-control @error('bank_logo') is-invalid @enderror"
                                           id="bank_logo"
                                           name="bank_logo"
                                           accept="image/*">
                                    <div class="form-text">Format: JPG, PNG, GIF, SVG. Maksimal 1MB.</div>
                                    @error('bank_logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="is_active"
                                               name="is_active"
                                               value="1"
                                               {{ old('is_active') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Aktifkan rekening ini
                                        </label>
                                    </div>
                                    <div class="form-text">Rekening yang aktif akan ditampilkan di halaman undangan.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('admin.bank-accounts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
