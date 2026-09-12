@extends('layouts.guest')

@section('content')
<style>
    /* ====================================================
       REGISTER PAGE - WIDESCREEN
    ==================================================== */
    .register-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0f4f8 0%, #dce3ea 50%, #c8d3df 100%);
        padding: 40px 30px;
        position: relative;
        overflow: hidden;
    }

    /* Decorative Circles */
    .register-wrapper .circle {
        position: absolute;
        border-radius: 50%;
        opacity: 0.05;
    }
    .register-wrapper .circle:nth-child(1) {
        width: 600px;
        height: 600px;
        background: #1a5276;
        top: -250px;
        right: -150px;
    }
    .register-wrapper .circle:nth-child(2) {
        width: 350px;
        height: 350px;
        background: #1a5276;
        bottom: -100px;
        left: -100px;
    }
    .register-wrapper .circle:nth-child(3) {
        width: 180px;
        height: 180px;
        background: #1a5276;
        top: 20%;
        left: 70%;
    }

    /* ====================================================
       REGISTER CARD - WIDE
    ==================================================== */
    .register-card {
        background: white;
        border-radius: 28px;
        box-shadow: 0 40px 100px rgba(0,0,0,0.08);
        max-width: 820px;
        width: 100%;
        padding: 50px 55px 45px;
        position: relative;
        z-index: 2;
        transition: transform 0.3s ease;
        max-height: 95vh;
        overflow-y: auto;
    }
    .register-card::-webkit-scrollbar {
        width: 4px;
    }
    .register-card::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 10px;
    }
    .register-card::-webkit-scrollbar-track {
        background: transparent;
    }
    .register-card:hover {
        transform: translateY(-3px);
    }

    /* Brand Icon */
    .register-card .brand-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #1a5276, #2c6b9e);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2.2rem;
        color: white;
        box-shadow: 0 12px 35px rgba(26, 82, 118, 0.2);
    }

    /* Titles */
    .register-card .title {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 700;
        color: #1a2a3a;
        margin-bottom: 4px;
        letter-spacing: -0.5px;
    }
    .register-card .subtitle {
        text-align: center;
        font-size: 1rem;
        color: #6b7a8f;
        margin-bottom: 30px;
    }

    /* ====================================================
       FORM ELEMENTS - LARGE
    ==================================================== */
    .register-card .form-group {
        margin-bottom: 20px;
    }
    .register-card .form-group label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #1a2a3a;
        margin-bottom: 6px;
        display: block;
    }
    .register-card .form-group label .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .register-card .form-group .input-wrapper {
        position: relative;
    }
    .register-card .form-group .input-wrapper .input-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7a8f;
        font-size: 1.1rem;
        transition: color 0.3s;
        pointer-events: none;
    }
    .register-card .form-group .input-wrapper .form-control {
        width: 100%;
        padding: 15px 20px 15px 52px;
        border: 2px solid #eef2f7;
        border-radius: 14px;
        font-size: 1rem;
        transition: all 0.3s;
        background: #f8fafc;
        color: #1a2a3a;
        height: 58px;
    }
    .register-card .form-group .input-wrapper .form-control:focus {
        border-color: #1a5276;
        background: white;
        box-shadow: 0 0 0 5px rgba(26, 82, 118, 0.08);
        outline: none;
    }
    .register-card .form-group .input-wrapper .form-control.is-invalid {
        border-color: #ef4444;
        background: #fff5f5;
    }
    .register-card .form-group .input-wrapper .form-control.is-invalid:focus {
        box-shadow: 0 0 0 5px rgba(239, 68, 68, 0.08);
    }
    .register-card .form-group .input-wrapper .form-control::placeholder {
        color: #9ca3af;
        font-size: 0.95rem;
    }

    .register-card .form-group .input-wrapper select.form-control {
        padding-right: 45px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='9' viewBox='0 0 14 9'%3E%3Cpath d='M1 1l6 6 6-6' stroke='%236b7a8f' stroke-width='2' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 18px center;
        cursor: pointer;
    }

    /* Toggle Password */
    .register-card .form-group .input-wrapper .toggle-password {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7a8f;
        cursor: pointer;
        padding: 0;
        font-size: 1.1rem;
        transition: color 0.3s;
    }
    .register-card .form-group .input-wrapper .toggle-password:hover {
        color: #1a2a3a;
    }

    /* Validation Feedback */
    .register-card .form-group .invalid-feedback {
        font-size: 0.8rem;
        color: #ef4444;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ====================================================
       ROLE SELECTION - VISUAL CARDS
    ==================================================== */
    .register-card .role-selection {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }
    .register-card .role-selection .role-option {
        border: 2px solid #eef2f7;
        border-radius: 16px;
        padding: 18px 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: #f8fafc;
    }
    .register-card .role-selection .role-option:hover {
        border-color: #1a5276;
        background: #f0f4f8;
        transform: translateY(-2px);
    }
    .register-card .role-selection .role-option.selected {
        border-color: #1a5276;
        background: #e8f0fe;
        box-shadow: 0 0 0 4px rgba(26, 82, 118, 0.08);
    }
    .register-card .role-selection .role-option .icon {
        font-size: 1.8rem;
        display: block;
        margin-bottom: 6px;
    }
    .register-card .role-selection .role-option .name {
        font-size: 0.85rem;
        font-weight: 600;
        color: #1a2a3a;
    }
    .register-card .role-selection .role-option input[type="radio"] {
        display: none;
    }

    /* ====================================================
       STUDENT FIELDS
    ==================================================== */
    .register-card .student-fields {
        background: #f8fafc;
        border-radius: 16px;
        padding: 20px 22px;
        margin-bottom: 20px;
        border: 1px solid #eef2f7;
        display: none;
    }
    .register-card .student-fields.show {
        display: block;
        animation: fadeSlideDown 0.35s ease;
    }
    @keyframes fadeSlideDown {
        from {
            opacity: 0;
            transform: translateY(-12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .register-card .student-fields .section-title {
        font-weight: 600;
        font-size: 0.95rem;
        color: #1a5276;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .register-card .student-fields .section-title i {
        font-size: 1rem;
    }

    /* ====================================================
       STUDENT ID PREVIEW
    ==================================================== */
    .register-card .student-id-preview {
        background: #e8f0fe;
        border-radius: 12px;
        padding: 12px 18px;
        font-size: 0.9rem;
        color: #1a5276;
        border: 1px solid #b3d4fc;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 12px;
    }
    .register-card .student-id-preview i {
        font-size: 1.2rem;
        color: #1a5276;
    }
    .register-card .student-id-preview strong {
        font-weight: 700;
    }

    /* ====================================================
       SUBMIT BUTTON
    ==================================================== */
    .register-card .btn-register {
        width: 100%;
        padding: 17px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, #1a5276, #2c6b9e);
        color: white;
        font-size: 1.05rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 8px 30px rgba(26, 82, 118, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-top: 6px;
        height: 60px;
    }
    .register-card .btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 45px rgba(26, 82, 118, 0.3);
    }
    .register-card .btn-register:active {
        transform: translateY(0);
    }
    .register-card .btn-register .spinner {
        display: none;
        width: 22px;
        height: 22px;
        border: 2px solid rgba(255,255,255,0.3);
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    .register-card .btn-register.loading .spinner {
        display: inline-block;
    }
    .register-card .btn-register.loading .btn-text {
        opacity: 0.8;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* ====================================================
       FOOTER
    ==================================================== */
    .register-card .footer-text {
        text-align: center;
        margin-top: 22px;
        font-size: 0.95rem;
        color: #6b7a8f;
    }
    .register-card .footer-text a {
        color: #1a5276;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }
    .register-card .footer-text a:hover {
        color: #0d3b5e;
        text-decoration: underline;
    }

    /* ====================================================
       ALERTS
    ==================================================== */
    .register-card .alert-custom {
        padding: 14px 18px;
        border-radius: 14px;
        font-size: 0.9rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid transparent;
    }
    .register-card .alert-custom.alert-danger {
        background: #fef2f2;
        color: #991b1b;
        border-color: #fecaca;
    }

    /* ====================================================
       RESPONSIVE - WIDESCREEN
    ==================================================== */
    @media (max-width: 992px) {
        .register-card {
            max-width: 680px;
            padding: 40px 35px;
        }
        .register-card .title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .register-wrapper {
            padding: 20px 15px;
        }
        .register-card {
            padding: 30px 24px;
            border-radius: 20px;
            max-height: 98vh;
        }
        .register-card .title {
            font-size: 1.3rem;
        }
        .register-card .brand-icon {
            width: 60px;
            height: 60px;
            font-size: 1.6rem;
        }
        .register-card .form-group .input-wrapper .form-control {
            padding: 12px 16px 12px 44px;
            font-size: 0.95rem;
            height: 50px;
        }
        .register-card .role-selection {
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }
        .register-card .role-selection .role-option {
            padding: 12px 8px;
        }
        .register-card .role-selection .role-option .icon {
            font-size: 1.4rem;
        }
        .register-card .role-selection .role-option .name {
            font-size: 0.75rem;
        }
        .register-card .btn-register {
            height: 52px;
            font-size: 0.95rem;
        }
        .register-card .student-fields {
            padding: 16px 16px;
        }
        .register-card .subtitle {
            font-size: 0.9rem;
        }
        .register-card .student-id-preview {
            font-size: 0.8rem;
            padding: 10px 14px;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 480px) {
        .register-card {
            padding: 20px 16px;
            border-radius: 16px;
        }
        .register-card .title {
            font-size: 1.1rem;
        }
        .register-card .brand-icon {
            width: 50px;
            height: 50px;
            font-size: 1.3rem;
        }
        .register-card .form-group .input-wrapper .form-control {
            padding: 10px 14px 10px 40px;
            font-size: 0.9rem;
            height: 46px;
        }
        .register-card .role-selection {
            grid-template-columns: 1fr 1fr;
        }
        .register-card .btn-register {
            height: 48px;
            font-size: 0.9rem;
        }
        .register-card .form-group label {
            font-size: 0.8rem;
        }
        .register-card .form-group .input-wrapper .input-icon {
            left: 14px;
            font-size: 0.9rem;
        }
        .register-card .student-id-preview {
            font-size: 0.75rem;
            padding: 8px 12px;
        }
        .register-card .subtitle {
            font-size: 0.8rem;
            margin-bottom: 20px;
        }
        .register-card .footer-text {
            font-size: 0.8rem;
        }
    }
</style>

<div class="register-wrapper">
    <!-- Decorative Circles -->
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>

    <!-- Register Card -->
    <div class="register-card" id="registerCard">
        <!-- Brand Icon -->
        <div class="brand-icon">
            <i class="fas fa-user-plus"></i>
        </div>

        <!-- Title -->
        <div class="title">Create Account</div>
        <div class="subtitle">Join the University Repository</div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert-custom alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                Please fix the errors below.
            </div>
        @endif

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <!-- Full Name -->
            <div class="form-group">
                <label>Full Name <span class="required">*</span></label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-user"></i></span>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="e.g., John Doe" required>
                    @error('name')
                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email Address <span class="required">*</span></label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="you@example.com" required>
                    @error('email')
                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Username -->
            <div class="form-group">
                <label>Username (Registration Number) <span class="required">*</span></label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-id-card"></i></span>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username') }}" placeholder="e.g., BACH0001" required>
                    @error('username')
                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label>Password <span class="required">*</span></label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Enter password" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password', 'toggleIcon1')">
                        <i class="fas fa-eye" id="toggleIcon1"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label>Confirm Password <span class="required">*</span></label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                           placeholder="Confirm password" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                        <i class="fas fa-eye" id="toggleIcon2"></i>
                    </button>
                </div>
            </div>

            <!-- Role Selection -->
            <div class="form-group">
                <label>Register as <span class="required">*</span></label>
                <div class="role-selection" id="roleSelection">
                    <label class="role-option" data-role="1">
                        <input type="radio" name="role_id" value="1">

                        <span class="name">Student</span>
                    </label>
                    <label class="role-option" data-role="2">
                        <input type="radio" name="role_id" value="2">

                        <span class="name">Lecturer</span>
                    </label>
                    <label class="role-option" data-role="3">
                        <input type="radio" name="role_id" value="3">

                        <span class="name">Librarian</span>
                    </label>
                </div>
                @error('role_id')
                    <div class="invalid-feedback" style="display:block; margin-top:4px;">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Student Fields -->
            <div class="student-fields" id="studentFields">
                <div class="section-title">
                    <i class="fas fa-graduation-cap"></i> Student Information
                </div>

                <div class="form-group">
                    <label>Program of Study <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <span class="input-icon"><i class="fas fa-book"></i></span>
                        <select name="program" class="form-control" id="programSelect">
                            <option value="">Select Program</option>
                            <option value="CERT">Certificate</option>
                            <option value="DIP">Diploma</option>
                            <option value="BACH">Bachelor</option>
                            <option value="MEST">Master</option>
                            <option value="PHD">PhD</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Department <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <span class="input-icon"><i class="fas fa-building"></i></span>
                        <input type="text" name="department" class="form-control" placeholder="e.g., Computer Science">
                    </div>
                </div>

                <div class="form-group">
                    <label>Year of Study <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
                        <select name="year_of_study" class="form-control">
                            <option value="Year 1">Year 1</option>
                            <option value="Year 2">Year 2</option>
                            <option value="Year 3">Year 3</option>
                            <option value="Year 4">Year 4</option>
                            <option value="Year 5">Year 5</option>
                        </select>
                    </div>
                </div>

                <!-- Student ID Preview -->
                <div class="student-id-preview">
                    <i class="fas fa-id-card"></i>
                    <span>
                        Student ID will be generated automatically as
                        <strong id="studentIdPreview">PROGRAM/0001/2026</strong>
                    </span>
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn-register" id="registerBtn">
                <span class="spinner"></span>
                <span class="btn-text"><i class="fas fa-user-plus me-2"></i> Create Account</span>
            </button>

            <!-- Footer -->
            <div class="footer-text">
                Already have an account? <a href="{{ route('login') }}">Sign In</a>
            </div>
        </form>
    </div>
</div>

<script>
    // ====================================================
    // TOGGLE PASSWORD
    // ====================================================
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

    // ====================================================
    // ROLE SELECTION
    // ====================================================
    document.querySelectorAll('.role-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.role-option').forEach(o => o.classList.remove('selected'));
            this.classList.add('selected');
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;

            const studentFields = document.getElementById('studentFields');
            if (radio.value === '1') {
                studentFields.classList.add('show');
            } else {
                studentFields.classList.remove('show');
            }
        });
    });

    // ====================================================
    // STUDENT ID PREVIEW
    // ====================================================
    document.getElementById('programSelect').addEventListener('change', function() {
        const preview = document.getElementById('studentIdPreview');
        if (this.value) {
            const year = new Date().getFullYear();
            preview.textContent = this.value + '/0001/' + year;
        } else {
            preview.textContent = 'PROGRAM/0001/2026';
        }
    });

    // ====================================================
    // LOADING STATE
    // ====================================================
    document.getElementById('registerForm').addEventListener('submit', function() {
        const btn = document.getElementById('registerBtn');
        btn.classList.add('loading');
        btn.querySelector('.btn-text').textContent = 'Creating account...';
        btn.disabled = true;
    });
</script>
@endsection
