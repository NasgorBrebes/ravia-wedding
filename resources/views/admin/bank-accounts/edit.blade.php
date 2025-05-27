{{-- resources/views/admin/bank-accounts/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Rekening Bank')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Rekening Bank</h3>
                </div>
                <form action="{{ route('admin.bank-accounts.update', $bankAccount) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="bank_name" class="form-label">Nama Bank <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('bank_name') is-invalid @enderror"
                                           id="bank_name"
                                           name="bank_name"
                                           value="{{ old('bank_name', $bankAccount->bank_name) }}"
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
                                           value="{{ old('account_holder', $bankAccount->account_holder) }}"
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
                                           value="{{ old('account_number', $bankAccount->account_number) }}"
                                           placeholder="Masukkan nomor rekening">
                                    @error('account_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="bank_logo" class="form-label">Logo Bank</label>
                                    @if($bankAccount->bank_logo)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($bankAccount->bank_logo) }}"
                                                 alt="{{ $bankAccount->bank_name }}"
                                                 class="img-thumbnail"
                                                 style="width: 100px; height: 100px; object-fit: contain;">
                                            <div class="form-text">Logo saat ini</div>
                                        </div>
                                    @endif
                                    <input type="file"
                                           class="form-control @error('bank_logo') is-invalid @enderror"
                                           id="bank_logo"
                                           name="bank_logo"
                                           accept="image/*">
                                    <div class="form-text">Format: JPG, PNG, GIF, SVG. Maksimal 1MB. Kosongkan jika tidak ingin mengubah logo.</div>
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
                                               {{ old('is_active', $bankAccount->is_active) ? 'checked' : '' }}>
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
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('admin/bank-accounts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
