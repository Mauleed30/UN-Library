@extends('layouts.faculty')

@section('title', 'Review Submission')
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📋 Review Submission</h4>
        <a href="{{ route('faculty.submissions') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ $submission->title }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-user me-2"></i> Author</strong></p>
                            <p>{{ $submission->author }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-tag me-2"></i> Category</strong></p>
                            <p>{{ $submission->category->name ?? 'Uncategorized' }}</p>
                        </div>
                    </div>

                    <p><strong><i class="fas fa-align-left me-2"></i> Abstract</strong></p>
                    <p>{{ $submission->abstract }}</p>

                    <p><strong><i class="fas fa-file-alt me-2"></i> Content</strong></p>
                    <p>{{ $submission->content }}</p>

                    @if($submission->file_path)
                        <p><strong><i class="fas fa-paperclip me-2"></i> File</strong></p>
                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-info">
                            <i class="fas fa-file-pdf me-1"></i> View File
                        </a>
                        <a href="{{ asset('storage/' . $submission->file_path) }}" download class="btn btn-success">
                            <i class="fas fa-download me-1"></i> Download
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <strong><i class="fas fa-check-circle me-2"></i> Review Decision</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('faculty.endorse', $submission->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="fw-bold">Review Notes</label>
                            <textarea name="review_notes" class="form-control" rows="4"
                                      placeholder="Add your review comments..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Action</label>
                            <select name="action" class="form-control" required>
                                <option value="">Select Action</option>
                                <option value="endorse">✅ Endorse - Send to Librarian</option>
                                <option value="request_changes">🔄 Request Changes</option>
                                <option value="reject">❌ Reject</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-1"></i> Submit Review
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection