@extends('layouts.guest')

@section('content')
<div class="container">
    <a href="{{ route('guest.catalogue') }}" class="btn btn-secondary mb-3">← Back to Catalogue</a>

    <div class="card">
        <div class="card-body">
            <h1>{{ $submission->title }}</h1>
            <p><strong>Author:</strong> {{ $submission->author }}</p>
            <p><strong>Category:</strong> {{ $submission->category->name ?? 'Uncategorized' }}</p>

            @if($submission->published_at)
                <p><strong>Published:</strong> {{ \Carbon\Carbon::parse($submission->published_at)->format('d M Y') }}</p>
            @endif

            <hr>
            <h5>Abstract</h5>
            <p>{{ $submission->abstract }}</p>
            <h5>Content</h5>
            <p>{{ $submission->content }}</p>

            @if($submission->is_open_source)
                <span class="badge bg-success">🔓 Open Access</span>
                @if($submission->file_path)
                    <a href="{{ route('guest.download', $submission->id) }}" class="btn btn-primary mt-2">⬇ Download Full Document</a>
                @endif
            @else
                <span class="badge bg-secondary">🔒 Restricted Access</span>
                <p class="text-muted mt-2">This item is not available for download.</p>
            @endif
        </div>
    </div>
</div>
@endsection
