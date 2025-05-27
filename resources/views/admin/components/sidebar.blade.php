<!-- resources/views/admin/components/sidebar.blade.php -->
<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateX(-250px);
        transition: transform 0.3s ease;
        z-index: 1000;
        overflow-y: auto;
    }

    .sidebar.show {
        transform: translateX(0);
    }

    .main-content {
        margin-left: 0;
        transition: margin-left 0.3s ease;
        min-height: 100vh;
        background-color: #f8f9fa;
    }

    .main-content.sidebar-open {
        margin-left: 250px;
    }

    .sidebar-brand {
        padding: 1.5rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .sidebar-nav {
        padding: 1rem 0;
    }

    .nav-item {
        margin: 0.25rem 0;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.8);
        padding: 0.75rem 1.5rem;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.3s ease;
        border-radius: 0 25px 25px 0;
        margin-right: 1rem;
    }

    .nav-link:hover,
    .nav-link.active {
        color: white;
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }

    .nav-link i {
        width: 20px;
        margin-right: 10px;
    }

    .sidebar-toggle {
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1001;
        background: #667eea;
        border: none;
        color: white;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .sidebar-toggle:hover {
        background: #5a6fd8;
    }

    .sidebar-toggle.sidebar-open {
        left: 265px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    @media (min-width: 768px) {
        .sidebar {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 250px;
        }

        .sidebar-toggle {
            display: none;
        }
    }
</style>

<button class="sidebar-toggle" id="sidebarToggle">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <h4 class="mb-0">
            <i class="fas fa-heart text-danger"></i>
            Wedding Admin
        </h4>
        <small class="text-muted">Dashboard</small>
    </div>

    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}"
                    href="{{ route('admin.settings.index') }}">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('stories.*') ? 'active' : '' }}"
                    href="{{ route('admin.stories.index') }}">
                    <i class="fas fa-book-open"></i>
                    <span>Cerita Cinta</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('galleries.*') ? 'active' : '' }}"
                    href="{{ route('admin.galleries.index') }}">
                    <i class="fas fa-images"></i>
                    <span>Galeri</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('bank-accounts.*') ? 'active' : '' }}"
                    href="{{ route('admin.bank-accounts.index') }}">
                    <i class="fas fa-university"></i>
                    <span>Rekening Bank</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(' guests.*') ? 'active' : '' }}"
                    href="{{ route('admin.guests.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Tamu Undangan</span>
                </a>
            </li>

            <li class="nav-item mt-4">
                <a class="nav-link" href="{{ route('wedding.index') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <span>Lihat Website</span>
                </a>
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mainContent = document.getElementById('mainContent');

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            sidebarToggle.classList.toggle('sidebar-open');
            mainContent.classList.toggle('sidebar-open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 768) {
                if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                    sidebarToggle.classList.remove('sidebar-open');
                    mainContent.classList.remove('sidebar-open');
                }
            }
        });
    });
</script>
