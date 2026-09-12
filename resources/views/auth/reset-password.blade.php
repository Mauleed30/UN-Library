@extends('layouts.guest')

@section('content')
<style>
    .reset-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0f4f8 0%, #dce3ea 50%, #c8d3df 100%);
        padding: 40px 20px;
        position: relative;
        overflow: hidden;
    }
    .reset-wrapper .circle {
        position: absolute;
        border-radius: 50%;
        opacity: 0.06;
    }
    .reset-wrapper .circle:nth-child(1) {
        width: 500px; height: 500px;
        background: #1a5276;
        top: -200px; right: -100px;
    }
    .reset-wrapper .circle:nth-child(2) {
        width: 300px; height: 300px;
        background: #1a5276;
        bottom: -100px; left: -50px;
    }
    .reset-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.10);
        max-width: 480px;
        width: 100%;
        padding: 45px 40px 40px;
        position: relative;
        z-index: 2;
    }
    .reset-card .brand-icon {
        width: 70px; height: 70px;
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
    .reset-card .title {
        text-align: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a2a3a;
        margin-bottom: 8px;
    }
    .reset-card .subtitle {
        text-align: center;
        font-size: 0.9rem;
        color: #6b7a8f;
        margin-bottom: 25px;
    }
    .reset-card .form-group { margin-bottom: 18px; }
    .reset-card .form-group label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #1a2a3a;
        margin-bottom: 6px;
        display: block;
    }
    .reset-card .form-group .input-wrapper { position: relative; }
    .reset-card .form-group .input-wrapper .input-icon {
        position: absolute;
        left: 16px; top: 50%;
        transform: translateY(-50%);
        color: #6b7a8f;
        font-size: 1rem;
    }
    .reset-card .form-group .input-wrapper .form-control {
        width: 100%;
        padding: 14px 18px 14px 48px;
        border: 2px solid #eef2f7;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.3s;
        background: #f8fafc;
        color: #1a2a3a;
    }
    .reset-card .form-group .input-wrapper .form-control:focus {
        border-color: #1a5276;
        background: white;
        box-shadow: 0 0 0 4px rgba(26, 82, 118, 0.08);
        outline: none;
    }
    .reset-card .form-group .input-wrapper .toggle-password {
        position: absolute;
        right: 16px; top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7a8f;
        cursor: pointer;
        padding: 0;
        font-size: 1rem;
    }
    .reset-card .btn-reset {
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
    }
    .reset-card .btn-reset:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(26, 82, 118, 0.3);
    }
    .reset-card .footer-text {
        text-align: center;
        margin-top: 20px;
        font-size: 0.9rem;
        color: #6b7a8f;
    }
    .reset-card .footer-text a {
        color: #1a5276;
        font-weight: 600;
        text-decoration: none;
    }
    .reset-card .alert-custom {
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.85rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .reset-card .alert-custom.alert-danger {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }
    @media (max-width: 480px) {
        .reset-card { padding: 30px 24px 28px; }
        .reset-card .title { font-size: 1.2rem; }
        .reset-card .brand-icon { width: 60px; height: 60px; font-size: 1.6rem; }
    }
</style>

<div class="reset-wrapper">
    <div class="circle"></div>
    <div class="circle"></div>

    <div class="reset-card">
        <div class="brand-icon">
            <i class="fas fa-lock"></i>
        </div>

        <div class="title">Reset Password</div>
        <div class="subtitle">Enter your new password below</div>

        @if($errors->any())
            <div class="alert-custom alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" value="{{ old('email', request('email')) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password', 'toggleIcon1')">
                        <i class="fas fa-eye" id="toggleIcon1"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                        <i class="fas fa-eye" id="toggleIcon2"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-reset">
                <i class="fas fa-save me-2"></i> Reset Password
            </button>

            <div class="footer-text">
                <a href="{{ route('login') }}"><i class="fas fa-arrow-left me-1"></i> Back to Login</a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection
