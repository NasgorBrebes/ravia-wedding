{{-- resources/views/admin/bank-accounts/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Detail Rekening Bank')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detail Rekening Bank</h3>
                    <div>
                        <a href="{{ route('admin.bank-accounts.edit', $bankAccount) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.bank-accounts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center">
                                @if($bankAccount->bank_logo)
                                    <img src="{{ Storage::url($bankAccount->bank_logo) }}"
                                         alt="{{ $bankAccount->bank_name }}"
                                         class="img-fluid border rounded"
                                         style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center border rounded"
                                         style="width: 200px; height: 200px; margin: 0 auto;">
                                        <i class="fas fa-university fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <h5 class="mt-3">{{ $bankAccount->bank_name }}</h5>
                                @if($bankAccount->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="200">Nama Bank:</th>
                                    <td>{{ $bankAccount->bank_name }}</td>
                                </tr>
                                <tr>
                                    <th>Pemegang Rekening:</th>
                                    <td>{{ $bankAccount->account_holder }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Rekening:</th>
                                    <td>
                                        <code class="fs-5">{{ $bankAccount->account_number }}</code>
                                        <button class="btn btn-sm btn-outline-primary ms-2"
                                                onclick="copyToClipboard('{{ $bankAccount->account_number }}')">
                                            <i class="fas fa-copy"></i> Salin
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($bankAccount->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                            <div class="form-text">Rekening ini akan ditampilkan di halaman undangan</div>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                            <div class="form-text">Rekening ini tidak akan ditampilkan di halaman undangan</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat:</th>
                                    <td>{{ $bankAccount->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Terakhir Diubah:</th>
                                    <td>{{ $bankAccount->updated_at->format('d M Y, H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Success
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
        toast.style.zIndex = '9999';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>Nomor rekening berhasil disalin!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();

        setTimeout(() => {
            document.body.removeChild(toast);
        }, 3000);
    }, function(err) {
        // Error
        console.error('Could not copy text: ', err);
        alert('Gagal menyalin nomor rekening');
    });
}
</script>
@endsection
