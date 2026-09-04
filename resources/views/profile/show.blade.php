@extends('layouts.profile')

@section('title', 'My Profile')
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>👤 My Profile</h4>
        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-edit me-1"></i> Edit Profile
        </a>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Profile Card -->
            <div class="card">
                <div class="card-body text-center">
                    <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #1a5276, #2c6b9e); color: white; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 700; margin: 0 auto 15px;">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <h5>{{ auth()->user()->name }}</h5>
                    <p class="text-muted">{{ auth()->user()->email }}</p>
                    <span class="badge bg-info">
                        @if(auth()->user()->role_id == 1) 🎓 Student
                        @elseif(auth()->user()->role_id == 2) 👨‍🏫 Lecturer
                        @elseif(auth()->user()->role_id == 3) 📚 Librarian
                        @elseif(auth()->user()->role_id == 4) ⚙️ Admin
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong><i class="fas fa-info-circle me-2"></i> Personal Information</strong>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Full Name</th>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ auth()->user()->username ?? 'Not set' }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                @if(auth()->user()->role_id == 1) 🎓 Student
                                @elseif(auth()->user()->role_id == 2) 👨‍🏫 Lecturer
                                @elseif(auth()->user()->role_id == 3) 📚 Librarian
                                @elseif(auth()->user()->role_id == 4) ⚙️ Administrator
                                @endif
                            </td>
                        </tr>
                        @if(auth()->user()->student_id)
                            <tr>
                                <th>Student ID</th>
                                <td>{{ auth()->user()->student_id }}</td>
                            </tr>
                            <tr>
                                <th>Program</th>
                                <td>{{ auth()->user()->program ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td>{{ auth()->user()->department ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Year of Study</th>
                                <td>{{ auth()->user()->year_of_study ?? 'N/A' }}</td>
                            </tr>
                        @endif
                        @if(auth()->user()->staff_id)
                            <tr>
                                <th>Staff ID</th>
                                <td>{{ auth()->user()->staff_id }}</td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td>{{ auth()->user()->department ?? 'N/A' }}</td>
                            </tr>
                            @if(auth()->user()->title)
                                <tr>
                                    <th>Title</th>
                                    <td>{{ auth()->user()->title }}</td>
                                </tr>
                            @endif
                            @if(auth()->user()->section)
                                <tr>
                                    <th>Section</th>
                                    <td>{{ auth()->user()->section }}</td>
                                </tr>
                            @endif
                        @endif
                        <tr>
                            <th>Joined</th>
                            <td>{{ auth()->user()->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection