<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Librarian Panel') - University Repository</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: #f0f4f8;
            min-height: 100vh;
        }

        /* ==================== TOP NAVBAR ==================== */
        .top-navbar {
            background: white;
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 65px;
        }
        .top-navbar .brand {
            font-weight: 700;
            font-size: 1.1rem;
            color: #1a2a3a;
            text-decoration: none;
        }
        .top-navbar .brand i {
            color: #1a5276;
        }
        .top-navbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .top-navbar .user-info .name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1a2a3a;
        }
        .top-navbar .user-info .role {
            font-size: 0.75rem;
            color: #6b7a8f;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar-wrapper {
            position: fixed;
            top: 65px;
            left: 0;
            bottom: 0;
            width: 260px;
            background: white;
            border-right: 1px solid #eef2f7;
            overflow-y: auto;
            padding: 20px 0;
            z-index: 1040;
            transition: transform 0.3s ease;
        }
        .sidebar-wrapper::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-wrapper::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .sidebar-wrapper .nav-item {
            padding: 0 12px;
            margin-bottom: 2px;
        }
        .sidebar-wrapper .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #4a5568;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }
        .sidebar-wrapper .nav-link:hover {
            background: #f0f4f8;
            color: #1a5276;
        }
        .sidebar-wrapper .nav-link.active {
            background: #1a5276;
            color: white;
            box-shadow: 0 4px 12px rgba(26, 82, 118, 0.25);
        }
        .sidebar-wrapper .nav-link.active i {
            color: white;
        }
        .sidebar-wrapper .nav-link i {
            width: 20px;
            font-size: 1.1rem;
            color: #6b7a8f;
            transition: color 0.3s;
        }
        .sidebar-wrapper .nav-link .badge-notif {
            margin-left: auto;
            background: #ef4444;
            color: white;
            font-size: 0.6rem;
            padding: 2px 8px;
            border-radius: 50px;
        }
        .sidebar-wrapper .nav-link .badge-notif.green {
            background: #10b981;
        }

        .sidebar-wrapper .divider {
            height: 1px;
            background: #eef2f7;
            margin: 8px 20px;
        }

        .sidebar-wrapper .sidebar-footer {
            padding: 0 20px;
            margin-top: 10px;
        }
        .sidebar-wrapper .sidebar-footer .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #ef4444;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }
        .sidebar-wrapper .sidebar-footer .logout-btn:hover {
            background: #fef2f2;
        }
        .sidebar-wrapper .sidebar-footer .logout-btn i {
            width: 20px;
            font-size: 1.1rem;
        }

        /* ==================== MAIN CONTENT ==================== */
        .main-content {
            margin-left: 260px;
            margin-top: 65px;
            padding: 20px;
            min-height: calc(100vh - 65px);
        }

        /* ==================== TOGGLE BUTTON (Mobile) ==================== */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #1a2a3a;
            cursor: pointer;
            padding: 5px;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 992px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
                width: 280px;
                box-shadow: 2px 0 20px rgba(0,0,0,0.1);
            }
            .sidebar-wrapper.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            .sidebar-toggle {
                display: block;
            }
            .top-navbar .brand span {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .top-navbar {
                padding: 8px 12px;
                height: 58px;
            }
            .main-content {
                margin-top: 58px;
                padding: 10px;
            }
            .sidebar-wrapper {
                width: 100%;
                max-width: 300px;
            }
            .top-navbar .user-info .name {
                font-size: 0.8rem;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 65px;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.3);
            z-index: 1039;
        }
        .sidebar-overlay.show {
            display: block;
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
            <a href="{{ route('librarian.dashboard') }}" class="brand">
                <i class="fas fa-university me-2"></i><span>Librarian Panel</span>
            </a>
        </div>
        <div class="user-info">
            <div class="text-end">
                <div class="name">{{ auth()->user()->name }}</div>
                <div class="role">📚 Librarian</div>
            </div>
            <div class="dropdown">
                <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown" style="width: 38px; height: 38px; padding: 0;">
                    <i class="fas fa-user"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-2"></i> My Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-cog me-2"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ==================== OVERLAY ==================== -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <div class="sidebar-wrapper" id="sidebarWrapper">
        <div class="nav-items">
            <!-- Dashboard -->
            <div class="nav-item">
                <a href="{{ route('librarian.dashboard') }}" class="nav-link {{ request()->routeIs('librarian.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </div>

            <!-- Submissions -->
            <div class="nav-item">
                <a href="{{ route('librarian.submissions') }}" class="nav-link {{ request()->routeIs('librarian.submissions') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i> Submissions
                    <span class="badge-notif">{{ \App\Models\Submission::where('status', 'reviewed')->count() }}</span>
                </a>
            </div>

            <!-- Review -->
            <div class="nav-item">
                <a href="{{ route('librarian.submissions') }}?status=pending" class="nav-link">
                    <i class="fas fa-edit"></i> Review
                    <span class="badge-notif">{{ \App\Models\Submission::where('status', 'reviewed')->count() }}</span>
                </a>
            </div>

            <!-- Approved -->
            <div class="nav-item">
                <a href="{{ route('librarian.submissions') }}?status=approved" class="nav-link">
                    <i class="fas fa-check-circle"></i> Approved
                    <span class="badge-notif green">{{ \App\Models\Submission::where('status', 'approved')->count() }}</span>
                </a>
            </div>

            <!-- Published -->
            <div class="nav-item">
                <a href="{{ route('librarian.submissions') }}?status=published" class="nav-link">
                    <i class="fas fa-upload"></i> Published
                    <span class="badge-notif green">{{ \App\Models\Submission::where('status', 'published')->count() }}</span>
                </a>
            </div>

            <!-- Rejected -->
            <div class="nav-item">
                <a href="{{ route('librarian.submissions') }}?status=rejected" class="nav-link">
                    <i class="fas fa-times-circle"></i> Rejected
                    <span class="badge-notif">{{ \App\Models\Submission::where('status', 'rejected')->count() }}</span>
                </a>
            </div>

            <div class="divider"></div>

            <!-- Access Level -->
            <div class="nav-item">
                <a href="{{ route('librarian.access') }}" class="nav-link">
                    <i class="fas fa-lock"></i> Access Level
                </a>
            </div>

            <!-- Categories -->
            <div class="nav-item">
                <a href="{{ route('librarian.categories') }}" class="nav-link">
                    <i class="fas fa-folder"></i> Categories
                </a>
            </div>

            <!-- Statistics -->
            <div class="nav-item">
                <a href="{{ route('librarian.stats') }}" class="nav-link">
                    <i class="fas fa-chart-bar"></i> Statistics
                </a>
            </div>

            <div class="divider"></div>

            <!-- Quick Actions -->
            <div class="nav-item">
                <a href="{{ route('librarian.quick') }}" class="nav-link">
                    <i class="fas fa-bolt"></i> Quick Actions
                </a>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="divider"></div>
            <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ==================== SIDEBAR TOGGLE (Mobile) ====================
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarWrapper = document.getElementById('sidebarWrapper');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebarWrapper.classList.toggle('open');
            sidebarOverlay.classList.toggle('show');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Close sidebar on window resize (when going to desktop)
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                sidebarWrapper.classList.remove('open');
                sidebarOverlay.classList.remove('show');
            }
        });

        // Close sidebar when clicking a link (mobile)
        document.querySelectorAll('.sidebar-wrapper .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    sidebarWrapper.classList.remove('open');
                    sidebarOverlay.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
