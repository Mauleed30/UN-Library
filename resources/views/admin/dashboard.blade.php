@extends('layouts.admin')

@section('title', 'Dashboard')
@section('content')
<style>
    .stat-box {
        background: white;
        border-radius: 12px;
        padding: 18px 12px;
        text-align: center;
        border: 1px solid #eef2f7;
        transition: all 0.3s;
        height: 100%;
    }
    .stat-box:hover {
        border-color: #1a5276;
        transform: translateY(-4px);
        box-shadow: 0 6px 25px rgba(0,0,0,0.05);
    }
    .stat-box .number { font-size: 1.8rem; font-weight: 700; }
    .stat-box .label { font-size: 0.8rem; color: #6b7a8f; margin-top: 3px; }
    .stat-box.users .number { color: #3b82f6; }
    .stat-box.submissions .number { color: #8b5cf6; }
    .stat-box.pending .number { color: #f59e0b; }
    .stat-box.published .number { color: #10b981; }
    .stat-box.categories .number { color: #1a5276; }

    .quick-action-btn {
        padding: 18px 12px;
        border-radius: 12px;
        border: 1px solid #eef2f7;
        background: white;
        text-align: center;
        text-decoration: none;
        color: #1a2a3a;
        display: block;
        transition: all 0.3s;
        height: 100%;
    }
    .quick-action-btn:hover {
        border-color: #1a5276;
        background: #f0f4f8;
        transform: translateY(-4px);
        box-shadow: 0 6px 25px rgba(0,0,0,0.05);
        color: #1a5276;
    }
    .quick-action-btn i {
        font-size: 1.8rem;
        display: block;
        margin-bottom: 8px;
        color: #1a5276;
    }
    .quick-action-btn .title { font-weight: 600; font-size: 0.9rem; }
    .quick-action-btn .desc { font-size: 0.75rem; color: #6b7a8f; margin-top: 3px; }
</style>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📊 Admin Dashboard</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="far fa-calendar-alt me-1"></i> {{ now()->format('l, d M Y') }}
        </span>
    </div>

    <!-- Statistics -->
    @php
        $totalUsers = \App\Models\User::count();
        $totalSubmissions = \App\Models\Submission::count();
        $pendingSubmissions = \App\Models\Submission::where('status', 'pending')->count();
        $publishedSubmissions = \App\Models\Submission::where('status', 'published')->count();
        $totalCategories = \App\Models\Category::count();
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box users">
                <div class="number">{{ $totalUsers }}</div>
                <div class="label">👥 Total Users</div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box submissions">
                <div class="number">{{ $totalSubmissions }}</div>
                <div class="label">📋 Submissions</div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box pending">
                <div class="number">{{ $pendingSubmissions }}</div>
                <div class="label">⏳ Pending</div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box published">
                <div class="number">{{ $publishedSubmissions }}</div>
                <div class="label">📚 Published</div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box categories">
                <div class="number">{{ $totalCategories }}</div>
                <div class="label">📂 Categories</div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box" style="border-color: #ef4444;">
                <div class="number" style="color: #ef4444;">{{ \App\Models\Submission::where('status', 'rejected')->count() }}</div>
                <div class="label">❌ Rejected</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.users') }}" class="quick-action-btn">
                <i class="fas fa-users"></i>
                <div class="title">Manage Users</div>
                <div class="desc">Add, edit, delete users</div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.submissions') }}" class="quick-action-btn">
                <i class="fas fa-file-alt"></i>
                <div class="title">Submissions</div>
                <div class="desc">Manage all submissions</div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.categories') }}" class="quick-action-btn">
                <i class="fas fa-folder"></i>
                <div class="title">Categories</div>
                <div class="desc">Manage categories</div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.analytics') }}" class="quick-action-btn">
                <i class="fas fa-chart-bar"></i>
                <div class="title">Analytics</div>
                <div class="desc">View system analytics</div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong><i class="fas fa-clock me-2"></i> Recent Activity</strong>
            <a href="{{ route('admin.submissions') }}" class="btn btn-sm btn-outline-primary">
                View All <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="card-body p-0">
            @php $recent = \App\Models\Submission::latest()->take(5)->get(); @endphp
            @forelse($recent as $submission)
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                    <div>
                        <div style="font-weight: 500;">{{ Str::limit($submission->title, 40) }}</div>
                        <div style="font-size: 0.75rem; color: #6b7a8f;">
                            <i class="fas fa-user me-1"></i> {{ $submission->author }}
                            <span class="mx-1">•</span>
                            <i class="fas fa-tag me-1"></i> {{ $submission->category->name ?? 'Uncategorized' }}
                            <span class="mx-1">•</span>
                            <i class="far fa-clock me-1"></i> {{ $submission->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div>
                        @if($submission->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($submission->status == 'reviewed')
                            <span class="badge bg-primary">Reviewed</span>
                        @elseif($submission->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($submission->status == 'published')
                            <span class="badge bg-success">Published</span>
                        @elseif($submission->status == 'rejected')
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                        <a href="{{ route('submissions.show', $submission->id) }}" class="btn btn-sm btn-info ms-1">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
                    <p class="text-muted mt-2">No submissions yet</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
