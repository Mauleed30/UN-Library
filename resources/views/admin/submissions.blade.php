@extends('layouts.admin')

@section('title', 'Manage Submissions')
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📋 Manage Submissions</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="fas fa-file-alt me-1"></i> Total: {{ $submissions->total() }}
        </span>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr>
                                <td>{{ $submission->id }}</td>
                                <td>{{ Str::limit($submission->title, 30) }}</td>
                                <td>{{ $submission->author }}</td>
                                <td>{{ $submission->category->name ?? 'Uncategorized' }}</td>
                                <td>
                                    @if($submission->status == 'pending')
                                        <span class="badge bg-warning">⏳ Pending</span>
                                    @elseif($submission->status == 'reviewed')
                                        <span class="badge bg-primary">📋 Reviewed</span>
                                    @elseif($submission->status == 'approved')
                                        <span class="badge bg-success">✅ Approved</span>
                                    @elseif($submission->status == 'published')
                                        <span class="badge bg-success">📚 Published</span>
                                    @elseif($submission->status == 'rejected')
                                        <span class="badge bg-danger">❌ Rejected</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $submission->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $submission->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('submissions.show', $submission->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($submission->status == 'approved' && $submission->status != 'published')
                                        <a href="{{ route('librarian.publish', $submission->id) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-upload"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">
                                    <i class="fas fa-inbox" style="font-size: 1.5rem; display: block; margin-bottom: 5px;"></i>
                                    No submissions found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $submissions->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
