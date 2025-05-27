@extends('admin.layouts.app')

@section('title', 'Daftar Tamu Undangan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar Tamu Undangan</h3>
                    <div>
                        <a href="{{ route('admin.guests.export') }}" class="btn btn-success btn-sm me-2">
                            <i class="fas fa-download"></i> Export CSV
                        </a>
                        <a href="{{ route('admin.guests.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Tamu
                        </a>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $stats['total'] }}</h3>
                                    <p>Total Tamu</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $stats['hadir'] }}</h3>
                                    <p>Hadir</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $stats['tidak_hadir'] }}</h3>
                                    <p>Tidak Hadir</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-times"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $stats['belum_konfirmasi'] }}</h3>
                                    <p>Belum Konfirmasi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-question"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <form method="GET" action="{{ route('admin.guests.index') }}" class="row g-3">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="Cari nama..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <select name="attendance" class="form-select">
                                        <option value="">Semua Status</option>
                                        <option value="hadir" {{ request('attendance') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="tidak_hadir" {{ request('attendance') == 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                        <option value="belum_konfirmasi" {{ request('attendance') == 'belum_konfirmasi' ? 'selected' : '' }}>Belum Konfirmasi</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="relationship" class="form-select">
                                        <option value="">Semua Hubungan</option>
                                        <option value="keluarga" {{ request('relationship') == 'keluarga' ? 'selected' : '' }}>Keluarga</option>
                                        <option value="teman" {{ request('relationship') == 'teman' ? 'selected' : '' }}>Teman</option>
                                        <option value="rekan_kerja" {{ request('relationship') == 'rekan_kerja' ? 'selected' : '' }}>Rekan Kerja</option>
                                        <option value="lainnya" {{ request('relationship') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-outline-primary me-2">Filter</button>
                                    <a href="{{ route('admin.guests.index') }}" class="btn btn-outline-secondary">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Bulk Actions -->
                    <form id="bulkActionForm" method="POST" action="{{ route('admin.guests.bulk-action') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <select name="action" class="form-select me-2" style="width: auto;">
                                        <option value="">Pilih Aksi</option>
                                        <option value="delete">Hapus Terpilih</option>
                                        <option value="update_attendance">Update Status Kehadiran</option>
                                    </select>
                                    <select name="attendance" class="form-select me-2" style="width: auto; display: none;" id="attendanceSelect">
                                        <option value="hadir">Hadir</option>
                                        <option value="tidak_hadir">Tidak Hadir</option>
                                        <option value="belum_konfirmasi">Belum Konfirmasi</option>
                                    </select>
                                    <button type="submit" class="btn btn-warning btn-sm" id="bulkActionBtn" disabled>Jalankan</button>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="50">
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Hubungan</th>
                                        <th>Status Kehadiran</th>
                                        <th>Tanggal RSVP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($guests as $guest)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selected_guests[]" value="{{ $guest->id }}" class="guest-checkbox">
                                        </td>
                                        <td>{{ $guest->name }}</td>
                                        <td>{{ $guest->email ?? '-' }}</td>
                                        <td>{{ $guest->phone ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ ucfirst(str_replace('_', ' ', $guest->relationship)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($guest->attendance == 'hadir')
                                                <span class="badge bg-success">Hadir</span>
                                            @elseif($guest->attendance == 'tidak_hadir')
                                                <span class="badge bg-danger">Tidak Hadir</span>
                                            @else
                                                <span class="badge bg-warning">Belum Konfirmasi</span>
                                            @endif
                                        </td>
                                        <td>{{ $guest->rsvp_date ? $guest->rsvp_date->format('d/m/Y H:i') : '-' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.guests.show', $guest) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.guests.edit', $guest) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.guests.destroy', $guest) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data tamu</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $guests->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Select all checkbox
    $('#selectAll').change(function() {
        $('.guest-checkbox').prop('checked', this.checked);
        toggleBulkAction();
    });

    // Individual checkbox
    $('.guest-checkbox').change(function() {
        toggleBulkAction();

        // Update select all checkbox
        var total = $('.guest-checkbox').length;
        var checked = $('.guest-checkbox:checked').length;
        $('#selectAll').prop('indeterminate', checked > 0 && checked < total);
        $('#selectAll').prop('checked', checked === total);
    });

    // Bulk action select
    $('select[name="action"]').change(function() {
        if (this.value === 'update_attendance') {
            $('#attendanceSelect').show();
        } else {
            $('#attendanceSelect').hide();
        }
        toggleBulkAction();
    });

    function toggleBulkAction() {
        var hasSelected = $('.guest-checkbox:checked').length > 0;
        var hasAction = $('select[name="action"]').val() !== '';
        $('#bulkActionBtn').prop('disabled', !(hasSelected && hasAction));
    }

    // Bulk action form submit
    $('#bulkActionForm').submit(function(e) {
        var action = $('select[name="action"]').val();
        if (action === 'delete') {
            if (!confirm('Yakin ingin menghapus tamu yang dipilih?')) {
                e.preventDefault();
            }
        }
    });
});
</script>
@endpush
@endsection
