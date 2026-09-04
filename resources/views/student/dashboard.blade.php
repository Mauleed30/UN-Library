@extends('layouts.student')

@section('title', 'Dashboard')
@section('content')
<style>
    .stat-box {
        background: white;
        border-radius: 10px;
        padding: 15px 12px;
        text-align: center;
        border: 1px solid #eef2f7;
        transition: all 0.3s;
    }
    .stat-box:hover {
        border-color: #1a5276;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .stat-box .number { font-size: 1.8rem; font-weight: 700; color: #1a2a3a; }
    .stat-box .label { font-size: 0.8rem; color: #6b7a8f; margin-top: 3px; }
    .stat-box.pending .number { color: #f59e0b; }
    .stat-box.approved .number { color: #10b981; }
    .stat-box.published .number { color: #3b82f6; }
    .stat-box.rejected .number { color: #ef4444; }

    .quick-action-btn {
        padding: 15px 10px;
        border-radius: 10px;
        border: 1px solid #eef2f7;
        background: white;
        text-align: center;
        text-decoration: none;
        color: #1a2a3a;
        display: block;
        transition: all 0.3s;
    }
    .quick-action-btn:hover {
        border-color: #1a5276;
        background: #f0f4f8;
        transform: translateY(-3px);
        color: #1a5276;
    }
    .quick-action-btn i {
        font-size: 1.5rem;
        display: block;
        margin-bottom: 5px;
        color: #1a5276;
    }
</style>

@php
    $total = auth()->user()->submissions()->count();
    $pending = auth()->user()->submissions()->where('status', 'pending')->count();
    $reviewed = auth()->user()->submissions()->where('status', 'reviewed')->count();
    $approved = auth()->user()->submissions()->where('status', 'approved')->count();
    $published = auth()->user()->submissions()->where('status', 'published')->count();
    $rejected = auth()->user()->submissions()->where('status', 'rejected')->count();
@endphp

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>📊 Dashboard Overview</h4>
    <span class="text-muted">{{ now()->format('l, d M Y') }}</span>
</div>

<!-- Statistics -->
<div class="row g-2 mb-3">
    <div class="col-xl-2 col-lg-4 col-md-4 col-6">
        <div class="stat-box">
            <div class="number">{{ $total }}</div>
            <div class="label">📝 Total</div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-4 col-md-4 col-6">
        <div class="stat-box pending">
            <div class="number">{{ $pending }}</div>
            <div class="label">⏳ Pending</div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-4 col-md-4 col-6">
        <div class="stat-box" style="border-color: #8b5cf6;">
            <div class="number" style="color: #8b5cf6;">{{ $reviewed }}</div>
            <div class="label">📋 Reviewed</div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-4 col-md-4 col-6">
        <div class="stat-box approved">
            <div class="number">{{ $approved }}</div>
            <div class="label">✅ Approved</div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-4 col-md-4 col-6">
        <div class="stat-box published">
            <div class="number">{{ $published }}</div>
            <div class="label">📚 Published</div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-4 col-md-4 col-6">
        <div class="stat-box rejected">
            <div class="number">{{ $rejected }}</div>
            <div class="label">❌ Rejected</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-2">
    <div class="col-md-4 col-6">
        <a href="{{ route('student.create') }}" class="quick-action-btn">
            <i class="fas fa-upload"></i> Submit New
        </a>
    </div>
    <div class="col-md-4 col-6">
        <a href="{{ route('student.submissions') }}" class="quick-action-btn">
            <i class="fas fa-list"></i> My Submissions
        </a>
    </div>
    <div class="col-md-4 col-6">
        <a href="{{ route('student.search') }}" class="quick-action-btn">
            <i class="fas fa-search"></i> Search Open Access
        </a>
    </div>
</div>

<!-- Recent Submissions -->
<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>📋 Recent Submissions</strong>
        <a href="{{ route('student.submissions') }}" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body">
        @php $recent = auth()->user()->submissions()->latest()->take(5)->get(); @endphp
        @forelse($recent as $item)
            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                <div>
                    <div style="font-weight: 500;">{{ Str::limit($item->title, 35) }}</div>
                    <small class="text-muted">{{ $item->submitted_at ? $item->submitted_at->diffForHumans() : 'N/A' }}</small>
                </div>
                <div>
                    @if($item->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($item->status == 'reviewed')
                        <span class="badge bg-primary">Reviewed</span>
                    @elseif($item->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($item->status == 'published')
                        <span class="badge bg-success">Published</span>
                    @elseif($item->status == 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                    <a href="{{ route('student.track', $item->id) }}" class="btn btn-sm btn-info">Track</a>
                </div>
            </div>
        @empty
            <p class="text-muted text-center py-2">No submissions yet. <a href="{{ route('student.create') }}">Submit now</a></p>
        @endforelse
    </div>
</div>
@endsection
