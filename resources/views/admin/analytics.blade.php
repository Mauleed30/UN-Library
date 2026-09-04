@extends('layouts.admin')

@section('title', 'Analytics')
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📊 Analytics</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="far fa-calendar-alt me-1"></i> {{ now()->format('l, d M Y') }}
        </span>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>📋 Submissions by Status</strong>
                </div>
                <div class="card-body">
                    @php
                        $pending = \App\Models\Submission::where('status', 'pending')->count();
                        $reviewed = \App\Models\Submission::where('status', 'reviewed')->count();
                        $approved = \App\Models\Submission::where('status', 'approved')->count();
                        $published = \App\Models\Submission::where('status', 'published')->count();
                        $rejected = \App\Models\Submission::where('status', 'rejected')->count();
                    @endphp
                    <div class="list-group">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-clock text-warning me-2"></i> Pending</span>
                            <span class="badge bg-warning rounded-pill">{{ $pending }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-edit text-primary me-2"></i> Reviewed</span>
                            <span class="badge bg-primary rounded-pill">{{ $reviewed }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-check-circle text-success me-2"></i> Approved</span>
                            <span class="badge bg-success rounded-pill">{{ $approved }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-upload text-info me-2"></i> Published</span>
                            <span class="badge bg-info rounded-pill">{{ $published }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-times-circle text-danger me-2"></i> Rejected</span>
                            <span class="badge bg-danger rounded-pill">{{ $rejected }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>👥 Users by Role</strong>
                </div>
                <div class="card-body">
                    @php
                        $students = \App\Models\User::where('role_id', 1)->count();
                        $lecturers = \App\Models\User::where('role_id', 2)->count();
                        $librarians = \App\Models\User::where('role_id', 3)->count();
                        $admins = \App\Models\User::where('role_id', 4)->count();
                    @endphp
                    <div class="list-group">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>🎓 Students</span>
                            <span class="badge bg-primary rounded-pill">{{ $students }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>👨‍🏫 Lecturers</span>
                            <span class="badge bg-warning rounded-pill">{{ $lecturers }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>📚 Librarians</span>
                            <span class="badge bg-info rounded-pill">{{ $librarians }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>⚙️ Admins</span>
                            <span class="badge bg-danger rounded-pill">{{ $admins }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <strong>📊 Monthly Submissions (Last 12 Months)</strong>
        </div>
        <div class="card-body">
            @php
                $monthlyData = \App\Models\Submission::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as total')
                    ->groupBy('month')
                    ->orderBy('month', 'desc')
                    ->take(12)
                    ->get();
            @endphp
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Month</th>
                            <th>Total Submissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($monthlyData as $data)
                            <tr>
                                <td>{{ $data->month }}</td>
                                <td>{{ $data->total }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
