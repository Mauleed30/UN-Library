@extends('layouts.faculty')

@section('title', 'Track Submissions')
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📊 Track Submissions</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="far fa-calendar-alt me-1"></i> {{ now()->format('l, d M Y') }}
        </span>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>📌 Submission Workflow Status</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="border rounded p-3 text-center">
                        <div style="font-size: 1.5rem; font-weight: 700; color: #f59e0b;">
                            {{ \App\Models\Submission::where('status', 'pending')->count() }}
                        </div>
                        <div class="text-muted" style="font-size: 0.8rem;">
                            <i class="fas fa-clock me-1"></i> Pending
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-3 text-center">
                        <div style="font-size: 1.5rem; font-weight: 700; color: #8b5cf6;">
                            {{ \App\Models\Submission::where('status', 'reviewed')->count() }}
                        </div>
                        <div class="text-muted" style="font-size: 0.8rem;">
                            <i class="fas fa-check-circle me-1"></i> Reviewed
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-3 text-center">
                        <div style="font-size: 1.5rem; font-weight: 700; color: #10b981;">
                            {{ \App\Models\Submission::where('status', 'approved')->count() }}
                        </div>
                        <div class="text-muted" style="font-size: 0.8rem;">
                            <i class="fas fa-check-circle me-1"></i> Approved
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-3 text-center">
                        <div style="font-size: 1.5rem; font-weight: 700; color: #ef4444;">
                            {{ \App\Models\Submission::where('status', 'rejected')->count() }}
                        </div>
                        <div class="text-muted" style="font-size: 0.8rem;">
                            <i class="fas fa-times-circle me-1"></i> Rejected
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <strong>📋 Recent Activity</strong>
        </div>
        <div class="card-body p-0">
            @php $recent = \App\Models\Submission::where('status', 'pending')->orWhere('status', 'reviewed')->latest()->take(10)->get(); @endphp
            @foreach($recent as $submission)
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                    <div>
                        <div style="font-weight: 500;">{{ Str::limit($submission->title, 40) }}</div>
                        <div style="font-size: 0.75rem; color: #6b7a8f;">
                            <i class="fas fa-user me-1"></i> {{ $submission->author }}
                            <span class="mx-1">•</span>
                            <i class="far fa-clock me-1"></i>
                            {{ $submission->submitted_at ? $submission->submitted_at->diffForHumans() : 'N/A' }}
                        </div>
                    </div>
                    <div>
                        @if($submission->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($submission->status == 'reviewed')
                            <span class="badge bg-primary">Reviewed</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection