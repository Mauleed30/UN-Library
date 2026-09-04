@extends('layouts.app')

@section('title', 'All Submissions')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>📋 All Submissions</h1>
        <a href="{{ route('librarian.dashboard') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="row">
        @forelse($submissions as $submission)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5>{{ $submission->title }}</h5>
                        <p>{{ Str::limit($submission->abstract, 100) }}</p>
                        <span class="badge bg-info">{{ $submission->category->name ?? 'Uncategorized' }}</span>

                        @if($submission->status == 'reviewed')
                            <span class="badge bg-warning">📋 Reviewed</span>
                        @elseif($submission->status == 'approved')
                            <span class="badge bg-success">✅ Approved</span>
                        @elseif($submission->status == 'rejected')
                            <span class="badge bg-danger">❌ Rejected</span>
                        @elseif($submission->status == 'published')
                            <span class="badge bg-success">📚 Published</span>
                        @endif

                        <p><small>By: {{ $submission->author }}</small></p>
                    </div>
                    <div class="card-footer">
                        @if($submission->status == 'reviewed')
                            <a href="{{ route('librarian.review', $submission->id) }}" class="btn btn-sm btn-primary">Review</a>
                        @endif

                        @if($submission->status == 'approved')
                            <a href="{{ route('librarian.publish', $submission->id) }}" class="btn btn-sm btn-success">📚 Publish</a>
                        @endif

                        <a href="{{ route('submissions.show', $submission->id) }}" class="btn btn-sm btn-info">View</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No submissions found.</div>
            </div>
        @endforelse
    </div>

    {{ $submissions->links() }}
</div>
@endsection
