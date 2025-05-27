{{-- resources/views/admin/bank-accounts/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Kelola Rekening Bank')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar Rekening Bank</h3>
                    <a href="{{ route('admin.bank-accounts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Rekening
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Nama Bank</th>
                                    <th>Pemegang Rekening</th>
                                    <th>Nomor Rekening</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bankAccounts as $account)
                                <tr>
                                    <td>
                                        @if($account->bank_logo)
                                            <img src="{{ Storage::url($account->bank_logo) }}"
                                                 alt="{{ $account->bank_name }}"
                                                 class="img-thumbnail"
                                                 style="width: 50px; height: 50px; object-fit: contain;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                 style="width: 50px; height: 50px; border-radius: 4px;">
                                                <i class="fas fa-university text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $account->bank_name }}</td>
                                    <td>{{ $account->account_holder }}</td>
                                    <td>
                                        <code>{{ $account->account_number }}</code>
                                    </td>
                                    <td>
                                        @if($account->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.bank-accounts.show', $account) }}"
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.bank-accounts.edit', $account) }}"
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.bank-accounts.destroy', $account) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus rekening ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-university fa-3x mb-3"></i>
                                            <p>Belum ada rekening bank yang ditambahkan.</p>
                                            <a href="{{ route('admin.bank-accounts.create') }}" class="btn btn-primary">
                                                Tambah Rekening Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
