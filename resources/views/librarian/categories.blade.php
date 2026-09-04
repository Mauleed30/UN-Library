@extends('layouts.app')

@section('title', 'Manage Categories')
@section('content')
<div class="container">
    <h1>📂 Manage Categories</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Add New Category</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('librarian.categories.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">Add Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                @forelse($categories as $category)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>{{ $category->name }}</h5>
                                <div class="d-grid gap-2">
                                    <form method="POST" action="{{ route('librarian.categories.delete', $category->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Delete?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No categories found.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
