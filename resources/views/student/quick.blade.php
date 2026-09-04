@extends('layouts.student')

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

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>⚡ Quick Actions</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="far fa-calendar-alt me-1"></i> {{ now()->format('l, d M Y') }}
        </span>
    </div>

    <!-- Quick Actions Grid -->
    <div class="row g-3">
        <div class="col-md-4 col-6">
            <a href="{{ route('student.create') }}" class="quick-card">
                <i class="fas fa-upload"></i>
                <div class="title">Submit New</div>
                <div class="desc">Submit thesis or project</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('student.submissions') }}" class="quick-card">
                <i class="fas fa-list"></i>
                <div class="title">My Submissions</div>
                <div class="desc">View all your work</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('student.search') }}" class="quick-card">
                <i class="fas fa-search"></i>
                <div class="title">Search Open Access</div>
                <div class="desc">Find published works</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('student.submissions') }}" class="quick-card">
                <i class="fas fa-chart-line"></i>
                <div class="title">Track Status</div>
                <div class="desc">Check submission progress</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('profile.show') }}" class="quick-card">
                <i class="fas fa-user"></i>
                <div class="title">My Profile</div>
                <div class="desc">View profile information</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('student.dashboard') }}" class="quick-card">
                <i class="fas fa-home"></i>
                <div class="title">Dashboard</div>
                <div class="desc">Return to dashboard</div>
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="card mt-3">
        <div class="card-header">
            <strong><i class="fas fa-chart-bar me-2"></i> Your Activity Summary</strong>
        </div>
        <div class="card-body">
            @php
                $total = auth()->user()->submissions()->count();
                $pending = auth()->user()->submissions()->where('status', 'pending')->count();
                $reviewed = auth()->user()->submissions()->where('status', 'reviewed')->count();
                $approved = auth()->user()->submissions()->where('status', 'approved')->count();
                $published = auth()->user()->submissions()->where('status', 'published')->count();
                $rejected = auth()->user()->submissions()->where('status', 'rejected')->count();
            @endphp
            <div class="row text-center">
                <div class="col-2">
                    <div style="font-size: 1.5rem; font-weight: 700; color: #1a2a3a;">{{ $total }}</div>
                    <small class="text-muted">Total</small>
                </div>
                <div class="col-2">
                    <div style="font-size: 1.5rem; font-weight: 700; color: #f59e0b;">{{ $pending }}</div>
                    <small class="text-muted">Pending</small>
                </div>
                <div class="col-2">
                    <div style="font-size: 1.5rem; font-weight: 700; color: #8b5cf6;">{{ $reviewed }}</div>
                    <small class="text-muted">Reviewed</small>
                </div>
                <div class="col-2">
                    <div style="font-size: 1.5rem; font-weight: 700; color: #10b981;">{{ $approved }}</div>
                    <small class="text-muted">Approved</small>
                </div>
                <div class="col-2">
                    <div style="font-size: 1.5rem; font-weight: 700; color: #3b82f6;">{{ $published }}</div>
                    <small class="text-muted">Published</small>
                </div>
                <div class="col-2">
                    <div style="font-size: 1.5rem; font-weight: 700; color: #ef4444;">{{ $rejected }}</div>
                    <small class="text-muted">Rejected</small>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection