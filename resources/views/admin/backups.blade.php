@extends('layouts.admin')

@section('title', 'Backups')
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Manage Backups</h4>
        <a href="{{ route('admin.backups.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Create Backup
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Backup Name</th>
                            <th>Size</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($backups as $backup)
                            <tr>
                                <td><i class="fas fa-database me-2 text-primary"></i> {{ $backup['name'] }}</td>
                                <td>{{ $backup['size'] }}</td>
                                <td>{{ $backup['date'] }}</td>
                                <td>
                                    <a href="{{ route('admin.backups.download', $backup['name']) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.backups.delete', $backup['name']) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this backup?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    <i class="fas fa-database" style="font-size: 1.5rem; display: block; margin-bottom: 5px;"></i>
                                    No backups found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
