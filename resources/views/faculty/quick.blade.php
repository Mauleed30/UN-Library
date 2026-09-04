@extends('layouts.faculty')

@section('title', 'Quick Actions')
@section('content')
<style>
    .quick-card {
        background: white;
        border-radius: 14px;
        padding: 25px 18px;
        border: 1px solid #eef2f7;
        transition: all 0.3s;
        text-align: center;
        text-decoration: none;
        color: #1a2a3a;
        display: block;
        height: 100%;
    }
    .quick-card:hover {
        border-color: #1a5276;
        transform: translateY(-6px);
        box-shadow: 0 10px 35px rgba(0,0,0,0.06);
        color: #1a5276;
    }
    .quick-card i {
        font-size: 2.2rem;
        color: #1a5276;
        display: block;
        margin-bottom: 12px;
    }
    .quick-card .title {
        font-weight: 600;
        font-size: 1rem;
    }
    .quick-card .desc {
        font-size: 0.8rem;
        color: #6b7a8f;
        margin-top: 5px;
    }
</style>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>⚡ Quick Actions</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="far fa-calendar-alt me-1"></i> {{ now()->format('l, d M Y') }}
        </span>
    </div>

    <div class="row g-3">
        <div class="col-md-4 col-6">
            <a href="{{ route('faculty.pending') }}" class="quick-card">
                <i class="fas fa-clock"></i>
                <div class="title">Pending</div>
                <div class="desc">View pending submissions</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('faculty.submissions') }}" class="quick-card">
                <i class="fas fa-edit"></i>
                <div class="title">Review</div>
                <div class="desc">Review student work</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('faculty.assigned') }}" class="quick-card">
                <i class="fas fa-users"></i>
                <div class="title">Supervisions</div>
                <div class="desc">My supervised submissions</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('faculty.track') }}" class="quick-card">
                <i class="fas fa-chart-line"></i>
                <div class="title">Track</div>
                <div class="desc">Track submission status</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('profile.show') }}" class="quick-card">
                <i class="fas fa-user"></i>
                <div class="title">Profile</div>
                <div class="desc">View your profile</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('faculty.dashboard') }}" class="quick-card">
                <i class="fas fa-home"></i>
                <div class="title">Dashboard</div>
                <div class="desc">Return to dashboard</div>
            </a>
        </div>
    </div>

</div>
@endsection