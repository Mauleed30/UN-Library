@extends('layouts.student')

@section('title', 'Search Open Access')
@section('content')
<div class="container-fluid">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>🔍 Search Open Access</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="fas fa-file-alt me-1"></i>
            {{ $submissions->total() }} results found
        </span>
    </div>

    <!-- Search Form -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('student.search') }}">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-search text-primary"></i>
                            </span>
                            <input type="text" name="q" class="form-control"
                                   placeholder="Search by title, author, or keywords..."
                                   value="{{ request('q') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Results -->
    @if(request('q'))
        <div class="text-muted mb-2" style="font-size: 0.85rem;">
            <i class="fas fa-info-circle me-1"></i>
            Showing results for "<strong>{{ request('q') }}</strong>"
        </div>
    @endif

    <div class="row g-3">
        @forelse($submissions as $submission)
            <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($submission->title, 35) }}</h5>
                        <p class="card-text text-muted" style="font-size: 0.85rem;">
                            {{ Str::limit($submission->abstract, 100) }}
                        </p>
                        <div class="mb-2">
                            <span class="badge bg-success">🔓 Open Access</span>
                            <span class="badge bg-info">{{ $submission->category->name ?? 'Uncategorized' }}</span>
                        </div>
                        <p class="text-muted" style="font-size: 0.75rem;">
                            <i class="fas fa-user me-1"></i> {{ $submission->author }}
                            <span class="mx-1">•</span>
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ $submission->published_at ? \Carbon\Carbon::parse($submission->published_at)->format('d M Y') : 'N/A' }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('guest.view', $submission->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                        @if($submission->file_path)
                            <a href="{{ route('guest.download', $submission->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-download me-1"></i> Download
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-search" style="font-size: 2.5rem; display: block; margin-bottom: 15px;"></i>
                    <h5>No results found</h5>
                    <p class="text-muted">Try adjusting your search terms.</p>
                    <a href="{{ route('student.search') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-arrow-left me-1"></i> Clear Search
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $submissions->links() }}
    </div>

</div>
@endsection