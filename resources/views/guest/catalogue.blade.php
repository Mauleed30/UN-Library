@extends('layouts.guest')

@section('content')
<style>
    /* ==================== HERO SECTION ==================== */
    .catalogue-hero {
        background: linear-gradient(135deg, #1a2a3a 0%, #2c3e50 50%, #1a5276 100%);
        padding: 60px 0 50px;
        border-radius: 0 0 30px 30px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }
    .catalogue-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 50%;
        height: 200%;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
        transform: rotate(15deg);
    }
    .catalogue-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 40%;
        height: 150%;
        background: rgba(255,255,255,0.02);
        border-radius: 50%;
        transform: rotate(-10deg);
    }
    .catalogue-hero .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }
    .catalogue-hero .hero-title {
        color: white;
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 10px;
    }
    .catalogue-hero .hero-title span {
        color: #6ab0e6;
    }
    .catalogue-hero .hero-subtitle {
        color: rgba(255,255,255,0.8);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 25px;
        line-height: 1.7;
    }
    .catalogue-hero .search-box {
        max-width: 600px;
        margin: 0 auto;
    }
    .catalogue-hero .search-box .input-group {
        background: white;
        border-radius: 50px;
        padding: 5px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }
    .catalogue-hero .search-box .form-control {
        border: none;
        padding: 15px 25px;
        border-radius: 50px 0 0 50px;
        font-size: 1rem;
        background: transparent;
    }
    .catalogue-hero .search-box .form-control:focus {
        box-shadow: none;
        outline: none;
    }
    .catalogue-hero .search-box .btn-search {
        border-radius: 50px;
        padding: 12px 35px;
        background: #1a5276;
        color: white;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    .catalogue-hero .search-box .btn-search:hover {
        background: #154360;
        transform: scale(1.02);
    }

    /* ==================== STATS BAR ==================== */
    .stats-bar {
        display: flex;
        justify-content: center;
        gap: 50px;
        margin-top: 25px;
        flex-wrap: wrap;
    }
    .stats-bar .stat-item {
        text-align: center;
        color: white;
    }
    .stats-bar .stat-item .number {
        font-size: 1.8rem;
        font-weight: 700;
    }
    .stats-bar .stat-item .label {
        font-size: 0.8rem;
        opacity: 0.7;
    }

    /* ==================== FILTERS ==================== */
    .filters-section {
        margin-bottom: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }
    .filters-section .filter-btn {
        padding: 8px 22px;
        border-radius: 50px;
        border: 2px solid #eef2f7;
        background: white;
        font-size: 0.85rem;
        font-weight: 500;
        color: #4a5568;
        transition: all 0.3s;
        cursor: pointer;
    }
    .filters-section .filter-btn:hover {
        border-color: #1a5276;
        color: #1a5276;
    }
    .filters-section .filter-btn.active {
        background: #1a5276;
        color: white;
        border-color: #1a5276;
    }

    /* ==================== RESULT COUNT ==================== */
    .result-count {
        font-size: 0.9rem;
        color: #6b7a8f;
        margin-bottom: 20px;
    }
    .result-count strong {
        color: #1a2a3a;
    }

    /* ==================== SUBMISSION CARDS ==================== */
    .submission-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0,0,0,0.04);
        transition: all 0.4s ease;
        border: 1px solid #f0f2f5;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .submission-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 50px rgba(0,0,0,0.08);
        border-color: #1a5276;
    }

    .submission-card .card-header-custom {
        padding: 18px 20px 10px 20px;
        border-bottom: 1px solid #f0f2f5;
    }
    .submission-card .card-header-custom .badge-category {
        font-size: 0.65rem;
        padding: 4px 14px;
        border-radius: 50px;
        background: #e8f0fe;
        color: #1a5276;
        font-weight: 600;
    }
    .submission-card .card-header-custom .badge-access {
        font-size: 0.65rem;
        padding: 4px 14px;
        border-radius: 50px;
        font-weight: 600;
    }
    .submission-card .card-header-custom .badge-access.open {
        background: #d1fae5;
        color: #065f46;
    }
    .submission-card .card-header-custom .badge-access.restricted {
        background: #fee2e2;
        color: #991b1b;
    }

    .submission-card .card-body-custom {
        padding: 15px 20px 10px 20px;
        flex: 1;
    }
    .submission-card .card-body-custom .title {
        font-size: 1.05rem;
        font-weight: 600;
        color: #1a2a3a;
        margin-bottom: 8px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .submission-card .card-body-custom .abstract {
        font-size: 0.9rem;
        color: #6b7a8f;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .submission-card .card-body-custom .meta {
        font-size: 0.8rem;
        color: #6b7a8f;
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    .submission-card .card-body-custom .meta i {
        color: #1a5276;
        width: 16px;
    }

    .submission-card .card-footer-custom {
        padding: 12px 20px 18px 20px;
        border-top: 1px solid #f0f2f5;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .submission-card .card-footer-custom .btn-view {
        padding: 8px 22px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        flex: 1;
        text-align: center;
        text-decoration: none;
    }
    .submission-card .card-footer-custom .btn-view.primary {
        background: #1a5276;
        color: white;
    }
    .submission-card .card-footer-custom .btn-view.primary:hover {
        background: #154360;
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(26, 82, 118, 0.25);
    }
    .submission-card .card-footer-custom .btn-view.success {
        background: #10b981;
        color: white;
    }
    .submission-card .card-footer-custom .btn-view.success:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(16, 185, 129, 0.25);
    }
    .submission-card .card-footer-custom .btn-view.outline {
        background: transparent;
        color: #1a5276;
        border: 2px solid #1a5276;
    }
    .submission-card .card-footer-custom .btn-view.outline:hover {
        background: #1a5276;
        color: white;
    }

    /* ==================== PAGINATION ==================== */
    .pagination-container {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }
    .pagination-container .pagination .page-link {
        border: none;
        padding: 10px 18px;
        border-radius: 10px;
        margin: 0 4px;
        color: #4a5568;
        font-weight: 500;
        transition: all 0.3s;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }
    .pagination-container .pagination .page-link:hover {
        background: #1a5276;
        color: white;
    }
    .pagination-container .pagination .active .page-link {
        background: #1a5276;
        color: white;
    }

    /* ==================== EMPTY STATE ==================== */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 20px;
    }
    .empty-state h4 {
        color: #1a2a3a;
        margin-bottom: 10px;
    }
    .empty-state p {
        color: #6b7a8f;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 768px) {
        .catalogue-hero .hero-title {
            font-size: 2rem;
        }
        .catalogue-hero .hero-subtitle {
            font-size: 0.95rem;
        }
        .catalogue-hero .search-box .form-control {
            padding: 12px 18px;
            font-size: 0.9rem;
        }
        .catalogue-hero .search-box .btn-search {
            padding: 10px 20px;
            font-size: 0.85rem;
        }
        .stats-bar {
            gap: 20px;
        }
        .stats-bar .stat-item .number {
            font-size: 1.4rem;
        }
        .filters-section .filter-btn {
            padding: 6px 16px;
            font-size: 0.75rem;
        }
        .submission-card .card-footer-custom .btn-view {
            font-size: 0.75rem;
            padding: 6px 16px;
        }
    }

    @media (max-width: 576px) {
        .catalogue-hero {
            padding: 40px 0 30px;
        }
        .catalogue-hero .hero-title {
            font-size: 1.6rem;
        }
        .catalogue-hero .hero-subtitle {
            font-size: 0.85rem;
        }
        .stats-bar .stat-item .number {
            font-size: 1.2rem;
        }
        .stats-bar .stat-item .label {
            font-size: 0.65rem;
        }
        .submission-card .card-body-custom .title {
            font-size: 0.95rem;
        }
        .submission-card .card-body-custom .abstract {
            font-size: 0.8rem;
        }
        .filters-section {
            gap: 8px;
        }
        .filters-section .filter-btn {
            padding: 4px 12px;
            font-size: 0.7rem;
        }
    }
