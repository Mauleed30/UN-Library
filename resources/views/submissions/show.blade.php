@extends('layouts.app')

@section('title', 'Submission Details')
@section('content')
<div class="container">
    <a href="{{ route('submissions.index') }}" class="btn btn-secondary mb-3">← Back</a>
    
    <div class="card">
        <div class="card-header">
            <h3>{{ $submission->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Author:</strong> {{ $submission->author }}</p>
            <p><strong>Category:</strong> {{ $submission->category->name ?? 'Uncategorized' }}</p>
            <p><strong>Supervisor:</strong> {{ $submission->supervisor->name ?? 'Not assigned' }}</p>
            
            @if($submission->status == 'pending')
                <span class="badge bg-warning">⏳ Pending Review</span>
            @elseif($submission->status == 'reviewed')
                <span class="badge bg-primary">📋 Reviewed by Supervisor</span>
            @elseif($submission->status == 'approved')
                <span class="badge bg-success">✅ Approved by Librarian</span>
            @elseif($submission->status == 'published')
                <span class="badge bg-success">📚 Published</span>
            @elseif($submission->status == 'rejected')
                <span class="badge bg-danger">❌ Rejected</span>
            @endif
            
            <hr>
            <h5>Abstract</h5>
            <p>{{ $submission->abstract }}</p>
            <h5>Content</h5>
            <p>{{ $submission->content }}</p>
            
            @if($submission->file_path)
                <p><strong>File:</strong> 
                    <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-sm btn-info">📄 View File</a>
                </p>
            @endif
            
            @if($submission->published_at)
                <p><strong>Published:</strong> {{ \Carbon\Carbon::parse($submission->published_at)->format('d M Y, H:i') }}</p>
            @endif
        </div>
    </div>
</div>
@endsection