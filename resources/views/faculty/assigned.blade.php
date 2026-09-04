@extends('layouts.faculty')

@section('title', 'My Supervisions')
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>👨‍🏫 My Supervisions</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="fas fa-users me-1"></i> {{ $submissions->total() }} assigned
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
                            @endif
                        </div>
                        <p class="text-muted" style="font-size: 0.75rem;">
                            <i class="far fa-clock me-1"></i>
                            {{ $submission->submitted_at ? $submission->submitted_at->diffForHumans() : 'N/A' }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('faculty.review', $submission->id) }}" class="btn btn-sm btn-info w-100">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 2.5rem; display: block; margin-bottom: 15px;"></i>
                    <h5>No supervisions</h5>
                    <p class="text-muted">You haven't been assigned any submissions yet.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{ $submissions->links() }}

</div>
@endsection