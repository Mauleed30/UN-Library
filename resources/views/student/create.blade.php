@extends('layouts.student')

@section('title', 'Submit New')
@section('content')
<div class="container-fluid">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📤 Submit New Work</h4>
        <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Enter title" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Abstract -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Abstract <span class="text-danger">*</span></label>
                            <textarea name="abstract" class="form-control @error('abstract') is-invalid @enderror"
                                      rows="3" placeholder="Enter abstract" required></textarea>
                            @error('abstract')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Content <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                                      rows="5" placeholder="Enter content" required></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Supervisor -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Supervisor/Lecturer <span class="text-danger">*</span></label>
                            <select name="supervisor_id" class="form-control @error('supervisor_id') is-invalid @enderror" required>
                                <option value="">Select Supervisor</option>
                                @foreach($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                @endforeach
                            </select>
                            @error('supervisor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Select your supervisor/lecturer for review</small>
                        </div>

                        <!-- File Upload -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Upload File (PDF/DOC)</label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                                   accept=".pdf,.doc,.docx">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Max file size: 10MB. Allowed: PDF, DOC, DOCX</small>
                        </div>

                        <!-- Open Source -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_open_source" class="form-check-input" id="openSource">
                            <label class="form-check-label" for="openSource">
                                <i class="fas fa-lock-open me-1"></i> Mark as Open Source
                            </label>
                            <br>
                            <small class="text-muted">Allow public to download this work</small>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Submit
                        </button>
                        <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Guidelines -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <strong><i class="fas fa-info-circle me-2"></i> Guidelines</strong>
                </div>
                <div class="card-body" style="font-size: 0.9rem;">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Ensure title is clear and descriptive
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Abstract should summarize your work
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Content must be original work
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Select appropriate category
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Choose your supervisor
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Upload PDF or DOC file
                        </li>
                        <li>
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Mark as Open Source if applicable
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection