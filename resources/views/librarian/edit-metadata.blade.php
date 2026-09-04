@extends('layouts.app')

@section('title', 'Edit Metadata')
@section('content')
<div class="container">
    <a href="{{ route('librarian.dashboard') }}" class="btn btn-secondary mb-3">← Back</a>

    <div class="card">
        <div class="card-header">
            <h3>✏️ Edit Metadata</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('librarian.metadata.update', $submission->id) }}">
                @csrf

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $submission->title }}" required>
                </div>

                <div class="mb-3">
                    <label>Abstract</label>
                    <textarea name="abstract" class="form-control" rows="3" required>{{ $submission->abstract }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control" rows="5" required>{{ $submission->content }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $submission->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_open_source" class="form-check-input" id="openSource" {{ $submission->is_open_source ? 'checked' : '' }}>
                    <label class="form-check-label" for="openSource">🔓 Open Access</label>
                </div>

                <button type="submit" class="btn btn-primary">Update Metadata</button>
                <a href="{{ route('librarian.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
