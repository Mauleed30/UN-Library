<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Librarian Panel') - University Repository</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #f0f4f8; min-height: 100vh; }

        /* ==================== TOP NAVBAR ==================== */
        .top-navbar {
            background: white;
            padding: 10px 24px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.04);
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1050;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 68px;
            border-bottom: 1px solid #eef2f7;
        }
        .top-navbar .brand {
            font-weight: 700;
            font-size: 1.15rem;
            color: #1a2a3a;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .top-navbar .brand i { color: #1a5276; font-size: 1.3rem; }
        .top-navbar .brand span {
            background: linear-gradient(135deg, #1a5276, #2c6b9e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .top-navbar .user-info {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .top-navbar .user-info .user-details { text-align: right; line-height: 1.3; }
        .top-navbar .user-info .user-details .name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1a2a3a;
        }
        .top-navbar .user-info .user-details .role {
            font-size: 0.7rem;
            color: #6b7a8f;
            background: #f0f4f8;
            padding: 2px 12px;
            border-radius: 50px;
            display: inline-block;
        }
        .top-navbar .user-info .avatar-dropdown {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1a5276, #2c6b9e);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }
        .top-navbar .user-info .avatar-dropdown:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(26, 82, 118, 0.25);
        }

        .dropdown-menu {
            border: none;
            border-radius: 14px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            padding: 8px 0;
            min-width: 200px;
        }
        .dropdown-menu .dropdown-item {
            padding: 10px 20px;
            font-size: 0.85rem;
            color: #4a5568;
            transition: all 0.2s;
        }
        .dropdown-menu .dropdown-item:hover { background: #f0f4f8; color: #1a5276; }
        .dropdown-menu .dropdown-item i { width: 20px; color: #6b7a8f; }
        .dropdown-menu .dropdown-item.text-danger i { color: #ef4444; }

        /* ==================== SIDEBAR ==================== */
        .sidebar-wrapper {
            position: fixed;
            top: 68px; left: 0; bottom: 0;
            width: 270px;
            background: white;
            border-right: 1px solid #eef2f7;
            overflow-y: auto;
            padding: 16px 0 20px;
            z-index: 1040;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-wrapper::-webkit-scrollbar { width: 3px; }
        .sidebar-wrapper::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }

        .sidebar-profile {
            padding: 0 18px 18px 18px;
            border-bottom: 1px solid #eef2f7;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .sidebar-profile .avatar-lg {
            width: 52px; height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1a5276, #2c6b9e);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .sidebar-profile .info { flex: 1; min-width: 0; }
        .sidebar-profile .info .name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1a2a3a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar-profile .info .email {
            font-size: 0.7rem;
            color: #6b7a8f;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar-profile .info .staff-id {
            font-size: 0.65rem;
            color: #1a5276;
            background: #e8f0fe;
            padding: 1px 12px;
            border-radius: 50px;
            display: inline-block;
            margin-top: 2px;
        }

        .sidebar-wrapper .nav-item { padding: 0 14px; margin-bottom: 1px; }
        .sidebar-wrapper .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #4a5568;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.25s ease;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            position: relative;
        }
        .sidebar-wrapper .nav-link:hover { background: #f0f4f8; color: #1a5276; }
        .sidebar-wrapper .nav-link:hover i { color: #1a5276; }
        .sidebar-wrapper .nav-link.active {
            background: #1a5276;
            color: white;
            box-shadow: 0 4px 15px rgba(26, 82, 118, 0.2);
        }
        .sidebar-wrapper .nav-link.active i { color: white; }
        .sidebar-wrapper .nav-link.active .badge-notif { background: white; color: #1a5276; }
        .sidebar-wrapper .nav-link i {
            width: 20px;
            font-size: 1.05rem;
            color: #6b7a8f;
            transition: color 0.25s;
            flex-shrink: 0;
        }
        .sidebar-wrapper .nav-link .badge-notif {
            margin-left: auto;
            background: #ef4444;
            color: white;
            font-size: 0.6rem;
            padding: 2px 9px;
            border-radius: 50px;
            font-weight: 600;
        }
        .sidebar-wrapper .nav-link .badge-notif.green { background: #10b981; }
        .sidebar-wrapper .nav-link .badge-notif.orange { background: #f59e0b; }

        .sidebar-wrapper .divider {
            height: 1px;
            background: #eef2f7;
            margin: 10px 20px;
        }

        .sidebar-footer { padding: 0 14px; margin-top: 10px; }
        .sidebar-footer .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #ef4444;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.25s;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }
        .sidebar-footer .logout-btn:hover { background: #fef2f2; }
        .sidebar-footer .logout-btn i { width: 20px; font-size: 1.05rem; flex-shrink: 0; }

        /* ==================== MAIN CONTENT ==================== */
        .main-content {
            margin-left: 270px;
            margin-top: 68px;
            padding: 28px 32px;
            min-height: calc(100vh - 68px);
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ==================== MOBILE ==================== */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: #1a2a3a;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 10px;
        }
        .sidebar-toggle:hover { background: #f0f4f8; }

        @media (max-width: 992px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
                width: 290px;
                box-shadow: 2px 0 30px rgba(0,0,0,0.08);
            }
            .sidebar-wrapper.open { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 20px 18px; }
            .sidebar-toggle { display: block; }
            .top-navbar .brand span { display: none; }
        }

        @media (max-width: 576px) {
            .top-navbar { padding: 8px 14px; height: 60px; }
            .main-content { margin-top: 60px; padding: 14px 12px; }
            .sidebar-wrapper { width: 100%; max-width: 300px; }
            .top-navbar .user-info .user-details .name { font-size: 0.8rem; }
            .top-navbar .user-info .user-details .role { font-size: 0.6rem; padding: 1px 10px; }
            .top-navbar .user-info .avatar-dropdown { width: 34px; height: 34px; font-size: 0.9rem; }
            .sidebar-profile .avatar-lg { width: 44px; height: 44px; font-size: 1rem; }
            .sidebar-profile .info .name { font-size: 0.8rem; }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 68px; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.25);
            z-index: 1039;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.show { display: block; }

        .sidebar-wrapper .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 4px; height: 24px;
            background: white;
            border-radius: 0 4px 4px 0;
        }

        .page-transition { animation: fadeSlideUp 0.3s ease; }
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-custom {
            border-radius: 12px;
            padding: 14px 18px;
            border: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .alert-custom.alert-success {
            background: #f0fdf4; color: #065f46; border: 1px solid #bbf7d0;
        }
        .alert-custom.alert-danger {
            background: #fef2f2; color: #991b1b; border: 1px solid #fecaca;
        }
        .alert-custom.alert-warning {
            background: #fffbeb; color: #92400e; border: 1px solid #fde68a;
        }
    </style>
</head>
<body>
<!-- ==================== TOP NAVBAR ==================== -->
<nav class="top-navbar">
    <div class="d-flex align-items-center gap-3">
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <a href="{{ route('librarian.submissions') }}" class="brand">
            <i class="fas fa-university"></i>
            <span>Librarian Panel</span>
        </a>
    </div>

    <div class="user-info">
        <div class="user-details">
            <div class="name">{{ auth()->user()->name }}</div>
            <div class="role">📚 Librarian</div>
        </div>
        <div class="dropdown">
            <button class="avatar-dropdown" data-bs-toggle="dropdown">
                {{ substr(auth()->user()->name, 0, 1) }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-2"></i> My Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-cog me-2"></i> Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <!-- ==================== OVERLAY ==================== -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <div class="sidebar-wrapper" id="sidebarWrapper">
        <!-- Profile Card -->
        <div class="sidebar-profile">
            <div class="avatar-lg">{{ substr(auth()->user()->name, 0, 1) }}</div>
            <div class="info">
                <div class="name">{{ auth()->user()->name }}</div>
                <div class="email">{{ auth()->user()->email }}</div>
                <div class="staff-id">
                    <i class="fas fa-id-card me-1"></i>
                    {{ auth()->user()->staff_id ?? 'LIB001' }}
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="nav-items">
            {{-- DASHBOARD - IMEONDOLWA KWA MAOMBI YAKO --}}

            <!-- Submissions -->
            <div class="nav-item">
                <a href="{{ route('librarian.submissions') }}" class="nav-link {{ request()->routeIs('librarian.submissions') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i> Submissions
                    <span class="badge-notif">{{ \App\Models\Submission::where('status', 'reviewed')->count() }}</span>
                </a>
            </div>

            <!-- Access Level -->
            <div class="nav-item">
                <a href="{{ route('librarian.access') }}" class="nav-link {{ request()->routeIs('librarian.access') ? 'active' : '' }}">
                    <i class="fas fa-lock"></i> Access Level
                </a>
            </div>

            <!-- Approved -->
            <div class="nav-item">
                <a href="{{ route('librarian.submissions') }}?status=approved" class="nav-link">
                    <i class="fas fa-check-circle"></i> Approved
                    <span class="badge-notif green">{{ \App\Models\Submission::where('status', 'approved')->count() }}</span>
                </a>
            </div>

            <!-- Categories -->
            <div class="nav-item">
                <a href="{{ route('librarian.categories') }}" class="nav-link {{ request()->routeIs('librarian.categories') ? 'active' : '' }}">
                    <i class="fas fa-folder"></i> Categories
                </a>
            </div>

            <!-- Statistics -->
            <div class="nav-item">
                <a href="{{ route('librarian.stats') }}" class="nav-link {{ request()->routeIs('librarian.stats') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i> Statistics
                </a>
            </div>

            <!-- Activity -->
            <div class="nav-item">
                <a href="{{ route('librarian.activity') }}" class="nav-link {{ request()->routeIs('librarian.activity') ? 'active' : '' }}">
                    <i class="fas fa-history"></i> Activity
                </a>
            </div>

            <div class="divider"></div>

            <!-- Quick Actions -->
            <div class="nav-item">
                <a href="{{ route('librarian.quick') }}" class="nav-link {{ request()->routeIs('librarian.quick') ? 'active' : '' }}">
                    <i class="fas fa-bolt"></i> Quick Actions
                </a>
            </div>
        </div>

        <!-- Logout -->
        <div class="sidebar-footer">
            <div class="divider"></div>
            <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="main-content page-transition">
        @if(session('success'))
            <div class="alert-custom alert-success alert-dismissible fade show mb-3">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert-custom alert-danger alert-dismissible fade show mb-3">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('warning'))
            <div class="alert-custom alert-warning alert-dismissible fade show mb-3">
                <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarWrapper = document.getElementById('sidebarWrapper');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebarWrapper.classList.toggle('open');
            sidebarOverlay.classList.toggle('show');
            document.body.style.overflow = sidebarWrapper.classList.contains('open') ? 'hidden' : '';
        }

        sidebarToggle?.addEventListener('click', toggleSidebar);
        sidebarOverlay?.addEventListener('click', toggleSidebar);

        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                sidebarWrapper?.classList.remove('open');
                sidebarOverlay?.classList.remove('show');
                document.body.style.overflow = '';
            }
        });

        document.querySelectorAll('.sidebar-wrapper .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    sidebarWrapper?.classList.remove('open');
                    sidebarOverlay?.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        });

        document.querySelectorAll('.alert-custom').forEach(alert => {
            setTimeout(() => {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebarWrapper?.classList.contains('open')) {
                toggleSidebar();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
