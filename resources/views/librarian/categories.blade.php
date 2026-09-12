@extends('layouts.librarian')

@section('title', 'Categories')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>📂 Manage Categories</h4>
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="fas fa-plus me-1"></i> Add Category
    </button>
</div>

<div class="row g-3">
    @forelse($categories as $category)
        <div class="col-md-3 col-6">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-folder" style="font-size: 2rem; color: #1a5276;"></i>
                    <h6 class="mt-2">{{ $category->name }}</h6>
                    <small class="text-muted">{{ $category->submissions()->count() }} submissions</small>
                    <div class="mt-2">
                        <form method="POST" action="{{ route('librarian.categories.delete', $category->id) }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">No categories found.</div>
        </div>
    @endforelse
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus me-2"></i> Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('librarian.categories.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-bold">Category Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
