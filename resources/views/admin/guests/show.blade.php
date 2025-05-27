@extends('admin.layouts.app')

@section('title', 'Detail Tamu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detail Tamu: {{ $guest->name }}</h3>
                    <div>
                        <a href="{{ route('admin.guests.edit', $guest) }}" class="btn btn-warning btn-sm me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.guests.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $guest->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $guest->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Telepon:</strong></td>
                                    <td>{{ $guest->phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Hubungan:</strong></td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ucfirst(str_replace('_', ' ', $guest->relationship)) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status Kehadiran:</strong></td>
                                    <td>
                                        @if($guest->attendance == 'hadir')
                                            <span class="badge bg-success fs-6">Hadir</span>
                                        @elseif($guest->attendance == 'tidak_hadir')
                                            <span class="badge bg-danger fs-6">Tidak Hadir</span>
                                        @else
                                            <span class="badge bg-warning fs-6">Belum Konfirmasi</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Tanggal RSVP:</strong></td>
                                    <td>{{ $guest->rsvp_date ? $guest->rsvp_date->format('d/m/Y H:i:s') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Dibuat:</strong></td>
                                    <td>{{ $guest->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Diperbarui:</strong></td>
                                    <td>{{ $guest->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @if($guest->rsvp_date)
                                <tr>
                                    <td><strong>Waktu Konfirmasi:</strong></td>
                                    <td>{{ $guest->rsvp_date->diffForHumans() }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    @if($guest->message)
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Pesan dari Tamu</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $guest->message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Timeline jika diperlukan -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Timeline Aktivitas</h5>
                            <div class="timeline">
                                <div class="time-label">
                                    <span class="bg-primary">{{ $guest->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div>
                                    <i class="fas fa-user bg-info"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> {{ $guest->created_at->format('H:i') }}</span>
                                        <h3 class="timeline-header">Tamu didaftarkan</h3>
                                        <div class="timeline-body">
                                            Tamu {{ $guest->name }} berhasil didaftarkan ke dalam sistem.
                                        </div>
                                    </div>
                                </div>

                                @if($guest->rsvp_date)
                                <div class="time-label">
                                    <span class="bg-success">{{ $guest->rsvp_date->format('d/m/Y') }}</span>
                                </div>
                                <div>
                                    <i class="fas fa-check bg-success"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> {{ $guest->rsvp_date->format('H:i') }}</span>
                                        <h3 class="timeline-header">Status kehadiran dikonfirmasi</h3>
                                        <div class="timeline-body">
                                            Status kehadiran diperbarui menjadi:
                                            <strong>{{ ucfirst(str_replace('_', ' ', $guest->attendance)) }}</strong>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div>
                                    <i class="far fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.guests.edit', $guest) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Tamu
                        </a>

                        @if($guest->attendance == 'belum_konfirmasi')
                        <form method="POST" action="{{ route('admin.guests.update', $guest) }}" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="name" value="{{ $guest->name }}">
                            <input type="hidden" name="email" value="{{ $guest->email }}">
                            <input type="hidden" name="phone" value="{{ $guest->phone }}">
                            <input type="hidden" name="relationship" value="{{ $guest->relationship }}">
                            <input type="hidden" name="message" value="{{ $guest->message }}">
                            <input type="hidden" name="attendance" value="hadir">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Tandai Hadir
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.guests.update', $guest) }}" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="name" value="{{ $guest->name }}">
                            <input type="hidden" name="email" value="{{ $guest->email }}">
                            <input type="hidden" name="phone" value="{{ $guest->phone }}">
                            <input type="hidden" name="relationship" value="{{ $guest->relationship }}">
                            <input type="hidden" name="message" value="{{ $guest->message }}">
                            <input type="hidden" name="attendance" value="tidak_hadir">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times"></i> Tandai Tidak Hadir
                            </button>
                        </form>
                        @endif

                        <form method="POST" action="{{ route('admin.guests.destroy', $guest) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus tamu ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.timeline {
    position: relative;
    margin: 0 0 30px 0;
    padding: 0;
    list-style: none;
}

.timeline:before {
    content: '';
    position: absolute;
    top: 0;
    left: 25px;
    height: 100%;
    width: 2px;
    background: #3c8dbc;
}

.timeline > li {
    position: relative;
    margin-right: 10px;
    margin-bottom: 15px;
}

.timeline > li:before,
.timeline > li:after {
    content: " ";
    display: table;
}

.timeline > li:after {
    clear: both;
}

.timeline > li > .timeline-item {
    margin-left: 55px;
    margin-top: 0;
    border-radius: 3px;
    padding: 0;
    background: #fff;
    border: 1px solid #d2d6de;
}

.timeline > li > .fa,
.timeline > li > .glyphicon,
.timeline > li > .ion {
    width: 30px;
    height: 30px;
    font-size: 15px;
    line-height: 30px;
    position: absolute;
    color: #666;
    background: #d2d6de;
    border-radius: 50%;
    text-align: center;
    left: 18px;
    top: 0;
}

.timeline > .time-label > span {
    font-weight: 600;
    color: #fff;
    border-radius: 4px;
    display: inline-block;
    padding: 5px;
}

.timeline-header {
    margin: 0;
    color: #555;
    border-bottom: 1px solid #f4f4f4;
    padding: 10px;
    font-weight: 600;
    font-size: 16px;
}

.timeline-body,
.timeline-footer {
    padding: 10px;
}

.time {
    color: #999;
    float: right;
    padding: 10px;
    font-size: 12px;
}
</style>
@endpush
@endsection
