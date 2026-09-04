@extends('layouts.app')

@section('title', 'Librarian Dashboard')
@section('content')
<style>
    /* ==================== LAYOUT ==================== */
    .librarian-wrapper {
        display: flex;
        min-height: calc(100vh - 80px);
        gap: 20px;
    }

    /* ==================== SIDEBAR ==================== */
    .sidebar-librarian {
        width: 260px;
        min-height: 500px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        padding: 20px 0;
        flex-shrink: 0;
        border: 1px solid #f0f2f5;
        position: sticky;
        top: 20px;
        height: fit-content;
    }
    .sidebar-librarian .sidebar-header {
        padding: 0 20px 15px 20px;
        border-bottom: 1px solid #eef2f7;
        margin-bottom: 10px;
    }
    .sidebar-librarian .sidebar-header .brand {
        font-weight: 700;
        font-size: 1.1rem;
        color: #1a2a3a;
    }
    .sidebar-librarian .sidebar-header .brand i {
        color: #1a5276;
    }
    .sidebar-librarian .sidebar-header .sub {
        font-size: 0.75rem;
        color: #6b7a8f;
    }

    .sidebar-librarian .nav-item {
        padding: 0 12px;
        margin-bottom: 2px;
    }
    .sidebar-librarian .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: 10px;
        color: #4a5568;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s;
        cursor: pointer;
        border: none;
        background: transparent;
        width: 100%;
        text-align: left;
    }
    .sidebar-librarian .nav-link:hover {
        background: #f0f4f8;
        color: #1a5276;
    }
    .sidebar-librarian .nav-link.active {
        background: #1a5276;
        color: white;
        box-shadow: 0 4px 12px rgba(26, 82, 118, 0.25);
    }
    .sidebar-librarian .nav-link.active i {
        color: white;
    }
    .sidebar-librarian .nav-link i {
        width: 20px;
        font-size: 1.1rem;
        color: #6b7a8f;
        transition: color 0.3s;
    }
    .sidebar-librarian .nav-link .badge-notif {
        margin-left: auto;
        background: #ef4444;
        color: white;
        font-size: 0.65rem;
        padding: 2px 8px;
        border-radius: 50px;
    }
    .sidebar-librarian .nav-link .badge-notif.green {
        background: #10b981;
    }

    .sidebar-librarian .divider {
        height: 1px;
        background: #eef2f7;
        margin: 8px 20px;
    }

    /* ==================== CONTENT ==================== */
    .librarian-content {
        flex: 1;
        min-width: 0;
    }

    .content-section {
        display: none;
        animation: fadeIn 0.3s ease;
    }
    .content-section.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ==================== CARDS ==================== */
    .dashboard-card {
        background: white;
        border-radius: 12px;
        padding: 18px 22px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        margin-bottom: 16px;
        border: 1px solid #f0f2f5;
    }
    .dashboard-card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    /* ==================== STATISTICS ==================== */
    .stat-box {
        background: #f8fafc;
        border-radius: 10px;
        padding: 14px 10px;
        text-align: center;
        border: 1px solid #eef2f7;
        transition: all 0.3s;
    }
    .stat-box:hover {
        border-color: #1a5276;
        background: #f0f4f8;
        transform: translateY(-2px);
    }
    .stat-box .number {
        font-size: 1.8rem;
        font-weight: 700;
    }
    .stat-box .label {
        font-size: 0.85rem;
        color: #6b7a8f;
        margin-top: 4px;
        font-weight: 500;
    }
    .stat-box.pending .number { color: #f59e0b; }
    .stat-box.approved .number { color: #10b981; }
    .stat-box.rejected .number { color: #ef4444; }
    .stat-box.published .number { color: #3b82f6; }
    .stat-box.open .number { color: #1a5276; }
    .stat-box.restricted .number { color: #6b7280; }

    /* ==================== SUBMISSION ITEMS ==================== */
    .submission-item {
        padding: 14px 16px;
        border: 1px solid #eef2f7;
        border-radius: 10px;
        margin-bottom: 10px;
        background: white;
        transition: all 0.3s;
    }
    .submission-item:hover {
        border-color: #1a5276;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    }
    .submission-item .title {
        font-weight: 600;
        font-size: 1rem;
        color: #1a2a3a;
    }
    .submission-item .meta {
        font-size: 0.85rem;
        color: #6b7a8f;
        margin-top: 3px;
    }
    .submission-item .meta i {
        width: 18px;
        color: #1a5276;
    }

    /* ==================== BADGES ==================== */
    .access-badge {
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .access-badge.open {
        background: #d1fae5;
        color: #065f46;
    }
    .access-badge.restricted {
        background: #fee2e2;
        color: #991b1b;
    }
    .badge-sm {
        font-size: 0.7rem;
        padding: 4px 12px;
    }

    /* ==================== SECTION TITLES ==================== */
    .section-title {
        font-size: 1.05rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: #1a2a3a;
    }

    /* ==================== FORM ==================== */
    .form-control-sm {
        font-size: 0.85rem;
        padding: 8px 12px;
        border-radius: 8px;
        border-color: #d1d5db;
    }
    .form-control-sm:focus {
        border-color: #1a5276;
        box-shadow: 0 0 0 3px rgba(26, 82, 118, 0.1);
    }
    .btn-sm-custom {
        font-size: 0.8rem;
        padding: 5px 16px;
        border-radius: 8px;
    }

    /* ==================== EVENTS ==================== */
    .event-item {
        padding: 10px 14px;
        border-left: 4px solid #1a5276;
        background: #f8fafc;
        margin-bottom: 8px;
        border-radius: 6px;
    }
    .event-item .date {
        font-size: 0.75rem;
        color: #6b7a8f;
        font-weight: 600;
    }
    .event-item .title {
        font-weight: 600;
        font-size: 0.95rem;
        color: #1a2a3a;
    }
    .event-item .meta {
        font-size: 0.8rem;
        color: #6b7a8f;
    }

    /* ==================== FILE BUTTONS ==================== */
    .btn-view-file {
        font-size: 0.8rem;
        padding: 4px 14px;
    }
    .file-link {
        color: #1a5276;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .file-link:hover {
        text-decoration: underline;
        color: #0d3b5e;
    }

    /* ==================== MODAL ==================== */
    .modal-xl {
        max-width: 92%;
    }
    .modal-body {
        min-height: 550px;
        background: #f8fafc;
        padding: 20px;
    }
    .modal-body iframe {
        width: 100%;
        height: 100%;
        min-height: 550px;
        border: none;
        border-radius: 10px;
        background: white;
    }
    .modal-body img {
        max-width: 100%;
        max-height: 650px;
        border-radius: 10px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    }
    .modal-body pre {
        white-space: pre-wrap;
        word-wrap: break-word;
        font-family: inherit;
        font-size: 0.95rem;
        line-height: 1.7;
        margin: 0;
        background: white;
        padding: 25px;
        border-radius: 10px;
        max-height: 650px;
        overflow-y: auto;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 992px) {
        .librarian-wrapper {
            flex-direction: column;
        }
        .sidebar-librarian {
            width: 100%;
            min-height: auto;
            position: relative;
            top: 0;
            padding: 12px 0;
        }
        .sidebar-librarian .sidebar-header {
            display: none;
        }
        .sidebar-librarian .nav-items {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            padding: 0 10px;
        }
        .sidebar-librarian .nav-item {
            padding: 0;
            margin: 0;
            flex: 1 0 auto;
        }
        .sidebar-librarian .nav-link {
            padding: 8px 12px;
            font-size: 0.8rem;
            justify-content: center;
            border-radius: 8px;
        }
        .sidebar-librarian .nav-link i {
            font-size: 0.9rem;
        }
        .sidebar-librarian .divider {
            display: none;
        }
        .stat-box .number {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 576px) {
        .dashboard-card {
            padding: 12px 14px !important;
        }
        .stat-box {
            padding: 10px 5px !important;
        }
        .stat-box .number {
            font-size: 1.2rem !important;
        }
        .stat-box .label {
            font-size: 0.65rem !important;
        }
        .submission-item {
            padding: 10px 12px !important;
        }
        .submission-item .title {
            font-size: 0.85rem !important;
        }
        .submission-item .meta {
            font-size: 0.7rem !important;
        }
        .btn-sm-custom {
            font-size: 0.7rem !important;
            padding: 4px 10px !important;
        }
        .section-title {
            font-size: 0.9rem !important;
        }
        .modal-xl {
            max-width: 98% !important;
            margin: 5px !important;
        }
        .modal-body {
            min-height: 300px !important;
            padding: 10px !important;
        }
        .modal-body iframe {
            min-height: 300px !important;
        }
        .modal-body img {
            max-height: 350px !important;
        }
        .modal-body pre {
            max-height: 350px !important;
            font-size: 0.8rem !important;
            padding: 15px !important;
        }
        .sidebar-librarian .nav-link {
            font-size: 0.7rem !important;
            padding: 6px 10px !important;
        }
        .sidebar-librarian .nav-link i {
            font-size: 0.8rem !important;
        }
    }
</style>

<div class="librarian-wrapper">

    <!-- ==================== SIDEBAR ==================== -->
    <div class="sidebar-librarian">
        <div class="sidebar-header">
            <div class="brand"><i class="fas fa-university me-2"></i>Librarian</div>
            <div class="sub">Repository Administration</div>
        </div>

        <div class="nav-items">
            <!-- Dashboard / Home -->
            <div class="nav-item">
                <button class="nav-link active" data-section="dashboard">
                    <i class="fas fa-home"></i> Dashboard
                </button>
            </div>

            <!-- Submissions -->
            <div class="nav-item">
                <button class="nav-link" data-section="submissions">
                    <i class="fas fa-file-alt"></i> Submissions
                    <span class="badge-notif">{{ \App\Models\Submission::where('status', 'reviewed')->count() }}</span>
                </button>
            </div>

            <!-- Access Level -->
            <div class="nav-item">
                <button class="nav-link" data-section="access">
                    <i class="fas fa-lock"></i> Access Level
                </button>
            </div>

            <!-- Recently Approved -->
            <div class="nav-item">
                <button class="nav-link" data-section="approved">
                    <i class="fas fa-check-circle"></i> Approved
                    <span class="badge-notif green">{{ \App\Models\Submission::where('status', 'approved')->count() }}</span>
                </button>
            </div>

            <!-- Categories -->
            <div class="nav-item">
                <button class="nav-link" data-section="categories">
                    <i class="fas fa-folder"></i> Categories
                </button>
            </div>

            <!-- Statistics -->
            <div class="nav-item">
                <button class="nav-link" data-section="statistics">
                    <i class="fas fa-chart-bar"></i> Statistics
                </button>
            </div>

            <!-- Activity -->
            <div class="nav-item">
                <button class="nav-link" data-section="activity">
                    <i class="fas fa-history"></i> Activity
                </button>
            </div>

            <div class="divider"></div>

            <!-- Quick Actions -->
            <div class="nav-item">
                <button class="nav-link" data-section="quick">
                    <i class="fas fa-bolt"></i> Quick Actions
                </button>
            </div>
        </div>
    </div>

    <!-- ==================== CONTENT ==================== -->
    <div class="librarian-content">

        <!-- ==================== SECTION: DASHBOARD ==================== -->
        <div class="content-section active" id="section-dashboard">

            <!-- Welcome -->
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <div style="font-weight: 700; font-size: 1.2rem;">📚 Welcome, <strong>{{ auth()->user()->name }}</strong></div>
                        <div style="font-size: 0.9rem; color: #6b7a8f;">
                            Librarian | Repository Administrator
                            @if(auth()->user()->section)
                                | Section: <strong>{{ auth()->user()->section }}</strong>
                            @endif
                        </div>
                    </div>
                    <div>
                        <span class="badge bg-success" style="font-size: 0.75rem; padding: 6px 16px;">● Active</span>
                    </div>
                </div>
            </div>

            <!-- Statistics Overview -->
            @php
                $pendingReview = \App\Models\Submission::where('status', 'reviewed')->count();
                $approved = \App\Models\Submission::where('status', 'approved')->count();
                $rejected = \App\Models\Submission::where('status', 'rejected')->count();
                $published = \App\Models\Submission::where('status', 'published')->count();
                $total = \App\Models\Submission::count();
                $openAccess = \App\Models\Submission::where('is_open_source', true)->count();
                $restricted = \App\Models\Submission::where('is_open_source', false)->count();
            @endphp

            <div class="row g-3">
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-box pending">
                        <div class="number">{{ $pendingReview }}</div>
                        <div class="label">⏳ Pending</div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-box approved">
                        <div class="number">{{ $approved }}</div>
                        <div class="label">✅ Approved</div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-box rejected">
                        <div class="number">{{ $rejected }}</div>
                        <div class="label">❌ Rejected</div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-box published">
                        <div class="number">{{ $published }}</div>
                        <div class="label">📚 Published</div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-box open">
                        <div class="number">{{ $openAccess }}</div>
                        <div class="label">🔓 Open</div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-box restricted">
                        <div class="number">{{ $restricted }}</div>
                        <div class="label">🔒 Restricted</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== SECTION: SUBMISSIONS ==================== -->
        <div class="content-section" id="section-submissions">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="section-title">📋 Submissions Waiting for Review</div>
                    <a href="{{ route('librarian.submissions') }}" class="btn btn-outline-primary btn-sm-custom">View All →</a>
                </div>
                <hr>

                @php $submissions = \App\Models\Submission::where('status', 'reviewed')->latest()->take(5)->get(); @endphp

                @forelse($submissions as $submission)
                    <div class="submission-item">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div style="flex: 1;">
                                <div class="title">{{ $submission->title }}</div>
                                <div class="meta">
                                    <i class="fas fa-user"></i> {{ $submission->author }}
                                    | <i class="fas fa-tag"></i> {{ $submission->category->name ?? 'Uncategorized' }}
                                    | <i class="fas fa-clock"></i> {{ $submission->submitted_at ? $submission->submitted_at->diffForHumans() : 'N/A' }}
                                </div>
                                @if($submission->file_path)
                                    <div class="mt-2 d-flex align-items-center gap-2 flex-wrap">
                                        <button onclick="viewFile('{{ asset('storage/' . $submission->file_path) }}', '{{ $submission->title }}', '{{ pathinfo($submission->file_path, PATHINFO_EXTENSION) }}')"
                                                class="btn btn-info btn-sm-custom btn-view-file">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="file-link">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </div>
                                @endif
                                <div class="mt-2">
                                    <span class="badge bg-warning badge-sm">⏳ Pending</span>
                                </div>
                            </div>
                            <div class="ms-2">
                                <a href="{{ route('librarian.review', $submission->id) }}" class="btn btn-primary btn-sm-custom">
                                    <i class="fas fa-edit"></i> Review
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-3">
                        <i class="fas fa-check-circle text-success" style="font-size: 2rem;"></i>
                        <p class="text-muted mt-2" style="font-size: 0.95rem;">All caught up! No submissions waiting for review.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- ==================== SECTION: ACCESS LEVEL ==================== -->
        <div class="content-section" id="section-access">
            <div class="dashboard-card">
                <div class="section-title">🔓 Set Access Level</div>
                <p class="text-muted" style="font-size: 0.9rem;">Change access level for approved or published submissions</p>
                <form method="POST" action="{{ route('librarian.set-access', 0) }}" id="accessForm">
                    @csrf
                    <div class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <label style="font-size: 0.85rem; font-weight: 500;">Select Submission</label>
                            <select name="submission_id" class="form-control form-control-sm" required>
                                <option value="">-- Select --</option>
                                @php $allSubs = \App\Models\Submission::where('status', 'approved')->orWhere('status', 'published')->get(); @endphp
                                @foreach($allSubs as $sub)
                                    <option value="{{ $sub->id }}">
                                        {{ Str::limit($sub->title, 45) }}
                                        @if($sub->is_open_source) 🔓 @else 🔒 @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size: 0.85rem; font-weight: 500;">Access Level</label>
                            <select name="is_open_source" class="form-control form-control-sm" required>
                                <option value="1">🔓 Open Access</option>
                                <option value="0">🔒 Restricted</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="padding-top: 22px;">
                            <button type="submit" class="btn btn-primary w-100 btn-sm-custom">
                                <i class="fas fa-save me-1"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- ==================== SECTION: RECENTLY APPROVED ==================== -->
        <div class="content-section" id="section-approved">
            <div class="dashboard-card">
                <div class="section-title">✅ Recently Approved</div>
                <hr>

                @php $approvedSubs = \App\Models\Submission::where('status', 'approved')->latest()->take(5)->get(); @endphp

                @forelse($approvedSubs as $submission)
                    <div class="submission-item" style="border-color: #d1fae5; background: #fafffe;">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div style="flex: 1;">
                                <div class="title">{{ $submission->title }}</div>
                                <div class="meta">
                                    <i class="fas fa-user"></i> {{ $submission->author }}
                                    | <i class="fas fa-tag"></i> {{ $submission->category->name ?? 'Uncategorized' }}
                                </div>
                                <div class="mt-2 d-flex align-items-center gap-2 flex-wrap">
                                    <span class="badge bg-success badge-sm">✅ Approved</span>
                                    @if($submission->is_open_source)
                                        <span class="access-badge open">🔓 Open</span>
                                    @else
                                        <span class="access-badge restricted">🔒 Restricted</span>
                                    @endif
                                    <a href="{{ route('librarian.publish', $submission->id) }}" class="btn btn-success btn-sm-custom">
                                        <i class="fas fa-upload"></i> Publish
                                    </a>
                                    <a href="{{ route('librarian.edit-metadata', $submission->id) }}" class="btn btn-warning btn-sm-custom">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-3">
                        <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
                        <p class="text-muted mt-2" style="font-size: 0.95rem;">No approved submissions yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- ==================== SECTION: CATEGORIES ==================== -->
        <div class="content-section" id="section-categories">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="section-title">📂 Manage Categories</div>
                    <a href="{{ route('librarian.categories') }}" class="btn btn-primary btn-sm-custom">
                        <i class="fas fa-plus me-1"></i> Manage
                    </a>
                </div>
                <hr>
                <div class="row">
                    @php $categories = \App\Models\Category::all(); @endphp
                    @forelse($categories as $category)
                        <div class="col-md-3 col-6 mb-2">
                            <div class="submission-item" style="text-align: center; padding: 12px;">
                                <i class="fas fa-folder" style="font-size: 1.5rem; color: #1a5276;"></i>
                                <div style="font-weight: 600; font-size: 0.9rem; margin-top: 4px;">{{ $category->name }}</div>
                                <div style="font-size: 0.75rem; color: #6b7a8f;">{{ $category->submissions()->count() }} items</div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted text-center">No categories yet. <a href="{{ route('librarian.categories') }}">Add one</a></p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- ==================== SECTION: STATISTICS ==================== -->
        <div class="content-section" id="section-statistics">
            <div class="dashboard-card">
                <div class="section-title">📊 Repository Statistics</div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between py-2 border-bottom" style="font-size: 0.95rem;">
                            <span><i class="fas fa-file-alt text-primary me-2"></i> Total Submissions</span>
                            <span class="fw-bold">{{ $total }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom" style="font-size: 0.95rem;">
                            <span><i class="fas fa-clock text-warning me-2"></i> Pending Review</span>
                            <span class="fw-bold text-warning">{{ $pendingReview }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom" style="font-size: 0.95rem;">
                            <span><i class="fas fa-check-circle text-success me-2"></i> Approved</span>
                            <span class="fw-bold text-success">{{ $approved }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between py-2 border-bottom" style="font-size: 0.95rem;">
                            <span><i class="fas fa-upload text-primary me-2"></i> Published</span>
                            <span class="fw-bold text-primary">{{ $published }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom" style="font-size: 0.95rem;">
                            <span><i class="fas fa-lock-open text-success me-2"></i> Open Access</span>
                            <span class="fw-bold text-success">{{ $openAccess }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2" style="font-size: 0.95rem;">
                            <span><i class="fas fa-lock text-secondary me-2"></i> Restricted</span>
                            <span class="fw-bold text-secondary">{{ $restricted }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== SECTION: ACTIVITY ==================== -->
        <div class="content-section" id="section-activity">
            <div class="dashboard-card">
                <div class="section-title">📌 Recent Activity</div>
                <hr>

                @php $recentActivity = \App\Models\Submission::whereNotNull('reviewed_at')->latest('reviewed_at')->take(5)->get(); @endphp

                @forelse($recentActivity as $activity)
                    <div class="event-item">
                        <div class="date"><i class="far fa-clock me-1"></i> {{ $activity->reviewed_at ? $activity->reviewed_at->diffForHumans() : 'N/A' }}</div>
                        <div class="title">{{ Str::limit($activity->title, 40) }}</div>
                        <div class="meta">
                            <i class="fas fa-user me-1"></i> {{ $activity->author }}
                            | Status:
                            @if($activity->status == 'approved')
                                <span class="badge bg-success" style="font-size: 0.65rem;">Approved</span>
                            @elseif($activity->status == 'rejected')
                                <span class="badge bg-danger" style="font-size: 0.65rem;">Rejected</span>
                            @elseif($activity->status == 'published')
                                <span class="badge bg-primary" style="font-size: 0.65rem;">Published</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-3">
                        <i class="fas fa-history text-muted" style="font-size: 2rem;"></i>
                        <p class="text-muted mt-2" style="font-size: 0.95rem;">No recent activity.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- ==================== SECTION: QUICK ACTIONS ==================== -->
        <div class="content-section" id="section-quick">
            <div class="dashboard-card">
                <div class="section-title">⚡ Quick Actions</div>
                <hr>
                <div class="row g-2">
                    <div class="col-md-4 col-6">
                        <a href="{{ route('librarian.submissions') }}" class="btn btn-primary w-100 btn-sm-custom" style="padding: 12px;">
                            <i class="fas fa-list me-1"></i> All Submissions
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('librarian.submissions') }}?status=pending" class="btn btn-warning w-100 btn-sm-custom" style="padding: 12px;">
                            <i class="fas fa-clock me-1"></i> Pending
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('librarian.categories') }}" class="btn btn-info w-100 btn-sm-custom" style="padding: 12px;">
                            <i class="fas fa-folder me-1"></i> Categories
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('librarian.submissions') }}?status=published" class="btn btn-success w-100 btn-sm-custom" style="padding: 12px;">
                            <i class="fas fa-check-circle me-1"></i> Published
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('librarian.submissions') }}?status=approved" class="btn btn-secondary w-100 btn-sm-custom" style="padding: 12px;">
                            <i class="fas fa-check me-1"></i> Approved
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('librarian.submissions') }}?status=rejected" class="btn btn-danger w-100 btn-sm-custom" style="padding: 12px;">
                            <i class="fas fa-times me-1"></i> Rejected
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- ==================== FILE VIEWER MODAL ==================== -->
<div class="modal fade" id="fileViewerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header" style="background: #f8fafc; border-bottom: 1px solid #eef2f7;">
                <h5 class="modal-title" style="font-size: 1.1rem;">
                    <i class="fas fa-file-alt text-primary me-2"></i>
                    <span id="fileViewerTitle">Document Viewer</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="fileViewerLoading" class="text-center py-5">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
                    <p class="mt-3 text-muted" style="font-size: 0.95rem;">Loading document...</p>
                </div>
                <div id="pdfViewerContainer" style="display:none; width:100%; height:650px;">
                    <iframe id="pdfViewer" src=""></iframe>
                </div>
                <div id="docViewerContainer" style="display:none; width:100%; height:650px;">
                    <iframe id="docViewer" src=""></iframe>
                </div>
                <div id="imageViewerContainer" style="display:none; text-align:center;">
                    <img id="imageViewer" src="" style="max-width:100%; max-height:650px; border-radius:10px;">
                </div>
                <div id="textViewerContainer" style="display:none;">
                    <pre id="textViewer" style="white-space:pre-wrap; font-family:inherit; font-size:0.95rem; line-height:1.7; margin:0; background:white; padding:25px; border-radius:10px; max-height:650px; overflow-y:auto;"></pre>
                </div>
                <div id="fileViewerError" style="display:none;" class="text-center py-5">
                    <i class="fas fa-exclamation-circle text-danger" style="font-size:3.5rem;"></i>
                    <p class="mt-3 text-danger" id="fileViewerErrorMessage" style="font-size:1rem;">Unable to load document.</p>
                </div>
            </div>
            <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #eef2f7;">
                <a id="fileViewerDownloadLink" href="#" target="_blank" class="btn btn-success btn-sm-custom">
                    <i class="fas fa-download me-1"></i> Download
                </a>
                <button type="button" class="btn btn-secondary btn-sm-custom" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
// ==================== SIDEBAR NAVIGATION ====================
document.querySelectorAll('.sidebar-librarian .nav-link').forEach(button => {
    button.addEventListener('click', function() {
        // Remove active from all
        document.querySelectorAll('.sidebar-librarian .nav-link').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        // Hide all sections
        document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));

        // Show selected section
        const sectionId = this.getAttribute('data-section');
        const targetSection = document.getElementById('section-' + sectionId);
        if (targetSection) {
            targetSection.classList.add('active');
        }
    });
});

// ==================== FILE VIEWER ====================
function viewFile(filePath, fileName, fileType) {
    document.getElementById('fileViewerLoading').style.display = 'block';
    document.getElementById('pdfViewerContainer').style.display = 'none';
    document.getElementById('docViewerContainer').style.display = 'none';
    document.getElementById('imageViewerContainer').style.display = 'none';
    document.getElementById('textViewerContainer').style.display = 'none';
    document.getElementById('fileViewerError').style.display = 'none';

    document.getElementById('fileViewerTitle').textContent = fileName || 'Document';
    document.getElementById('fileViewerDownloadLink').href = filePath;

    const extension = fileType || filePath.split('.').pop().toLowerCase();

    setTimeout(function() {
        document.getElementById('fileViewerLoading').style.display = 'none';

        if (extension === 'pdf') {
            document.getElementById('pdfViewer').src = filePath + '#toolbar=1';
            document.getElementById('pdfViewerContainer').style.display = 'block';
        }
        else if (['jpg','jpeg','png','gif','svg','bmp','webp'].includes(extension)) {
            document.getElementById('imageViewer').src = filePath;
            document.getElementById('imageViewerContainer').style.display = 'block';
        }
        else if (['doc','docx','xls','xlsx','ppt','pptx','odt','ods','odp'].includes(extension)) {
            document.getElementById('docViewer').src = 'https://docs.google.com/gview?embedded=true&url=' + encodeURIComponent(filePath);
            document.getElementById('docViewerContainer').style.display = 'block';
        }
        else if (['txt','csv','log','md','xml','json'].includes(extension)) {
            fetch(filePath)
                .then(response => response.text())
                .then(text => {
                    document.getElementById('textViewer').textContent = text;
                    document.getElementById('textViewerContainer').style.display = 'block';
                })
                .catch(() => {
                    showFileViewerError('Unable to load text file.');
                });
        }
        else {
            showFileViewerError('File type "' + extension.toUpperCase() + '" cannot be previewed.');
        }
    }, 500);
}

function showFileViewerError(message) {
    document.getElementById('fileViewerLoading').style.display = 'none';
    document.getElementById('fileViewerError').style.display = 'block';
    document.getElementById('fileViewerErrorMessage').textContent = message;
}

document.getElementById('fileViewerModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('pdfViewer').src = '';
    document.getElementById('docViewer').src = '';
    document.getElementById('imageViewer').src = '';
    document.getElementById('textViewer').textContent = '';
});

// ==================== ACCESS LEVEL FORM ====================
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('accessForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const id = this.querySelector('select[name="submission_id"]').value;
            if (!id) {
                e.preventDefault();
                alert('Please select a submission first.');
            } else {
                this.action = "{{ route('librarian.set-access', '') }}/" + id;
            }
        });
    }

    // Check URL hash for direct section access
    if (window.location.hash) {
        const hash = window.location.hash.replace('#', '');
        const targetBtn = document.querySelector('.sidebar-librarian .nav-link[data-section="' + hash + '"]');
        if (targetBtn) {
            targetBtn.click();
        }
    }
});
</script>
@endsection
