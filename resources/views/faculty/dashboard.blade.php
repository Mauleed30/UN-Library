@extends('layouts.faculty')

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
    .stat-box.pending .number { color: #f59e0b; }
    .stat-box.reviewed .number { color: #8b5cf6; }
    .stat-box.approved .number { color: #10b981; }
    .stat-box.rejected .number { color: #ef4444; }
    .stat-box.supervisions .number { color: #1a5276; }

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
    .quick-action-btn .title {
        font-weight: 600;
        font-size: 0.9rem;
    }
    .quick-action-btn .desc {
        font-size: 0.75rem;
        color: #6b7a8f;
        margin-top: 3px;
    }
</style>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📊 Faculty Dashboard</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="far fa-calendar-alt me-1"></i> {{ now()->format('l, d M Y') }}
        </span>
    </div>

    <!-- Statistics -->
    @php
        $pending = \App\Models\Submission::where('status', 'pending')->count();
        $myPending = \App\Models\Submission::where('supervisor_id', auth()->id())->where('status', 'pending')->count();
        $reviewed = \App\Models\Submission::where('status', 'reviewed')->count();
        $mySupervisions = \App\Models\Submission::where('supervisor_id', auth()->id())->count();
        $approved = \App\Models\Submission::where('status', 'approved')->count();
        $rejected = \App\Models\Submission::where('status', 'rejected')->count();
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box pending">
                <div class="number">{{ $pending }}</div>
                <div class="label">⏳ Pending Review</div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box" style="border-color: #f59e0b;">
                <div class="number" style="color: #f59e0b;">{{ $myPending }}</div>
                <div class="label">📋 My Pending</div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box reviewed">
                <div class="number">{{ $reviewed }}</div>
                <div class="label">📋 Reviewed</div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box supervisions">
                <div class="number">{{ $mySupervisions }}</div>
                <div class="label">📝 Supervisions</div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-6">
            <div class="stat-box approved">
                <div class="number">{{ $approved }}</div>
                <div class="label">✅ Approved</div>
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
    <div class="row g-3 mb-4">
        <div class="col-md-4 col-6">
            <a href="{{ route('faculty.pending') }}" class="quick-action-btn">
                <i class="fas fa-clock"></i>
                <div class="title">Pending</div>
                <div class="desc">View pending submissions</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('faculty.submissions') }}" class="quick-action-btn">
                <i class="fas fa-edit"></i>
                <div class="title">Review</div>
                <div class="desc">Review student work</div>
            </a>
        </div>
        <div class="col-md-4 col-6">
            <a href="{{ route('faculty.assigned') }}" class="quick-action-btn">
                <i class="fas fa-users"></i>
                <div class="title">Supervisions</div>
                <div class="desc">My supervised submissions</div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong><i class="fas fa-clock me-2"></i> Recent Activity</strong>
            <a href="{{ route('faculty.submissions') }}" class="btn btn-sm btn-outline-primary">
                View All <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="card-body p-0">
            @php $recent = \App\Models\Submission::where('status', 'pending')->latest()->take(5)->get(); @endphp
            @forelse($recent as $submission)
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                    <div>
                        <div style="font-weight: 500;">{{ Str::limit($submission->title, 40) }}</div>
                        <div style="font-size: 0.75rem; color: #6b7a8f;">
                            <i class="fas fa-user me-1"></i> {{ $submission->author }}
                            <span class="mx-1">•</span>
                            <i class="far fa-clock me-1"></i>
                            {{ $submission->submitted_at ? $submission->submitted_at->diffForHumans() : 'N/A' }}
                        </div>
                    </div>
                    <div>
                        <span class="badge bg-warning">Pending</span>
                        <a href="{{ route('faculty.review', $submission->id) }}" class="btn btn-sm btn-primary ms-1">
                            <i class="fas fa-edit"></i> Review
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 2rem;"></i>
                    <p class="text-muted mt-2">All caught up! No pending submissions.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection