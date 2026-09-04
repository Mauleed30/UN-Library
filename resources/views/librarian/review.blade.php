@extends('layouts.app')

@section('title', 'Review Submission')
@section('content')
<div class="container">
    <a href="{{ route('librarian.dashboard') }}" class="btn btn-secondary mb-3">← Back</a>

    <div class="card">
        <div class="card-header">
            <h3>📋 Review Submission</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h4>{{ $submission->title }}</h4>
                    <p><strong>Author:</strong> {{ $submission->author }}</p>
                    <p><strong>Category:</strong> {{ $submission->category->name ?? 'Uncategorized' }}</p>
                    <p><strong>Abstract:</strong></p>
                    <p>{{ $submission->abstract }}</p>
                    <p><strong>Content:</strong></p>
                    <p>{{ $submission->content }}</p>

                    @if($submission->file_path)
                        <p><strong>File:</strong>
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-sm btn-info">📄 View File</a>
                        </p>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>✅ Decision</h5>
                            <form method="POST" action="{{ route('librarian.approve', $submission->id) }}">
                                @csrf

                                <div class="mb-3">
                                    <label>Review Notes</label>
                                    <textarea name="review_notes" class="form-control" rows="4"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Access Level</label>
                                    <select name="is_open_source" class="form-control">
                                        <option value="1" {{ $submission->is_open_source ? 'selected' : '' }}>🔓 Open Access</option>
                                        <option value="0" {{ !$submission->is_open_source ? 'selected' : '' }}>🔒 Restricted</option>
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" name="action" value="approve" class="btn btn-success">✅ Approve</button>
                                    <button type="submit" name="action" value="reject" class="btn btn-danger">❌ Reject</button>
                                    <a href="{{ route('librarian.edit-metadata', $submission->id) }}" class="btn btn-warning">✏️ Edit Metadata</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-grid gap-2">
    <button type="submit" name="action" value="approve" class="btn btn-success">✅ Approve</button>
    <button type="submit" name="action" value="reject" class="btn btn-danger">❌ Reject</button>
    <a href="{{ route('librarian.edit-metadata', $submission->id) }}" class="btn btn-warning">✏️ Edit Metadata</a>

    @if($submission->status == 'approved')
        <a href="{{ route('librarian.publish', $submission->id) }}" class="btn btn-primary">📚 Publish</a>
    @endif
</div>
@if($submission->file_path)
    <div class="mb-3">
        <label class="fw-bold">📄 File</label>
        <div class="d-flex gap-2 flex-wrap">
            <button onclick="viewFile(
                '{{ asset('storage/' . $submission->file_path) }}',
                '{{ $submission->title }}',
                '{{ pathinfo($submission->file_path, PATHINFO_EXTENSION) }}'
            )" class="btn btn-sm btn-info">
                <i class="fas fa-eye"></i> View File
            </button>
            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-sm btn-secondary">
                <i class="fas fa-download"></i> Download
            </a>
        </div>
    </div>
@endif
@endsection
