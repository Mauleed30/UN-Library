@extends('layouts.librarian')

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
    .quick-card i { font-size: 2.2rem; color: #1a5276; display: block; margin-bottom: 12px; }
    .quick-card .title { font-weight: 600; font-size: 1rem; }
    .quick-card .desc { font-size: 0.8rem; color: #6b7a8f; margin-top: 5px; }
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>⚡ Quick Actions</h4>
</div>

<div class="row g-3">
    <div class="col-md-4 col-6">
        <a href="{{ route('librarian.submissions') }}" class="quick-card">
            <i class="fas fa-file-alt"></i>
            <div class="title">Submissions</div>
            <div class="desc">Review submissions</div>
        </a>
    </div>
    <div class="col-md-4 col-6">
        <a href="{{ route('librarian.categories') }}" class="quick-card">
            <i class="fas fa-folder"></i>
            <div class="title">Categories</div>
            <div class="desc">Manage categories</div>
        </a>
    </div>
    <div class="col-md-4 col-6">
        <a href="{{ route('librarian.stats') }}" class="quick-card">
            <i class="fas fa-chart-bar"></i>
            <div class="title">Statistics</div>
            <div class="desc">View statistics</div>
        </a>
    </div>
    <div class="col-md-4 col-6">
        <a href="{{ route('librarian.access') }}" class="quick-card">
            <i class="fas fa-lock"></i>
            <div class="title">Access Level</div>
            <div class="desc">Set access levels</div>
        </a>
    </div>
    <div class="col-md-4 col-6">
        <a href="{{ route('librarian.activity') }}" class="quick-card">
            <i class="fas fa-history"></i>
            <div class="title">Activity</div>
            <div class="desc">View recent activity</div>
        </a>
    </div>
    <div class="col-md-4 col-6">
        <a href="{{ route('profile.show') }}" class="quick-card">
            <i class="fas fa-user"></i>
            <div class="title">Profile</div>
            <div class="desc">View your profile</div>
        </a>
    </div>
</div>
@endsection
