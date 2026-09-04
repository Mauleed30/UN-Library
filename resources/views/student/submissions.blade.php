@extends('layouts.student')

@section('title', 'My Submissions')
@section('content')
<div class="container-fluid">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📋 My Submissions</h4>
        <a href="{{ route('student.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> New Submission
        </a>
    </div>

    <!-- Submissions Grid -->
    <div class="row g-3">
        @forelse($submissions as $submission)
            <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($submission->title, 35) }}</h5>
                        <p class="card-text text-muted" style="font-size: 0.85rem;">
                            <i class="fas fa-tag me-1"></i>
                            {{ $submission->category->name ?? 'Uncategorized' }}
                        </p>
                        <div class="mb-2">
                            @if($submission->status == 'pending')
                                <span class="badge bg-warning">⏳ Pending</span>
                            @elseif($submission->status == 'reviewed')
                                <span class="badge bg-primary">📋 Reviewed</span>
                            @elseif($submission->status == 'approved')
                                <span class="badge bg-success">✅ Approved</span>
                            @elseif($submission->status == 'published')
                                <span class="badge bg-success">📚 Published</span>
                            @elseif($submission->status == 'rejected')
                                <span class="badge bg-danger">❌ Rejected</span>
                            @endif
                            @if($submission->is_open_source)
                                <span class="badge bg-success">🔓 Open</span>
                            @endif
                        </div>
                        <p class="text-muted" style="font-size: 0.75rem;">
                            <i class="far fa-clock me-1"></i>
                            {{ $submission->submitted_at ? $submission->submitted_at->diffForHumans() : 'N/A' }}
                        </p>
                        @if($submission->file_path)
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-file-pdf me-1"></i> View File
                            </a>
                        @endif
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('student.track', $submission->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-chart-line me-1"></i> Track
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 2.5rem; display: block; margin-bottom: 15px;"></i>
                    <h5>You haven't submitted any work yet</h5>
                    <p class="text-muted">Start by submitting your thesis, dissertation, or research paper.</p>
                    <a href="{{ route('student.create') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-plus me-1"></i> Submit Now
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $submissions->links() }}
    </div>

</div>
@endsection