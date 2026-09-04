@extends('layouts.faculty')

@section('title', 'Pending Submissions')
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>⏳ Pending Submissions</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="fas fa-file-alt me-1"></i> {{ $submissions->total() }} pending
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
                        <p class="text-muted" style="font-size: 0.75rem;">
                            <i class="far fa-clock me-1"></i>
                            {{ $submission->submitted_at ? $submission->submitted_at->diffForHumans() : 'N/A' }}
                        </p>
                        <span class="badge bg-warning">⏳ Pending</span>
                        @if($submission->file_path)
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info ms-1">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        @endif
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('faculty.review', $submission->id) }}" class="btn btn-sm btn-primary w-100">
                            <i class="fas fa-edit me-1"></i> Review
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-check-circle" style="font-size: 2.5rem; display: block; margin-bottom: 15px;"></i>
                    <h5>All caught up!</h5>
                    <p class="text-muted">No pending submissions to review.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{ $submissions->links() }}

</div>
@endsection