<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="{{ url('/') }}">
            📚 University Repository
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <!-- Dashboard -->
                    <li class="nav-item">
                        @if(auth()->user()->role_id == 1)
                            <a class="nav-link" href="{{ route('student.dashboard') }}">📊 Dashboard</a>
                        @elseif(auth()->user()->role_id == 2)
                            <a class="nav-link" href="{{ route('faculty.dashboard') }}">📊 Dashboard</a>
                        @elseif(auth()->user()->role_id == 3)
                            <a class="nav-link" href="{{ route('librarian.dashboard') }}">📊 Dashboard</a>
                        @elseif(auth()->user()->role_id == 4)
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                        @endif
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <!-- User Info -->
                            <li class="dropdown-header">
                                <strong>{{ auth()->user()->name }}</strong>
                            </li>
                            <li class="dropdown-header text-muted small">
                                {{ auth()->user()->email }}
                            </li>
                            <li class="dropdown-header text-muted small">
                                @if(auth()->user()->role_id == 1)
                                    🎓 Student
                                    @if(auth()->user()->student_id)
                                        | ID: {{ auth()->user()->student_id }}
                                    @endif
                                @elseif(auth()->user()->role_id == 2)
                                    👨‍🏫 Faculty
                                    @if(auth()->user()->staff_id)
                                        | ID: {{ auth()->user()->staff_id }}
                                    @endif
                                @elseif(auth()->user()->role_id == 3)
                                    📚 Librarian
                                    @if(auth()->user()->staff_id)
                                        | ID: {{ auth()->user()->staff_id }}
                                    @endif
                                @elseif(auth()->user()->role_id == 4)
                                    ⚙️ Administrator
                                @endif
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <!-- My Profile -->
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    <i class="fas fa-user"></i> My Profile
                                </a>
                            </li>

                            <!-- Settings -->
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <!-- Logout -->
                            <li>
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">🔑 Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">📝 Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
