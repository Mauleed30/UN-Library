@extends('layouts.guest')

@section('content')
<style>
    .forgot-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0f4f8 0%, #dce3ea 50%, #c8d3df 100%);
        padding: 40px 20px;
        position: relative;
        overflow: hidden;
    }
    .forgot-wrapper .circle {
        position: absolute;
        border-radius: 50%;
        opacity: 0.06;
    }
    .forgot-wrapper .circle:nth-child(1) {
        width: 500px;
        height: 500px;
        background: #1a5276;
        top: -200px;
        right: -100px;
    }
    .forgot-wrapper .circle:nth-child(2) {
        width: 300px;
        height: 300px;
        background: #1a5276;
        bottom: -100px;
        left: -50px;
    }
    .forgot-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.10);
        max-width: 440px;
        width: 100%;
        padding: 45px 40px 40px;
        position: relative;
        z-index: 2;
    }
    .forgot-card .brand-icon {
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
    .forgot-card .title {
        text-align: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a2a3a;
        margin-bottom: 8px;
    }
    .forgot-card .subtitle {
        text-align: center;
        font-size: 0.9rem;
        color: #6b7a8f;
        margin-bottom: 25px;
        line-height: 1.6;
    }
    .forgot-card .form-group {
        margin-bottom: 20px;
    }
    .forgot-card .form-group label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #1a2a3a;
        margin-bottom: 6px;
        display: block;
    }
    .forgot-card .form-group .input-wrapper {
        position: relative;
    }
    .forgot-card .form-group .input-wrapper .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7a8f;
        font-size: 1rem;
    }
    .forgot-card .form-group .input-wrapper .form-control {
        width: 100%;
        padding: 14px 18px 14px 48px;
        border: 2px solid #eef2f7;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.3s;
        background: #f8fafc;
        color: #1a2a3a;
    }
    .forgot-card .form-group .input-wrapper .form-control:focus {
        border-color: #1a5276;
        background: white;
        box-shadow: 0 0 0 4px rgba(26, 82, 118, 0.08);
        outline: none;
    }
    .forgot-card .btn-reset {
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
    .forgot-card .btn-reset:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(26, 82, 118, 0.3);
    }
    .forgot-card .btn-reset .spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255,255,255,0.3);
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    .forgot-card .btn-reset.loading .spinner {
        display: inline-block;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .forgot-card .footer-text {
        text-align: center;
        margin-top: 20px;
        font-size: 0.9rem;
        color: #6b7a8f;
    }
    .forgot-card .footer-text a {
        color: #1a5276;
        font-weight: 600;
        text-decoration: none;
    }
    .forgot-card .footer-text a:hover {
        text-decoration: underline;
    }
    .forgot-card .alert-custom {
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.85rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .forgot-card .alert-custom.alert-success {
        background: #f0fdf4;
        color: #065f46;
        border: 1px solid #bbf7d0;
    }
    .forgot-card .alert-custom.alert-danger {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }
    @media (max-width: 480px) {
        .forgot-card {
            padding: 30px 24px 28px;
        }
        .forgot-card .title {
            font-size: 1.2rem;
        }
        .forgot-card .brand-icon {
            width: 60px;
            height: 60px;
            font-size: 1.6rem;
        }
    }
</style>

<div class="forgot-wrapper">
    <div class="circle"></div>
    <div class="circle"></div>

    <div class="forgot-card">
        <div class="brand-icon">
            <i class="fas fa-key"></i>
        </div>

        <div class="title">Forgot Password</div>
        <div class="subtitle">
            Enter your email address and we'll send you a link to reset your password.
        </div>

        @if(session('status'))
            <div class="alert-custom alert-success">
                <i class="fas fa-check-circle"></i> {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-custom alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" id="forgotForm">
            @csrf

            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" 
                           value="{{ old('email') }}" placeholder="you@example.com" required>
                </div>
            </div>

            <button type="submit" class="btn-reset" id="resetBtn">
                <span class="spinner"></span>
                <span class="btn-text"><i class="fas fa-paper-plane me-2"></i> Send Reset Link</span>
            </button>

            <div class="footer-text">
                <a href="{{ route('login') }}"><i class="fas fa-arrow-left me-1"></i> Back to Login</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('forgotForm').addEventListener('submit', function() {
        const btn = document.getElementById('resetBtn');
        btn.classList.add('loading');
        btn.querySelector('.btn-text').textContent = 'Sending...';
        btn.disabled = true;
    });
</script>
@endsection