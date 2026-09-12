@extends('layouts.librarian')

@section('title', 'Activity')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>📌 Recent Activity</h4>
</div>

<div class="card">
    <div class="card-body p-0">
        @forelse($activities as $activity)
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <div>
                    <div style="font-weight: 500;">{{ Str::limit($activity->title, 40) }}</div>
                    <div style="font-size: 0.75rem; color: #6b7a8f;">
                        <i class="fas fa-user me-1"></i> {{ $activity->author }}
                        <span class="mx-1">•</span>
                        <i class="far fa-clock me-1"></i> {{ $activity->reviewed_at ? $activity->reviewed_at->diffForHumans() : 'N/A' }}
                    </div>
                </div>
                <div>
                    @if($activity->status == 'approved')
                        <span class="badge bg-success">✅ Approved</span>
                    @elseif($activity->status == 'rejected')
                        <span class="badge bg-danger">❌ Rejected</span>
                    @elseif($activity->status == 'published')
                        <span class="badge bg-primary">📚 Published</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-4">
                <i class="fas fa-history text-muted" style="font-size: 2rem;"></i>
                <p class="text-muted mt-2">No recent activity</p>
            </div>
        @endforelse
    </div>
</div>

<div class="mt-3">
    {{ $activities->links() }}
</div>
@endsection
