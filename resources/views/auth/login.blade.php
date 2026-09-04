@extends('layouts.guest')

@section('content')
<style>
    /* ==================== LOGIN PAGE STYLES ==================== */
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0f4f8 0%, #dce3ea 50%, #c8d3df 100%);
        padding: 20px;
        position: relative;
        overflow: hidden;
    }

    /* Decorative Circles */
    .login-wrapper .circle {
        position: absolute;
        border-radius: 50%;
        opacity: 0.06;
    }
    .login-wrapper .circle:nth-child(1) {
        width: 500px;
        height: 500px;
        background: #1a5276;
        top: -200px;
        right: -100px;
    }
    .login-wrapper .circle:nth-child(2) {
        width: 300px;
        height: 300px;
        background: #1a5276;
        bottom: -100px;
        left: -50px;
    }
    .login-wrapper .circle:nth-child(3) {
        width: 150px;
        height: 150px;
        background: #1a5276;
        top: 30%;
        left: 60%;
    }

    /* ==================== LOGIN CARD ==================== */
    .login-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.10);
        max-width: 440px;
        width: 100%;
        padding: 45px 40px 40px;
        position: relative;
        z-index: 2;
        transition: transform 0.3s ease;
    }
    .login-card:hover {
        transform: translateY(-5px);
    }

    .login-card .brand-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #1a5276, #2c6b9e);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(26, 82, 118, 0.25);
    }

    .login-card .title {
        text-align: center;
        font-size: 1.6rem;
        font-weight: 700;
        color: #1a2a3a;
        margin-bottom: 5px;
    }
    .login-card .subtitle {
        text-align: center;
        font-size: 0.9rem;
        color: #6b7a8f;
        margin-bottom: 30px;
    }

    /* ==================== FORM ELEMENTS ==================== */
    .login-card .form-group {
        margin-bottom: 20px;
    }
    .login-card .form-group label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #1a2a3a;
        margin-bottom: 6px;
        display: block;
    }
    .login-card .form-group .input-wrapper {
        position: relative;
    }
    .login-card .form-group .input-wrapper .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7a8f;
        font-size: 1rem;
        transition: color 0.3s;
    }
    .login-card .form-group .input-wrapper .form-control {
        width: 100%;
        padding: 14px 18px 14px 48px;
        border: 2px solid #eef2f7;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.3s;
        background: #f8fafc;
        color: #1a2a3a;
    }
    .login-card .form-group .input-wrapper .form-control:focus {
        border-color: #1a5276;
        background: white;
        box-shadow: 0 0 0 4px rgba(26, 82, 118, 0.08);
        outline: none;
    }
    .login-card .form-group .input-wrapper .form-control.is-invalid {
        border-color: #ef4444;
        background: #fff5f5;
    }
    .login-card .form-group .input-wrapper .form-control.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.08);
    }
    .login-card .form-group .input-wrapper .toggle-password {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7a8f;
        cursor: pointer;
        padding: 0;
        font-size: 1rem;
    }
    .login-card .form-group .input-wrapper .toggle-password:hover {
        color: #1a2a3a;
    }
    .login-card .form-group .invalid-feedback {
        font-size: 0.8rem;
        color: #ef4444;
        margin-top: 5px;
    }

    /* ==================== OPTIONS ==================== */
    .login-card .options {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 18px 0 25px;
        flex-wrap: wrap;
        gap: 10px;
    }
    .login-card .options .form-check {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .login-card .options .form-check .form-check-input {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 2px solid #d1d5db;
        cursor: pointer;
        transition: all 0.3s;
    }
    .login-card .options .form-check .form-check-input:checked {
        background-color: #1a5276;
        border-color: #1a5276;
    }
    .login-card .options .form-check .form-check-label {
        font-size: 0.85rem;
        color: #4a5568;
        cursor: pointer;
    }
    .login-card .options .forgot-link {
        font-size: 0.85rem;
        color: #1a5276;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }
    .login-card .options .forgot-link:hover {
        color: #0d3b5e;
        text-decoration: underline;
    }

    /* ==================== BUTTON ==================== */
    .login-card .btn-login {
        width: 100%;
        padding: 15px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #1a5276, #2c6b9e);
        color: white;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 8px 25px rgba(26, 82, 118, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .login-card .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(26, 82, 118, 0.3);
    }
    .login-card .btn-login:active {
        transform: translateY(0);
    }
    .login-card .btn-login .spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255,255,255,0.3);
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    .login-card .btn-login.loading .spinner {
        display: inline-block;
    }
    .login-card .btn-login.loading .btn-text {
        opacity: 0.7;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* ==================== FOOTER ==================== */
    .login-card .footer-text {
        text-align: center;
        margin-top: 25px;
        font-size: 0.9rem;
        color: #6b7a8f;
    }
    .login-card .footer-text a {
        color: #1a5276;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }
    .login-card .footer-text a:hover {
        color: #0d3b5e;
        text-decoration: underline;
    }

    /* ==================== ALERT ==================== */
    .login-card .alert-custom {
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.85rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .login-card .alert-custom.alert-danger {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }
    .login-card .alert-custom.alert-success {
        background: #f0fdf4;
        color: #065f46;
        border: 1px solid #bbf7d0;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 480px) {
        .login-card {
            padding: 30px 24px 28px;
        }
        .login-card .title {
            font-size: 1.3rem;
        }
        .login-card .brand-icon {
            width: 60px;
            height: 60px;
            font-size: 1.6rem;
        }
        .login-card .form-group .input-wrapper .form-control {
            padding: 12px 16px 12px 44px;
            font-size: 0.9rem;
        }
        .login-card .options {
            flex-direction: column;
            align-items: flex-start;
        }
        .login-card .btn-login {
            padding: 13px;
            font-size: 0.9rem;
        }
        .login-card .footer-text {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 380px) {
        .login-card {
            padding: 20px 16px 20px;
        }
        .login-card .title {
            font-size: 1.1rem;
        }
        .login-card .brand-icon {
            width: 50px;
            height: 50px;
            font-size: 1.3rem;
        }
    }
</style>

<div class="login-wrapper">
    <!-- Decorative Circles -->
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>

    <!-- Login Card -->
    <div class="login-card">
        <!-- Brand Icon -->
        <div class="brand-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>

        <!-- Title -->
        <div class="title">Welcome Back</div>
        <div class="subtitle">Sign in to your account</div>

        <!-- Error/Success Messages -->
        @if(session('error'))
            <div class="alert-custom alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert-custom alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" placeholder="mauleed@gmail.com" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
  
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="••••••••" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="fas fa-eye" id="passwordToggleIcon"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Options -->
            <div class="options">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <a href="#" class="forgot-link">Forgot Password?</a>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login" id="loginBtn">
                <span class="spinner"></span>
                <span class="btn-text"><i class="fas fa-sign-in-alt me-2"></i> Sign In</span>
            </button>
       <!-- Footer -->
            <div class="footer-text">
                Don't have an account? <a href="{{ route('register') }}">Create one</a>
            </div>
        </form>
    </div>
</div>

<script>
    // ==================== TOGGLE PASSWORD ====================
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('passwordToggleIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // ==================== LOADING STATE ====================
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('loginBtn');
        btn.classList.add('loading');
        btn.querySelector('.btn-text').textContent = 'Signing in...';
        btn.disabled = true;
    });
</script>
@endsection