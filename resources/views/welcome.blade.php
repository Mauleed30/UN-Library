<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>University Repository Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            background: #f5f7fa;
        }

        /* Navigation */
        .navbar-custom {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.06);
            padding: 12px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .navbar-custom .navbar-brand {
            font-weight: 800;
            font-size: 1.2rem;
            color: #1a2a3a;
        }
        .navbar-custom .navbar-brand i {
            color: #1a5276;
        }
        .nav-link {
            color: #4a5568 !important;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
            padding: 8px 18px !important;
        }
        .nav-link:hover {
            color: #1a5276 !important;
        }
        .nav-btn {
            background: #1a5276;
            color: white !important;
            border-radius: 50px;
            padding: 8px 25px !important;
            transition: all 0.3s;
        }
        .nav-btn:hover {
            background: #154360 !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 82, 118, 0.3);
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 100px 0 80px;
            background: linear-gradient(135deg, #f0f4f8 0%, #dce3ea 50%, #c8d3df 100%);
            position: relative;
            overflow: hidden;
        }
        /* Decorative elements */
        .hero-section .deco-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(26, 82, 118, 0.05);
            z-index: 0;
        }
        .deco-circle:nth-child(1) {
            width: 400px;
            height: 400px;
            top: -100px;
            right: -100px;
        }
        .deco-circle:nth-child(2) {
            width: 250px;
            height: 250px;
            bottom: -50px;
            left: -50px;
        }
        .deco-circle:nth-child(3) {
            width: 150px;
            height: 150px;
            top: 20%;
            left: 40%;
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }

        .library-badge {
            display: inline-block;
            background: rgba(26, 82, 118, 0.12);
            color: #1a5276;
            padding: 6px 20px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            color: #1a2a3a;
            line-height: 1.1;
            margin-bottom: 20px;
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
            background: rgba(26, 82, 118, 0.15);
            border-radius: 5px;
        }
        .hero-subtitle {
            font-size: 1.1rem;
            color: #4a5568;
            line-height: 1.8;
            max-width: 550px;
            margin-bottom: 30px;
        }

        /* Library Features - Badges */
        .library-features {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 35px;
        }
        .library-feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            padding: 8px 18px;
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            font-size: 0.85rem;
            font-weight: 500;
            color: #1a2a3a;
        }
        .library-feature-item i {
            color: #1a5276;
            font-size: 0.9rem;
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

        /* Right Side - Library Illustration */
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
            box-shadow: 0 30px 80px rgba(0,0,0,0.08);
            position: relative;
        }
        .hero-illustration .icon-box i {
            font-size: 6rem;
            color: #1a5276;
            opacity: 0.9;
        }
        .hero-illustration .icon-box .label {
            margin-top: 15px;
            font-weight: 600;
            color: #1a2a3a;
            font-size: 1.1rem;
        }
        .hero-illustration .icon-box .sub-label {
            color: #6b7a8f;
            font-size: 0.9rem;
        }

        .floating-badge {
            position: absolute;
            background: white;
            border-radius: 16px;
            padding: 12px 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: float 3s ease-in-out infinite;
        }
        .floating-badge:nth-child(2) {
            top: 5%;
            right: -5%;
            animation-delay: 0s;
        }
        .floating-badge:nth-child(3) {
            bottom: 15%;
            left: -10%;
            animation-delay: 1.5s;
        }
        .floating-badge:nth-child(4) {
            top: 45%;
            right: -8%;
            animation-delay: 0.8s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .floating-badge .icon {
            width: 38px;
            height: 38px;
            background: rgba(26, 82, 118, 0.1);
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

        /* Stats Section */
        .stats-section {
            background: white;
            padding: 60px 0;
            border-top: 1px solid #eef2f7;
        }
        .stat-item {
            text-align: center;
        }
        .stat-item .number {
            font-size: 2.8rem;
            font-weight: 800;
            color: #1a5276;
        }
        .stat-item .label {
            color: #6b7a8f;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Footer */
        .footer {
            background: #1a2a3a;
            color: rgba(255,255,255,0.7);
            padding: 40px 0;
        }
        .footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer a:hover {
            color: white;
        }
        .footer .footer-brand {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
        }
        .footer .footer-brand i {
            color: #6ab0e6;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }
            .floating-badge {
                display: none !important;
            }
            .hero-section {
                padding: 80px 0 60px;
            }
            .hero-illustration .icon-box {
                padding: 30px 40px;
            }
            .hero-illustration .icon-box i {
                font-size: 4rem;
            }
        }
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            .btn-outline-custom {
                margin-left: 0;
                margin-top: 10px;
            }
            .library-features {
                gap: 8px;
            }
            .library-feature-item {
                padding: 6px 14px;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-university me-2"></i> UniRepository
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guest.catalogue') }}"><i class="fas fa-book me-1"></i> Catalogue</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.dashboard') }}"><i class="fas fa-chart-pie me-1"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-btn" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Decorative Circles -->
        <div class="deco-circle"></div>
        <div class="deco-circle"></div>
        <div class="deco-circle"></div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content">
                    <div class="library-badge">
                        <i class="fas fa-graduation-cap me-2"></i> UNIVERSITY LIBRARY
                    </div>
                    <h1 class="hero-title">
                        University Repository <br>
                        <span>Management System</span>
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

                        <!-- Floating Badges -->
                        <div class="floating-badge">
                            <div class="icon"><i class="fas fa-file-pdf"></i></div>
                            <div class="info">
                                <strong>5</strong>
                                <span>Submissions</span>
                            </div>
                        </div>
                        <div class="floating-badge">
                            <div class="icon"><i class="fas fa-users"></i></div>
                            <div class="info">
                                <strong>3</strong>
                                <span>Active Users</span>
                            </div>
                        </div>
                        <div class="floating-badge">
                            <div class="icon"><i class="fas fa-book-open"></i></div>
                            <div class="info">
                                <strong>9</strong>
                                <span>Resources</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 stat-item">
                    <div class="number">5</div>
                    <div class="label">📝 Total Submissions</div>
                </div>
                <div class="col-md-3 stat-item">
                    <div class="number">3</div>
                    <div class="label">👥 Active Users</div>
                </div>
                <div class="col-md-3 stat-item">
                    <div class="number">9</div>
                    <div class="label">📚 Resources Available</div>
                </div>
                <div class="col-md-3 stat-item">
                    <div class="number">90%</div>
                    <div class="label">⭐ Satisfaction Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