</style>

<!-- ==================== HERO SECTION ==================== -->
<div class="catalogue-hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">
                📚 <span>Public</span> Catalogue
            </h1>
            <p class="hero-subtitle">
                Discover academic submissions, theses, dissertations and research papers
                from our university repository. Search and access scholarly works.
            </p>

            <!-- Search Box -->
            <form method="GET" action="{{ route('guest.catalogue') }}" class="search-box">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="Search by title, author, or keywords..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search me-2"></i> Search
                    </button>
                </div>
            </form>

            <!-- Stats -->
            <div class="stats-bar">
                <div class="stat-item">
                    <div class="number">{{ \App\Models\Submission::where('status', 'published')->count() }}</div>
                    <div class="label">📄 Published Works</div>
                </div>
                <div class="stat-item">
                    <div class="number">{{ \App\Models\Submission::where('status', 'published')->where('is_open_source', true)->count() }}</div>
                    <div class="label">🔓 Open Access</div>
                </div>
                <div class="stat-item">
                    <div class="number">{{ \App\Models\Category::count() }}</div>
                    <div class="label">📂 Categories</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== MAIN CONTENT ==================== -->
<div class="container">

    <!-- Filters -->
    <div class="filters-section">
        <a href="{{ route('guest.catalogue') }}" class="filter-btn {{ !request('search') ? 'active' : '' }}">
            <i class="fas fa-th-list me-1"></i> All
        </a>
        <a href="{{ route('guest.catalogue') }}?search=thesis" class="filter-btn">
            <i class="fas fa-graduation-cap me-1"></i> Thesis
        </a>
        <a href="{{ route('guest.catalogue') }}?search=dissertation" class="filter-btn">
            <i class="fas fa-book me-1"></i> Dissertation
        </a>
        <a href="{{ route('guest.catalogue') }}?search=research" class="filter-btn">
            <i class="fas fa-flask me-1"></i> Research
        </a>
        <a href="{{ route('guest.catalogue') }}?search=journal" class="filter-btn">
            <i class="fas fa-newspaper me-1"></i> Journal
        </a>
    </div>

    <!-- Result Count -->
    @if($submissions->count() > 0)
        <div class="result-count">
            <i class="fas fa-file-alt me-1"></i>
            Showing <strong>{{ $submissions->firstItem() ?? 0 }}</strong> to
            <strong>{{ $submissions->lastItem() ?? 0 }}</strong> of
            <strong>{{ $submissions->total() }}</strong> results
            @if(request('search'))
                for "<strong>{{ request('search') }}</strong>"
            @endif
        </div>
    @endif

    <!-- Submissions Grid -->
    <div class="row g-4">
        @forelse($submissions as $submission)
            <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                <div class="submission-card">
                    <!-- Header -->
                    <div class="card-header-custom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge-category">
                                <i class="fas fa-tag me-1"></i> {{ $submission->category->name ?? 'Uncategorized' }}
                            </span>
                            @if($submission->is_open_source)
                                <span class="badge-access open">🔓 Open Access</span>
                            @else
                                <span class="badge-access restricted">🔒 Restricted</span>
                            @endif
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="card-body-custom">
                        <div class="title">{{ $submission->title }}</div>
                        <div class="abstract">{{ Str::limit($submission->abstract, 120) }}</div>
                        <div class="meta">
                            <span><i class="fas fa-user"></i> {{ $submission->author }}</span>
                            <span><i class="fas fa-calendar-alt"></i> {{ $submission->published_at ? \Carbon\Carbon::parse($submission->published_at)->format('d M Y') : 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer-custom">
                        <a href="{{ route('guest.view', $submission->id) }}" class="btn-view primary">
                            <i class="fas fa-eye me-1"></i> View Details
                        </a>
                        @if($submission->is_open_source && $submission->file_path)
                            <a href="{{ route('guest.download', $submission->id) }}" class="btn-view success">
                                <i class="fas fa-download me-1"></i> Download
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-search"></i>
                    <h4>No Results Found</h4>
                    <p>We couldn't find any published submissions matching your search.</p>
                    <a href="{{ route('guest.catalogue') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-left me-1"></i> Back to Catalogue
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($submissions->count() > 0)
        <div class="pagination-container">
            {{ $submissions->links() }}
        </div>
    @endif
</div>
@endsection
