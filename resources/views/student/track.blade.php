@extends('layouts.student')

@section('title', 'Track Submission')
@section('content')
<div class="container-fluid">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📊 Track Submission</h4>
        <a href="{{ route('student.submissions') }}" class="btn btn-secondary">
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
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-user-graduate me-2"></i> Supervisor</strong></p>
                            <p>{{ $submission->supervisor->name ?? 'Not assigned' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-clock me-2"></i> Submitted</strong></p>
                            <p>{{ $submission->submitted_at ? $submission->submitted_at->format('d M Y, H:i') : 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <p><strong><i class="fas fa-flag me-2"></i> Current Status</strong></p>
                        @if($submission->status == 'pending')
                            <span class="badge bg-warning p-2" style="font-size: 1rem;">⏳ Pending Review</span>
                        @elseif($submission->status == 'reviewed')
                            <span class="badge bg-primary p-2" style="font-size: 1rem;">📋 Reviewed by Supervisor</span>
                        @elseif($submission->status == 'approved')
                            <span class="badge bg-success p-2" style="font-size: 1rem;">✅ Approved by Librarian</span>
                        @elseif($submission->status == 'published')
                            <span class="badge bg-success p-2" style="font-size: 1rem;">📚 Published</span>
                        @elseif($submission->status == 'rejected')
                            <span class="badge bg-danger p-2" style="font-size: 1rem;">❌ Rejected</span>
                        @endif
                    </div>

                    <!-- Workflow -->
                    <div class="mt-4">
                        <p><strong><i class="fas fa-route me-2"></i> Workflow Status</strong></p>
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-check-circle text-success me-2"></i> 1. Submitted</span>
                                <span class="badge bg-success">✓</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-user-graduate me-2"></i> 2. Supervisor Review</span>
                                @if($submission->status == 'pending')
                                    <span class="badge bg-warning">⏳</span>
                                @else
                                    <span class="badge bg-success">✓</span>
                                @endif
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-book me-2"></i> 3. Librarian Approval</span>
                                @if($submission->status == 'approved' || $submission->status == 'published')
                                    <span class="badge bg-success">✓</span>
                                @elseif($submission->status == 'reviewed')
                                    <span class="badge bg-warning">⏳</span>
                                @else
                                    <span class="badge bg-secondary">⏳</span>
                                @endif
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-globe me-2"></i> 4. Published</span>
                                @if($submission->status == 'published')
                                    <span class="badge bg-success">✓</span>
                                @else
                                    <span class="badge bg-secondary">⏳</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Review Notes -->
                    @if($submission->review_notes)
                        <div class="mt-3">
                            <p><strong><i class="fas fa-comment me-2"></i> Review Notes</strong></p>
                            <div class="alert alert-info">
                                {{ $submission->review_notes }}
                            </div>
                        </div>
                    @endif

                    <!-- File -->
                    @if($submission->file_path)
                        <div class="mt-3">
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-info">
                                <i class="fas fa-file-pdf me-1"></i> View File
                            </a>
                            <a href="{{ asset('storage/' . $submission->file_path) }}" download class="btn btn-success">
                                <i class="fas fa-download me-1"></i> Download
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <strong><i class="fas fa-info-circle me-2"></i> Quick Info</strong>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <strong>Status:</strong>
                        @if($submission->status == 'pending')
                            <span class="badge bg-warning d-block mt-1">Pending Review</span>
                        @elseif($submission->status == 'reviewed')
                            <span class="badge bg-primary d-block mt-1">Reviewed</span>
                        @elseif($submission->status == 'approved')
                            <span class="badge bg-success d-block mt-1">Approved</span>
                        @elseif($submission->status == 'published')
                            <span class="badge bg-success d-block mt-1">Published</span>
                        @elseif($submission->status == 'rejected')
                            <span class="badge bg-danger d-block mt-1">Rejected</span>
                        @endif
                    </div>
                    <hr>
                    <div class="mb-2">
                        <strong><i class="fas fa-calendar-alt me-1"></i> Submitted:</strong>
                        <span class="d-block">{{ $submission->submitted_at ? $submission->submitted_at->format('d M Y') : 'N/A' }}</span>
                    </div>
                    <div class="mb-2">
                        <strong><i class="fas fa-lock me-1"></i> Access:</strong>
                        <span class="d-block">
                            @if($submission->is_open_source)
                                <span class="badge bg-success">Open Access</span>
                            @else
                                <span class="badge bg-secondary">Restricted</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection