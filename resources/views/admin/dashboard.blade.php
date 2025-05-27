{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Dashboard Wedding')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Wedding</h1>
                        <p class="text-muted mb-0">Kelola undangan pernikahan Anda</p>
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="exportGuestList()">
                            <i class="fas fa-download me-2"></i>Export Guest List
                        </button>
                        <button class="btn btn-outline-primary" onclick="refreshDashboard()">
                            <i class="fas fa-sync-alt me-2"></i>Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Tamu
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-guests">
                                    {{ $stats['total_guests'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Konfirmasi Hadir
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="confirmed-guests">
                                    {{ $stats['confirmed_guests'] }}
                                </div>
                                <div class="text-xs text-success" id="confirmed-percentage">
                                    {{ $stats['confirmed_percentage'] }}% dari total
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Tidak Hadir
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="declined-guests">
                                    {{ $stats['declined_guests'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Belum Konfirmasi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="pending-guests">
                                    {{ $stats['pending_guests'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Response Rate Progress -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Response Rate</h6>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $stats['confirmed_percentage'] }}%"></div>
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $stats['total_guests'] > 0 ? round(($stats['declined_guests'] / $stats['total_guests']) * 100, 1) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-right">
                                <span class="text-success font-weight-bold">{{ $stats['response_rate'] }}% responded</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <!-- Attendance Pie Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Status Kehadiran</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="attendanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Relationship Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Kategori Tamu</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="relationshipChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
                        <a href="#" class="btn btn-sm btn-primary" onclick="loadRecentActivities()">
                            <i class="fas fa-sync-alt me-1"></i>Refresh
                        </a>
                    </div>
                    <div class="card-body">
                        <div id="recent-activities-container">
                            @if ($recent_activities->count() > 0)
                                @foreach ($recent_activities as $activity)
                                    <div
                                        class="d-flex align-items-center mb-3 p-3 border-left-{{ $activity->status_badge }} border rounded">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 font-weight-bold">{{ $activity->name }}</h6>
                                            <p class="mb-1 text-sm">
                                                <span
                                                    class="badge badge-{{ $activity->status_badge }}">{{ $activity->attendance_label }}</span>
                                                <span class="text-muted mx-2">•</span>
                                                <span class="text-muted">{{ $activity->relationship_label }}</span>
                                            </p>
                                            @if ($activity->message)
                                                <p class="mb-0 text-muted small">{{ Str::limit($activity->message, 100) }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="text-muted small">
                                            {{ $activity->rsvp_date->diffForHumans() }}
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                                    <p class="text-muted">Belum ada aktivitas RSVP</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Charts
        let attendanceChart, relationshipChart;

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
        });

        function initializeCharts() {
            // Attendance Chart
            const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
            attendanceChart = new Chart(attendanceCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($attendance_chart_data['labels']) !!},
                    datasets: [{
                        data: {!! json_encode($attendance_chart_data['data']) !!},
                        backgroundColor: {!! json_encode($attendance_chart_data['colors']) !!},
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });

            // Relationship Chart
            const relationshipCtx = document.getElementById('relationshipChart').getContext('2d');
            relationshipChart = new Chart(relationshipCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($relationship_chart_data['labels']) !!},
                    datasets: [{
                        data: {!! json_encode($relationship_chart_data['data']) !!},
                        backgroundColor: {!! json_encode($relationship_chart_data['colors']) !!},
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        }

        // Refresh dashboard data
        function refreshDashboard() {
            fetch('/admin/api/guest-stats')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-guests').textContent = data.total_guests;
                    document.getElementById('confirmed-guests').textContent = data.confirmed_guests;
                    document.getElementById('declined-guests').textContent = data.declined_guests;
                    document.getElementById('pending-guests').textContent = data.pending_guests;
                    document.getElementById('confirmed-percentage').textContent = data.confirmed_percentage +
                        '% dari total';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data statistik');
                });

            // Refresh charts
            refreshCharts();

            // Refresh recent activities
            loadRecentActivities();
        }

        function refreshCharts() {
            // Refresh attendance chart
            fetch('/admin/api/attendance-chart')
                .then(response => response.json())
                .then(data => {
                    attendanceChart.data = data;
                    attendanceChart.update();
                });

            // Refresh relationship chart
            fetch('/admin/api/relationship-chart')
                .then(response => response.json())
                .then(data => {
                    relationshipChart.data = data;
                    relationshipChart.update();
                });
        }

        function loadRecentActivities() {
            const container = document.getElementById('recent-activities-container');
            container.innerHTML =
                '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-gray-300"></i></div>';

            fetch('/admin/api/recent-activities')
                .then(response => response.json())
                .then(result => {
                    if (result.data.length === 0) {
                        container.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                        <p class="text-muted">Belum ada aktivitas RSVP</p>
                    </div>
                `;
                        return;
                    }

                    let html = '';
                    result.data.forEach(activity => {
                        html += `
                    <div class="d-flex align-items-center mb-3 p-3 border-left-${activity.badge_color} border rounded">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 font-weight-bold">${activity.name}</h6>
                            <p class="mb-1 text-sm">
                                <span class="badge badge-${activity.badge_color}">${activity.attendance}</span>
                                <span class="text-muted mx-2">•</span>
                                <span class="text-muted">${activity.relationship}</span>
                            </p>
                            ${activity.message_preview ? `<p class="mb-0 text-muted small">${activity.message_preview}</p>` : ''}
                        </div>
                        <div class="text-muted small">
                            ${activity.time_ago}
                        </div>
                    </div>
                `;
                    });

                    container.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    container.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-3x text-gray-300 mb-3"></i>
                    <p class="text-muted">Gagal memuat aktivitas</p>
                </div>
            `;
                });
        }

        // Export guest list
        function exportGuestList() {
            const exportBtn = document.querySelector('[onclick="exportGuestList()"]');
            const originalText = exportBtn.innerHTML;

            exportBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Exporting...';
            exportBtn.disabled = true;

            fetch('/admin/export/guest-list')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Export failed');
                    }
                    return response.blob();
                })
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = `wedding-guest-list-${new Date().toISOString().split('T')[0]}.xlsx`;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengunduh daftar tamu');
                })
                .finally(() => {
                    exportBtn.innerHTML = originalText;
                    exportBtn.disabled = false;
                });
        }

        // Auto refresh every 5 minutes
        setInterval(function() {
            refreshDashboard();
        }, 300000); // 5 minutes

        // Real-time notifications
        function initializeNotifications() {
            if ('Notification' in window) {
                Notification.requestPermission();
            }
        }

        function showNotification(title, message) {
            if (Notification.permission === 'granted') {
                new Notification(title, {
                    body: message,
                    icon: '/images/wedding-icon.png'
                });
            }
        }

        // Initialize notifications on load
        document.addEventListener('DOMContentLoaded', function() {
            initializeNotifications();
        });
    </script>
@endpush
