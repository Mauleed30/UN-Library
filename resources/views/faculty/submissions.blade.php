@extends('layouts.faculty')

@section('title', 'Review')
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📝 Review Submissions</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="fas fa-file-alt me-1"></i> {{ $submissions->total() }} to review
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
                <div class="alert alert-success text-center py-5">
                    <i class="fas fa-check-circle" style="font-size: 2.5rem; display: block; margin-bottom: 15px; color: #10b981;"></i>
                    <h5>All reviewed!</h5>
                    <p class="text-muted">There are no submissions waiting for review.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{ $submissions->links() }}

</div>
@endsection