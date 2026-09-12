@extends('layouts.librarian')

@section('title', 'Submissions')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>📋 Submissions</h4>
    <span class="text-muted" style="font-size: 0.85rem;">
        <i class="fas fa-file-alt me-1"></i> Total: {{ $submissions->total() }}
    </span>
</div>

<div class="row g-3">
    @forelse($submissions as $submission)
        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ Str::limit($submission->title, 35) }}</h5>
                    <p class="card-text text-muted" style="font-size: 0.85rem;">
                        <i class="fas fa-user me-1"></i> {{ $submission->author }}
                        <span class="mx-1">•</span>
                        <i class="fas fa-tag me-1"></i> {{ $submission->category->name ?? 'Uncategorized' }}
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
                </div>
                <div class="card-footer bg-transparent">
                    @if($submission->status == 'reviewed')
                        <a href="{{ route('librarian.review', $submission->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit me-1"></i> Review
                        </a>
                    @endif
                    @if($submission->status == 'approved')
                        <a href="{{ route('librarian.publish', $submission->id) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-upload me-1"></i> Publish
                        </a>
                    @endif
                    <a href="{{ route('submissions.show', $submission->id) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-eye me-1"></i> View
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-4">
                <i class="fas fa-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                No submissions found.
            </div>
        </div>
    @endforelse
</div>

<div class="mt-3">
    {{ $submissions->links() }}
</div>
@endsection
