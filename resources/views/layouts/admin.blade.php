{{-- File: resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin Wedding</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255,255,255,0.1);
            border-radius: 8px;
        }
        .card {
            border: none;
            border-radius: 12px;
        }
        .card-header {
            border-radius: 12px 12px 0 0 !important;
        }
        .btn {
            border-radius: 8px;
        }
        .table th {
            border-top: none;
            font-weight: 600;
        }
        .navbar-brand {
            font-weight: 600;
        }
        .main-content {
            padding-top: 1rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">
                            <i class="fas fa-heart me-2"></i>Wedding Admin
                        </h4>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item mb-1">
                            <a class="nav-link" href="#">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.stories.*') ? 'active' : '' }}" 
                               href="{{ route('admin.stories.index') }}">
                                <i class="fas fa-heart me-2"></i>Cerita Pernikahan
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link" href="#">
                                <i class="fas fa-images me-2"></i>Galeri Foto
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users me-2"></i>Tamu Undangan
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-2"></i>Pengaturan
                            </a>
                        </li>
                        <hr class="text-white-50">
                        <li class="nav-item mb-1">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout