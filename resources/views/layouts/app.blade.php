<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'University Repository')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f5f7fa; }

        .top-header {
            background: linear-gradient(135deg, #0d1b2a 0%, #1b2d45 50%, #1a3a5c 100%);
            padding: 14px 0 12px;
            border-bottom: 3px solid #d4a843;
            position: relative;
        }
        .top-header::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #d4a843, #f0d080, #d4a843);
        }

        .top-header .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .top-header .left-section {
            flex: 1;
        }
        .top-header .university-name {
            font-weight: 900;
            font-size: 1.6rem;
            color: #ffffff;
            letter-spacing: 2px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            line-height: 1.1;
        }
        .top-header .university-name .acronym {
            color: #d4a843;
            font-weight: 800;
        }
        .top-header .system-name {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.7);
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .top-header .system-name i {
            color: #d4a843;
            margin-right: 6px;
        }

        .top-header .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .top-header .nav-links .nav-link-custom {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }
        .top-header .nav-links .nav-link-custom:hover {
            background: rgba(255,255,255,0.1);
            color: #ffffff;
        }
        .top-header .nav-links .nav-link-custom i {
            margin-right: 8px;
            color: #d4a843;
        }
        .top-header .nav-links .nav-link-custom.btn-register {
            background: #d4a843;
            color: #0d1b2a;
            font-weight: 600;
            padding: 8px 24px;
        }
        .top-header .nav-links .nav-link-custom.btn-register:hover {
            background: #e8c860;
            color: #0d1b2a;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(212, 168, 67, 0.3);
        }

        .main-content {
            padding: 24px 0;
            min-height: calc(100vh - 120px);
        }

        @media (max-width: 992px) {
            .top-header .university-name { font-size: 1.3rem; }
            .top-header .system-name { font-size: 0.6rem; }
            .top-header .nav-links .nav-link-custom { font-size: 0.75rem; padding: 6px 14px; }
        }

        @media (max-width: 768px) {
            .top-header .header-content { flex-direction: column; align-items: center; text-align: center; gap: 8px; }
            .top-header .university-name { font-size: 1.1rem; }
            .top-header .system-name { font-size: 0.55rem; }
            .top-header .nav-links .nav-link-custom { font-size: 0.7rem; padding: 5px 12px; }
            .top-header .left-section { flex: none; width: 100%; }
        }

        @media (max-width: 480px) {
            .top-header { padding: 8px 0 6px; }
            .top-header .university-name { font-size: 0.9rem; }
            .top-header .system-name { font-size: 0.45rem; }
            .top-header .nav-links .nav-link-custom { font-size: 0.6rem; padding: 4px 10px; }
            .top-header .nav-links .nav-link-custom.btn-register { padding: 4px 14px; }
        }
    </style>
</head>
<body>

    <header class="top-header">
        <div class="container">
            <div class="header-content">
                <div class="left-section">
                    <div class="university-name">
                        UNIVERSITY <span class="acronym">REPOSITORY</span>
                    </div>
                    <div class="system-name">
                        <i class="fas fa-graduation-cap"></i> ACADEMIC REPOSITORY SYSTEM
                    </div>
                </div>

                <div class="nav-links">

                    @auth
                        <a href="{{ route('student.dashboard') }}" class="nav-link-custom">
                            <i class="fas fa-chart-pie"></i> Dashboard
                        </a>
                        <a href="#" class="nav-link-custom" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                    @else
                        <a href="{{ route('login') }}" class="nav-link-custom">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="nav-link-custom btn-register">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
