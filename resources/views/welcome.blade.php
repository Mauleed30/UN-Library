<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>University Repository</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; }
        body { background: #f5f7fa; }

        /* ====================================================
           TOP HEADER
        ==================================================== */
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

        .top-header .left-section { flex: 1; }
        .top-header .university-name {
            font-weight: 900;
            font-size: 1.6rem;
            color: #ffffff;
            letter-spacing: 2px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            line-height: 1.1;
        }
        .top-header .university-name .acronym { color: #d4a843; font-weight: 800; }
        .top-header .system-name {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.7);
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .top-header .system-name i { color: #d4a843; margin-right: 6px; }

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
        .top-header .nav-links .nav-link-custom i { margin-right: 8px; color: #d4a843; }
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

        /* ====================================================
           HERO SECTION
        ==================================================== */
        .hero-section {
            min-height: 75vh;
            display: flex;
            align-items: center;
            padding: 60px 0 40px;
            background: linear-gradient(135deg, #f0f4f8 0%, #dce3ea 50%, #c8d3df 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-section .deco-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(26, 82, 118, 0.04);
            z-index: 0;
        }
        .deco-circle:nth-child(1) { width: 500px; height: 500px; top: -150px; right: -100px; }
        .deco-circle:nth-child(2) { width: 300px; height: 300px; bottom: -80px; left: -80px; }

        .hero-content { position: relative; z-index: 2; }

        .hero-badge {
            display: inline-block;
            background: rgba(26, 82, 118, 0.1);
            color: #1a5276;
            padding: 6px 20px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            color: #1a2a3a;
            line-height: 1.1;
            margin-bottom: 12px;
        }
        .hero-title span {
            color: #1a5276;
            position: relative;
        }
        .hero-title span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background: rgba(26, 82, 118, 0.12);
            border-radius: 5px;
        }

        .hero-subtitle {
            font-size: 1.05rem;
            color: #4a5568;
            line-height: 1.8;
            max-width: 550px;
            margin-bottom: 25px;
        }

        .btn-primary-custom {
            background: #1a5276;
            color: white;
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            border: none;
        }
        .btn-primary-custom:hover {
            background: #154360;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(26, 82, 118, 0.3);
        }

        .btn-outline-custom {
            background: transparent;
            color: #1a5276;
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            border: 2px solid #1a5276;
            transition: all 0.3s;
            margin-left: 15px;
        }
        .btn-outline-custom:hover {
            background: #1a5276;
            color: white;
            transform: translateY(-3px);
        }

        .hero-illustration {
            position: relative;
            z-index: 2;
            text-align: center;
        }
        .hero-illustration .icon-box {
            display: inline-block;
            background: white;
            border-radius: 24px;
            padding: 40px 50px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.06);
            position: relative;
        }
        .hero-illustration .icon-box i {
            font-size: 5rem;
            color: #1a5276;
            opacity: 0.9;
        }
        .hero-illustration .icon-box .label {
            margin-top: 12px;
            font-weight: 600;
            color: #1a2a3a;
            font-size: 1rem;
        }
        .hero-illustration .icon-box .sub-label {
            color: #6b7a8f;
            font-size: 0.85rem;
        }

        .floating-badge {
            position: absolute;
            background: white;
            border-radius: 16px;
            padding: 12px 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: float 3s ease-in-out infinite;
        }
        .floating-badge:nth-child(2) { top: 5%; right: -5%; animation-delay: 0s; }
        .floating-badge:nth-child(3) { bottom: 15%; left: -10%; animation-delay: 1.5s; }
        .floating-badge:nth-child(4) { top: 45%; right: -8%; animation-delay: 0.8s; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .floating-badge .icon {
            width: 38px;
            height: 38px;
            background: rgba(26, 82, 118, 0.08);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a5276;
            font-size: 1rem;
        }
        .floating-badge .info strong {
            display: block;
            color: #1a2a3a;
            font-size: 0.95rem;
        }
        .floating-badge .info span {
            color: #6b7a8f;
            font-size: 0.7rem;
        }

        /* ====================================================
           STATS SECTION
        ==================================================== */
        .stats-section {
            background: white;
            padding: 40px 0;
            border-top: 1px solid #eef2f7;
        }
        .stat-item { text-align: center; }
        .stat-item .number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a5276;
        }
        .stat-item .label {
            color: #6b7a8f;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* ====================================================
           FOOTER
        ==================================================== */
        .footer {
            background: #1a2a3a;
            color: rgba(255,255,255,0.7);
            padding: 30px 0;
        }
        .footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer a:hover { color: white; }
        .footer .footer-brand {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
        }
        .footer .footer-brand i { color: #d4a843; }

        /* ====================================================
           RESPONSIVE
        ==================================================== */
        @media (max-width: 992px) {
            .hero-title { font-size: 2.8rem; }
            .top-header .university-name { font-size: 1.3rem; }
            .top-header .nav-links .nav-link-custom { font-size: 0.75rem; padding: 6px 14px; }
            .floating-badge { display: none !important; }
        }

        @media (max-width: 768px) {
            .top-header .header-content { flex-direction: column; align-items: center; text-align: center; }
            .top-header .university-name { font-size: 1.1rem; }
            .top-header .system-name { font-size: 0.55rem; }
            .top-header .nav-links .nav-link-custom { font-size: 0.7rem; padding: 5px 12px; }
            .hero-title { font-size: 2.2rem; }
            .btn-outline-custom { margin-left: 0; margin-top: 10px; }
            .hero-subtitle { max-width: 100%; }
            .hero-illustration .icon-box { padding: 30px 35px; }
            .hero-illustration .icon-box i { font-size: 3.5rem; }
            .stat-item .number { font-size: 2rem; }
        }

        @media (max-width: 480px) {
            .top-header { padding: 8px 0 6px; }
            .top-header .university-name { font-size: 0.9rem; }
            .top-header .system-name { font-size: 0.45rem; }
            .top-header .nav-links .nav-link-custom { font-size: 0.6rem; padding: 4px 10px; }
            .hero-title { font-size: 1.8rem; }
            .hero-section { min-height: 60vh; padding: 40px 0; }
            .hero-illustration .icon-box { padding: 20px 25px; }
            .hero-illustration .icon-box i { font-size: 2.5rem; }
        }
    </style>
</head>
<body>

    <!-- ====================================================
    TOP HEADER
    ==================================================== -->
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
                    <a href="{{ route('guest.catalogue') }}" class="nav-link-custom">
                        <i class="fas fa-book"></i> Catalogue
                    </a>
                    @auth

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

    <!-- ====================================================
    HERO SECTION
    ==================================================== -->
    <section class="hero-section">
        <div class="deco-circle"></div>
        <div class="deco-circle"></div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content">
                    <div class="hero-badge">
                        <i class="fas fa-graduation-cap me-2"></i> UNIVERSITY LIBRARY
                    </div>
                    <h1 class="hero-title">
                        University <span>Repository</span> <br>
                        Management System
                    </h1>
                    <p class="hero-subtitle">
                        A comprehensive platform for managing academic submissions, theses, dissertations
                        and research papers. Streamline your academic workflow from submission to publication.
                    </p>

                    <div>
                        @auth
                            <a href="{{ route('student.dashboard') }}" class="btn-primary-custom">
                                <i class="fas fa-arrow-right me-2"></i> Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn-primary-custom">
                                <i class="fas fa-user-plus me-2"></i> Get Started
                            </a>
                            <a href="{{ route('login') }}" class="btn-outline-custom">
                                <i class="fas fa-sign-in-alt me-2"></i> Sign In
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="col-lg-5 hero-illustration d-none d-lg-block">
                    <div class="icon-box">
                        <i class="fas fa-university"></i>
                        <div class="label">University Library</div>
                        <div class="sub-label">Digital Repository</div>

                        <div class="floating-badge">
                            <div class="icon"><i class="fas fa-file-pdf"></i></div>
                            <div class="info">
                                <strong>6</strong>
                                <span>Submissions</span>
                            </div>
                        </div>
                        <div class="floating-badge">
                            <div class="icon"><i class="fas fa-users"></i></div>
                            <div class="info">
                                <strong>8</strong>
                                <span>Active Users</span>
                            </div>
                        </div>
                        <div class="floating-badge">
                            <div class="icon"><i class="fas fa-book-open"></i></div>
                            <div class="info">
                                <strong>9</strong>
                                <span>Categories</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
    STATS SECTION
    ==================================================== -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                @php
                    $published = \App\Models\Submission::where('status', 'published')->count();
                    $users = \App\Models\User::count();
                    $categories = \App\Models\Category::count();
                @endphp
                <div class="col-md-3 col-6 stat-item">
                    <div class="number">{{ $published }}</div>
                    <div class="label">Published Works</div>
                </div>
                <div class="col-md-3 col-6 stat-item">
                    <div class="number">{{ $users }}</div>
                    <div class="label">Active Users</div>
                </div>
                <div class="col-md-3 col-6 stat-item">
                    <div class="number">{{ $categories }}</div>
                    <div class="label">Categories</div>
                </div>
                <div class="col-md-3 col-6 stat-item">
                    <div class="number">98%</div>
                    <div class="label">Satisfaction</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
    FOOTER
    ==================================================== -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">
                        <span class="footer-brand"><i class="fas fa-university me-2"></i> UniRepository</span>
                        <span class="mx-2">|</span>
                        © {{ date('Y') }} University Repository Management System
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
