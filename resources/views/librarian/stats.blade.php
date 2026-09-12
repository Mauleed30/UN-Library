@extends('layouts.librarian')

@section('title', 'Statistics')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>📊 Repository Statistics</h4>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span><i class="fas fa-file-alt text-primary me-2"></i> Total Submissions</span>
                    <span class="fw-bold">{{ \App\Models\Submission::count() }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span><i class="fas fa-clock text-warning me-2"></i> Pending Review</span>
                    <span class="fw-bold text-warning">{{ \App\Models\Submission::where('status', 'reviewed')->count() }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span><i class="fas fa-check-circle text-success me-2"></i> Approved</span>
                    <span class="fw-bold text-success">{{ \App\Models\Submission::where('status', 'approved')->count() }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span><i class="fas fa-upload text-primary me-2"></i> Published</span>
                    <span class="fw-bold text-primary">{{ \App\Models\Submission::where('status', 'published')->count() }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span><i class="fas fa-lock-open text-success me-2"></i> Open Access</span>
                    <span class="fw-bold text-success">{{ \App\Models\Submission::where('is_open_source', true)->count() }}</span>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span><i class="fas fa-lock text-secondary me-2"></i> Restricted</span>
                    <span class="fw-bold text-secondary">{{ \App\Models\Submission::where('is_open_source', false)->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
